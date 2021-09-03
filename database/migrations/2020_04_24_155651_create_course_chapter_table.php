<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseChapterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_chapter', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('parent_course_id');
            $table->string('title');
            $table->json('translated_title')->nullable();
            $table->string('video_link')->nullable();
            $table->json('description')->nullable();
            $table->string('icon')->nullable();
            $table->unsignedBigInteger('left_node');
            $table->unsignedBigInteger('right_node');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->softDeletes();


            $table->foreign('parent_course_id')
                ->references('id')
                ->on('course')
                ->onDelete('restrict');

            $table->unique(['parent_course_id', 'title']);


            DB::unprepared(<<<INSERT_NODE

DROP PROCEDURE IF EXISTS addNodeToCourseChapter;
CREATE PROCEDURE addNodeToCourseChapter(
    IN parentNode BIGINT,
    IN parentCourse BIGINT, 
    IN title VARCHAR(255), 
    IN videoLink VARCHAR(255),
    IN icon VARCHAR(255)
 )

BEGIN

	SELECT @put_right:=right_node FROM course_chapter WHERE id=parentNode;

	UPDATE course_chapter SET left_node = IF(left_node > @put_right, left_node + 2, left_node),
	right_node = IF(right_node >= @put_right, right_node + 2, right_node)
	WHERE right_node >= @put_right AND parent_course_id = parentCourse;

	INSERT INTO course_chapter (`parent_course_id`,`title`,`video_link`,`icon`,`left_node`,`right_node`)
	VALUES (parentCourse, title, videoLink, icon, @put_right, @put_right + 1);

END
INSERT_NODE
            );


            DB::unprepared(<<<CHILD_NODES

DROP PROCEDURE IF EXISTS getAllChildNodesOnCourseChapter;
CREATE PROCEDURE getAllChildNodesOnCourseChapter(
IN parentCourse BIGINT, 
IN queriedCourseNode BIGINT
)

BEGIN

	SELECT node.*,(COUNT(parent.title) - (subTree.depth + 1)) as depth
	FROM course_chapter as node,
	course_chapter as parent,
	course_chapter as subParent,
	(
		SELECT node.title,(COUNT(parent.title) - 1) as depth
		FROM course_chapter as node,
		course_chapter as parent
		WHERE node.parent_course_id = parentCourse
		AND parent.parent_course_id = parentCourse
		AND node.left_node BETWEEN parent.left_node and parent.right_node
		AND node.id = queriedCourseNode
		GROUP BY node.title
		ORDER BY node.left_node
	) as subTree
	WHERE node.parent_course_id = parentCourse
	AND parent.parent_course_id = parentCourse
	AND subParent.parent_course_id = parentCourse
	AND node.left_node BETWEEN parent.left_node AND parent.right_node
	AND node.left_node BETWEEN subParent.left_node AND subParent.right_node
	AND subParent.title = subTree.title 
	AND node.deleted_at IS NULL 
	GROUP BY node.title
	HAVING depth >= 1
	ORDER BY node.left_node;

END
CHILD_NODES
            );


            DB::unprepared(<<<DEPTH_NODES

DROP PROCEDURE IF EXISTS getNodesOnCourseChapterByDepth;
CREATE PROCEDURE getNodesOnCourseChapterByDepth(
    IN parentCourse BIGINT, 
    IN queriedCourseNode BIGINT, 
    IN queriedDepth INT
)

BEGIN

	SELECT node.*,(COUNT(parent.title) - (subTree.title + 1)) as depth
	FROM course_chapter as node,
	course_chapter as parent,
	course_chapter as subParent,
	(
		SELECT node.title,(COUNT(parent.title) - 1) as depth
		FROM course_chapter as node,
		course_chapter as parent
		WHERE node.parent_course_id = parentCourse
		AND parent.parent_course_id = parentCourse
		AND node.left_node BETWEEN parent.left_node and parent.right_node
		AND node.id = queriedCourseNode
		GROUP BY node.title
		ORDER BY node.left_node
	) as subTree
	WHERE node.parent_course_id = parentCourse
	AND parent.parent_course_id = parentCourse
	AND subParent.parent_course_id = parentCourse
	AND node.left_node BETWEEN parent.left_node AND parent.right_node
	AND node.left_node BETWEEN subParent.left_node AND subParent.right_node
	AND subParent.title = subTree.title
	AND node.id <> queriedCourseNode 
	AND node.deleted_at IS NULL
	GROUP BY node.title
	HAVING depth = queriedDepth
	ORDER BY node.left_node;

END
DEPTH_NODES
            );
            /*
                        DB::unprepared(<<<REMOVE_NODE
            DROP PROCEDURE IF EXISTS removeNodeById;
            CREATE PROCEDURE removeNodeById(
                IN chapter_id BIGINT
            )

            BEGIN
                SELECT @delete_left := left_node, @delete_right := right_node, @parent_course_id := parent_course_id
                FROM course_chapter
                WHERE id = chapter_id;

                UPDATE course_chapter SET left_node = IF (left_node > @delete_left, left_node -2, left_node)
                , right_node = IF(right_node > @delete_right, right_node -2, right_node)
                WHERE right_node > @delete_right;

                DELETE course_chapter, chapter_quiz
                FROM course_chapter
                LEFT JOIN chapter_quiz ON course_chapter.id = chapter_quiz.chapter_id
                WHERE course_chapter.id = chapter_id;
            END
            REMOVE_NODE
                        );
            */

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_chapter');
    }
}
