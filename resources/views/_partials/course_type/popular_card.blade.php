<!-- First row -->
<div class="row pb-2 pt-3 wow fadeIn"
     data-wow-delay="0.4s"
     style="visibility: visible; animation-name: fadeIn; animation-delay: 0.4s;">

    <!-- First column -->
    <div class="col-lg-3">

        <!-- Image -->
        <div class="view overlay mb-3 z-depth-1">

            <img src="{{asset('storage/'.$category->image)}}" class="img-fluid z-depth-1"
                 alt="Cursos {{$category->seo->image_alt}}"
            >

            <div class="mask rgba-white-slight"></div>

        </div>
        <!-- Image -->

    </div>
    <!-- First column -->

    <!-- Second column -->
    <div class="col-lg-9 add-margins-2">

        <!-- Excerpt -->
        <h3 class="text-uppercase">
            <a href="{{route('web.courses.all',['category' => $category->seo->slug])}}"
               class="text-uppercase text-lime-green font-weight-bold">
                {{$category->name}}
            </a>
        </h3>

        <h5 class="mb-3 white-text">
            @if($category->doubts_count > 0)
                <span class="list-inline-item pr-2">
                    <i class="fas fa-comments pr-1"></i> {{$category->doubts_count}}
                </span>
            @endif

            @if($category->enrolls_count > 0)
                <span class="list-inline-item pr-2">
                        <i class="fas fa-users pr-1"></i> {{$category->enrolls_count}}
                </span>
            @endif
        </h5>

        <p class="white-text font-thin text-justify">
            {{$category->description}}
        </p>

        <!-- Excerpt -->

        <a href="{{route('web.courses.all',['category' => $category->seo->slug])}}" class="btn btn-lime-green btn-rounded btn-md font-weight-bold waves-effect waves-light float-lg-right clearfix">
            Ver Cursos
        </a>
    </div>

    <!-- Second column -->
</div>

<!-- First row -->
