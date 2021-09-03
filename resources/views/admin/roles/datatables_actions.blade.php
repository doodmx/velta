<div class="btn-group">
    <button type="button" class="btn-floating btn-sm  btn-primary  dropdown-toggle py-0 my-0"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-ellipsis-v"></i>
    </button>
    <div class="dropdown-menu">
        @if(auth()->user()->hasPermissionTo('edit_role') || auth()->user()->hasRole('Super Admin'))
            <a class="dropdown-item mb-2" href="{{route('roles.edit',[$id])}}"><i class="fas fa-edit"></i> Editar</a>
            @if(empty($deleted_at) && $name !=='Super Admin')
                <a class="dropdown-item deactivateRole" href="#" data-id="{{$id}}">
                    <i class="fas fa-trash"></i> Eliminar
                </a>
            @elseif($name !=='Super Admin')
                <a class="dropdown-item activateRole" href="#" data-id="{{$id}}">
                    <i class="fas fa-sync"></i> Restaurar
                </a>
            @endif
        @endif
    </div>
</div>
