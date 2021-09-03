<div class="col-12 col-md-6 col-lg-4 my-2 ">
    <div class="card blog-card border-0 shadow">
        <img src="{{asset('storage/'.$blog->detail_image)}}" alt="{{$blog->title}}" class="card-img-top">

        <div class="card-body d-flex flex-column justify-content-around">
            <!-- Excerpt -->
            <a href="{{route('web.blog.index',['category'=>$blog->categories[0]->category])}}"
               class="lead">
                <h6 class="pb-1 text-secondary-two"><strong> {{$blog->categories[0]->category}} </strong></h6>
            </a>
            <h4 class=" text-primary font-weight.bold mb-3"><strong>{{$blog->title}}</strong></h4>
            <p class="text-secondary text-justify">{{$blog->extract}}</p>
            <p>by <a><strong>{{$blog->author}}</strong></a>, {{$blog->date_to_publish->format('d F Y')}}
            </p>
            <a class="btn btn-primary btn-rounded font-weight-bolder"
               href="{{route('web.blog.show',$blog->seo->slug)}}">

                {!! __('web/blog.read_button') !!}
            </a>
        </div>
    </div>
</div>
