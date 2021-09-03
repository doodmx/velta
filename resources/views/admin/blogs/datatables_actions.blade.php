<div class="btn-group">
    <button type="button" class="btn-floating btn-sm  btn-primary  dropdown-toggle py-0 my-0"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-ellipsis-v"></i>
    </button>
    <div class="dropdown-menu">
        @if(auth()->user()->hasPermissionTo('edit_blog') || auth()->user()->hasRole('Super Admin'))
            <a class="dropdown-item edit-category mb-2" href="{{route('blogs.edit',$id)}}">
                <i class="fas fa-edit"></i>
                Editar
            </a>
            @if($status==1)
                <a class="dropdown-item hide-blog mb-2 deactivate-blog" data-id="{{$id}}">
                    <i class="fas fa-times"></i>
                    Ocultar
                </a>
            @else
                <a class="dropdown-item show-blog mb-2 deactivate-blog" data-id="{{$id}}">
                    <i class="fas fa-file-text-o"></i>
                    Publicar
                </a>
            @endif

        @endif
    </div>
</div>


