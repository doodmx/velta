<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Interfaces\Course\ChapterInterface;
use App\Interfaces\Helpers\StorageInterface;
use App\Http\Requests\Course\CreateChapterRequest;
use App\Http\Requests\Course\UpdateChapterRequest;
use App\Http\Resources\Course\Chapter as ChapterResource;

class ChapterController extends Controller
{
    private $chapters, $rootNode;

    public function __construct(ChapterInterface $chapter)
    {
        $this->chapters = $chapter;
        $this->rootNode = $this->chapters->showRoot(request()->course_id);
    }

    public function index($courseId)
    {
        $chapters = $this->chapters->showChapters($courseId, $this->rootNode->id);


        return view('admin.courses.chapters.index')
            ->with('rootChapter', $this->rootNode)
            ->with('chapters', $chapters);
    }

    public function store(CreateChapterRequest $request, StorageInterface $filesContract)
    {

        $data = $request->all();
        $data['icon'] = null;
        $files = $request->allFiles();

        if (isset($files['icon'])) {
            $imagePath = $filesContract->save('courses/', $files['icon']);
            $data['icon'] = $imagePath;
        }

        $chapter = $this->chapters->add($data);


        $hasDepthOne = intval($request['parent_node_id']) === $this->rootNode->id;
        $view = $hasDepthOne ? 'chapter' : 'chapter_node';
        $parameterName = $hasDepthOne ? 'chapter' : 'chapterNode';
        $parentNode = $hasDepthOne ? $this->rootNode->id : $request['parent_node_id'];


        return response()->json([
            'message' => 'Capítulo actualizado correctamente',
            'view'    => view('admin.courses.chapters.templates.' . $view)
                ->with([
                    $parameterName => $chapter,
                    'parentNode'   => $parentNode
                ])
                ->render()
        ], 201);
    }

    public function show($courseId, $chapterId)
    {

        $chapter = $this->chapters->show($chapterId);

        return new ChapterResource($chapter);

    }

    public function update(UpdateChapterRequest $request, StorageInterface $filesContract)
    {

        $data = $request->all();

        $files = $request->allFiles();

        if (isset($files['icon'])) {
            $imagePath = $filesContract->save('courses/', $files['icon']);
            $data['icon'] = $imagePath;
        }
        $chapter = $this->chapters->update($request->id, $data);



        $hasDepthOne = intval($request['parent_node_id']) === $this->rootNode->id;
        $view = $hasDepthOne ? 'chapter' : 'chapter_node';
        $parameterName = $hasDepthOne ? 'chapter' : 'chapterNode';
        $parentNode = $hasDepthOne ? $this->rootNode->id : $request['parent_node_id'];

        return response()->json([
            'message' => 'Capítulo actualizado correctamente',
            'view'    => view('admin.courses.chapters.templates.' . $view)
                ->with([
                    $parameterName => $chapter,
                    'parentNode'   => $parentNode
                ])
                ->render()
        ], 200);
    }

    public function delete($courseId, $chapterId)
    {
        $this->chapters->delete($chapterId);
        return response()->json([
            'message' => 'Capítulo eliminado correctamente'
        ]);
    }
}
