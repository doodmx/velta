<div class="tags mt-3">
    @foreach($tags as $tag)

        <a href="{{route("web.blog.index",['tag'=>$tag->tag])}}"
           class="badge badge-secondary-two p-2 d-inline-block m-1">
            <span class="text-lime-green font-medium"> <i class="fas fa-tag"></i> {{$tag->tag }}</span>
        </a>
    @endforeach
</div>



