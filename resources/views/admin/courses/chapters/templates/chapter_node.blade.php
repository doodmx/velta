<!-- Chapter Node -->
<section id="chapterNode{{$chapterNode->id}}"
         class="chapter-node d-flex justify-content-between align-items-center w-100 p-0 py-1 border-bottom"
>

    <div class="d-flex align-items-center btn-edit-chapter-node py-3">

        <a class="btn-floating btn-md btn-secondary-two d-none d-sm-inline-flex mr-4">
            <i class="fab fa-vimeo-square fa-2x"></i>
        </a>

        <div class="flex-grow-1">

            <div class="white-text cursor-pointer">

                @if(app()->getLocale() === 'es')
                    <h5 class="h5-responsive text-primary font-weight-bold">
                        {{$chapterNode->original_title}}
                    </h5>
                @else
                    <h5 class="h5-responsive text-primary font-weight-bold mb-1">
                        {{$chapterNode->localized_title ? $chapterNode->localized_title : 'Sin traducción'}}
                    </h5>
                    <div class="text-secondary-two">
                        <div class="d-inline-block iti-flag mx"></div>
                        <div class="d-inline-block">{{$chapterNode->original_title}}</div>
                    </div>
                @endif

            </div>

            <div class="mt-2 text-justify text-secondary">
                @if(app()->getLocale() === 'es')
                    {{$chapterNode->original_description}}
                @else
                    {{$chapterNode->localized_description ? $chapterNode->localized_description  : 'Descripción sin traducción'}}
                @endif
            </div>
        </div>
    </div>
    <!--Options-->
    <div class="btn-group">
        <button type="button" class="btn-floating btn-sm  btn-primary  dropdown-toggle py-0 my-0"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v"></i>
        </button>
        <div class="dropdown-menu">
            <a class="dropdown-item btn-edit-chapter"
               href="#"
               data-id="{{$chapterNode->id}}"
               data-parent_node="{{$parentNode}}"
               data-chapter_element="#chapterNode{{$chapterNode->id}}"
            >
                <i class="fas fa-edit"></i> Editar
            </a>
            <a
                class="dropdown-item btn-delete-chapter"
                href="#"
                data-id="{{$chapterNode->id}}"
                data-count_node="{{$parentNode}}"
                data-chapter_element="#chapterNode{{$chapterNode->id}}"
            >
                <i class="fas fa-trash"></i> Eliminar
            </a>
        </div>
    </div>
</section>
<!-- Chapter Node -->
