<div class="mt-5">
    <h5 class="text-secondary-two font-weight-bold">
        {{$module}}
    </h5>
    <hr class="bg-white">

    @foreach($permissions as $permission)

        <div class="form-check mt-2">
            <input
                    id="permission-{{$permission->id}}"
                    class="form-check-input"
                    name="permissions[]"
                    value="{{$permission->id}}"
                    type="checkbox"
                    {{isset($role) ? (array_search($permission->id,array_column($role->permissions->toArray(),'id')) ===false?'':'checked'):''  }}
            >
            <label class="form-check-label" for="permission-{{$permission->id}}">
                {{$permission->description}}
            </label>
        </div>
    @endforeach

</div>
