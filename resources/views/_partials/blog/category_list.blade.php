<!--  Card -->

<h3 class="h3-responsive text-primary font-weight-bold">
    {{ __('web/blog.categories') }}
</h3>

<ul class="list-group list-group-flush mt-3">
    @foreach($categories as $category)

        @if($category->relatedPosts->count() > 0)
            <li class="list-group-item border-bottom  bg-transparent d-flex justify-content-between align-items-center">
                <a href="{{route('web.blog.index',['category'=> $category->category])}}"
                   class="text-secondary-two">
                    <p class="mb-0">{{$category->category}}</p>
                </a>
                <span class="badge badge-secondary-two  font-small p-2">
                            <b class="">{{$category->relatedPosts->count()}}</b>
                        </span>
            </li>
        @endif

    @endforeach

</ul>

