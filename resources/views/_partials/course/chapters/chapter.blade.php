<!-- Accordion card -->
<div id="chapter{{$chapter->id}}"
     class="chapter card bg-transparent shadow-none py-3"
     data-chapter="{{json_encode($chapter)}}">
    <!-- Card header -->
    <div class="card-header d-flex justify-content-between align-items-center w-100 px-0 py-2 bg-transparent" role="tab"
         id="headingChapter{{$chapter->id}}">


    @if($chapter->nodes->count()>0)
        <!-- Collapse -->

            <a class="btn-floating btn-sm btn-secondary-two align-items-start mr-4 flex-grow-1"
               data-toggle="collapse"
               data-parent="#accordionChapters" href="#collapseChapter{{$chapter->id}}" aria-expanded="false"
               aria-controls="collapseChapter{{$chapter->id}}">
                <i class="fas fa-angle-down rotate-icon"></i>
            </a>

        @endif

        @if(isset($chapter->is_done) && empty($course->approval_certificate))
            <div class="form-check d-inline-block">
                <input
                    type="checkbox"
                    id="{{$chapter->title}}-{{$chapter->id}}"
                    class="form-check-input chapter-done"
                    {{$chapter->is_done ? 'checked':''}}
                    data-chapter="{{$chapter->id}}"

                >
                <label class="form-check-label"
                       for="{{$chapter->title}}-{{$chapter->id}}"></label>
            </div>
        @endif

    <!--Title-->
        <div class="w-100 btn-edit-chapter cursor-pointer {{!empty($chapter->video_link)?'chapter-link':''}}">
            @if(app()->getLocale() === 'es')
                <h5 class="h5-responsive text-primary font-weight-bold">{{$chapter->original_title}}</h5>
            @else
                <h5 class="h5-responsive text-primary font-weight-bold">
                    {{$chapter->localized_title}}
                </h5>
            @endif

            <div class="mt-3 text-justify text-secondary-two">
                @if(app()->getLocale() === 'es')
                    {{$chapter->original_description}}
                @else
                    {{$chapter->localized_description   }}
                @endif
            </div>
        </div>


        <!--Options-->

        @if($chapter->nodes->where('depth','>',0)->count() > 0)
            <h5>
            <span class="badge badge-secondary">
                <span class="count" id="count{{$chapter->id}}">{{$chapter->nodes->where('depth','>',0)->count()}}</span> capítulos
            </span>
            </h5>
        @endif

    </div>
    <!-- Card body -->
    <div id="collapseChapter{{$chapter->id}}" class="collapse" role="tabpanel"
         aria-labelledby="headingChapter{{$chapter->id}}"
         data-parent="#accordionChapters">
        <div class="card-body py-0 bg-transparent" id="collapseChapterBody{{$chapter->id}}">
            <div class="my-2">
                @each('_partials.course.chapters.chapter_node', $chapter->nodes, 'chapterNode')

            </div>
        </div>
    </div>
</div>
<!-- Accordion card -->
