<!--  Card -->
@if($relatedPosts->count() > 0)



    <h3 class="h3-responsive text-primary font-weight-bolder">
        {{ __('web/blog.related_posts') }}
    </h3>


    <div class="posts mt-4">


    @foreach($relatedPosts as $relatedPost)
        <!-- Grid row -->
            <div class="row mb-5">
                <div class="col-3">

                    <!-- Image -->
                    <div class="view overlay">
                        <img src="{{asset('storage/'.$relatedPost->detail_image)}}"
                             class="img-fluid z-depth-1 "
                             alt="{{$relatedPost->title}}">
                        <a href="{{route('web.blog.show',[$relatedPost->seo->slug])}}">
                            <div class="mask rgba-white-slight waves-effect waves-light"></div>
                        </a>
                    </div>
                </div>

                <!-- Excerpt -->
                <div class="col-9">
                    <h6 class="mt-0 font-small">
                        <a href="{{route('web.blog.show',[$relatedPost->seo->slug])}}"
                           class="font-weight-bold text-secondary-two">
                            <strong>{{$relatedPost->title}}</strong>
                        </a>
                    </h6>

                    <div class="post-data">
                        <p class="font-small mb-0">
                            <i class="far fa-clock-o"></i> {{$relatedPost->date_to_publish->format('d/F/Y')}}
                        </p>
                    </div>
                </div>
                <!--  Excerpt -->
            </div>
            <!--  Grid row -->
        @endforeach
    </div>



@endif
