@extends('layouts.admin.app')

@section('breadcrumb')
    @include('_partials/breadcrumb',[
          'module'=>'Capítulos del Curso',
          'routes' =>[
                [
                  'description' => 'Inicio',
                  'url' => route('welcome')
                ],
                [
                  'description' => 'Cursos',
                   'url' => route('courses.index')
                ],
                [
                  'description' => $rootChapter->course->name,
                   'url' => route('courses.edit',$rootChapter->parent_course_id)
                ],
                [
                   'description' => 'Capítulos'
                ]
          ]
        ])
@endsection

@section('content')
    @include('admin.courses.chapters.modals.create_chapter')


    <div class="container shadow p-5 rounded">

        <div class="row">
            <div class="col-12">
                <h1 class=" d-flex flex-column flex-lg-row justify-content-end">

                    @if(auth()->user()->hasPermissionTo('create_chapter') || auth()->user()->hasRole('Super Admin') && app()->getLocale() === 'es')
                        <button type="button" id="btnOpenChapterModal"
                                class="btn btn-primary btn-rounded waves-effect waves-light btn-add-chapter"
                                data-parent_node="{{$rootChapter->id}}"
                                data-chapters_container="#accordionChapters"

                        >
                            <i class="fas fa-plus"></i> Nuevo
                        </button>
                    @endif
                </h1>

            </div>
        </div>

        <section class="mt-4">
            <!--Accordion wrapper-->
            <div class="accordion md-accordion accordion-blocks " id="accordionChapters" role="tablist"
                 aria-multiselectable="true">
                @foreach($chapters as $chapter)

                    @include('admin.courses.chapters.templates.chapter',['chapter'=>$chapter,'parentNode'=>$rootChapter->id ])

                @endforeach
            </div>
            <!--/.Accordion wrapper-->
        </section>

    </div>

    <a href="#" id="localData" data-course="{{request()->course_id}}"></a>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{asset(mix('js/admin_panel/course/chapter/app.js'))}}"></script>
@endsection()
