<?php

use Faker\Factory;
use App\Models\Course\Course;
use App\Interfaces\Course\ChapterInterface;
use Illuminate\Database\Seeder;

class CourseChapterSeeder extends Seeder
{

    private $chapters;

    public function __construct(ChapterInterface $chapterContract)
    {
        $this->chapters = $chapterContract;
    }

    public function run()
    {

        $faker = Factory::create(Factory::DEFAULT_LOCALE);
        $courses = Course::get();

        $videoLinks = [
            'https://player.vimeo.com/video/411654172',
            'https://player.vimeo.com/video/392076340',
            'https://player.vimeo.com/video/420104702',
            'https://player.vimeo.com/video/416545442',
            'https://player.vimeo.com/video/416227914'
        ];


        $nodes = [
            [
                'main_category' => 'Introducción',
                'childs'        => [
                    'Que es Angular ?',
                    'Angular CLI',
                    'Configuracion de nuestro primer proyecto',
                    'Estructura del Curso',
                    '¿Que es Typescript?',
                ]
            ],
            [
                'main_category' => 'Básicos',
                'childs'        => [
                    'Componentes',
                    'Databinding',
                    'Property binding',
                    'String interpolation',
                    'Event binding',
                ]
            ],
            [
                'main_category' => 'Forms',
                'childs'        => [
                    'Template Driven',
                    'Reactive Forms',
                    'Resetting a Form',
                    'Validation',
                    'Form Array',
                ]
            ]
        ];


        foreach ($courses as $course) {


            $rootNode = $this->chapters->addRoot($course->id);

            foreach ($nodes as $node) {

                $parentNode = $this->chapters->add([
                    'parent_node_id'   => $rootNode->id,
                    'parent_course_id' => $course->id,
                    'title'            => $node['main_category'],
                    'url'              => null,
                    'description'      => $faker->text,
                    'icon'             => null
                ]);

                foreach ($node['childs'] as $child) {

                    $this->chapters->add([
                        'parent_node_id'   => $parentNode->id,
                        'parent_course_id' => $course->id,
                        'title'            => $child,
                        'url'              => $videoLinks[random_int(0, 4)],
                        'description'      => $faker->text,
                        'icon'             => null
                    ]);

                }

            }

        }


    }
}
