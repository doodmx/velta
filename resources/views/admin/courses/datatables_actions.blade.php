<div class="btn-group">
    <button type="button" class="btn-floating btn-primary btn-sm dropdown-toggle py-0 my-0"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-ellipsis-v"></i>
    </button>
    <div class="dropdown-menu text-secondary-two">
        @if(auth()->user()->hasPermissionTo('edit_course') || auth()->user()->hasRole('Super Admin'))
            <a class="dropdown-item mb-2" href="{{route('courses.edit',[$id])}}"><i class="fas fa-edit"></i> Editar</a>
            @if(empty($deleted_at))
                <a class="dropdown-item deactivateCourse" href="#" data-id="{{$id}}">
                    <i class="fas fa-trash"></i> Eliminar
                </a>
            @else
                <a class="dropdown-item activateCourse" href="#" data-id="{{$id}}">
                    <i class="fas fa-sync"></i> Restaurar
                </a>
            @endif
            <hr class="special-color my-2">
            <a class="dropdown-item" href="{{route('chapters.index',[$id])}}">
                <i class="fas fa-video"></i> Capítulos
            </a>
            @if(count($chapters) >0)
                <a class="dropdown-item" href="{{route('quiz.create',[$id,$chapters[0]['id']])}}">
                    <i class="fas fa-question-circle"></i> Cuestionario de Certificación
                </a>
            @endif

        @endif
    </div>
</div>
