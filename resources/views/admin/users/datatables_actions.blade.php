<div class="btn-group">
    <button type="button" class="btn-floating btn-sm btn-primary dropdown-toggle py-0 my-0"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-ellipsis-v"></i>
    </button>
    <div class="dropdown-menu"
         data-id="{{$id}}"
         data-name="{{$name}}"
         data-lastname="{{$lastname}}"
         data-membership="{{$membership}}"
         data-email="{{$email}}"
         data-whatsapp="{{$whatsapp}}"
         data-id_card="{{$id_card}}"
         data-proof_residence="{{$proof_residence}}"
         data-role="{{$roles[0]['name']}}"
    >

        {{--
         @if((auth()->user()->hasPermissionTo('change_role_user') || auth()->user()->hasRole('Super Admin'))  && ($roles[0]['name'] !=='Partner' && $roles[0]['name'] !=='Super Admin '))
         --}}
        <a class="dropdown-item" href="{{route('users.investment.show',[$id])}}">
            <i class="far fa-id-card"></i> Detalle de Inversión
        </a>
        {{--
        @endif
        --}}

        @if((auth()->user()->hasPermissionTo('verify_account') || auth()->user()->hasRole('Super Admin')) && is_null($password) && $roles[0]['name'] ==='Partner')
            <a class="dropdown-item btn-account-verification">
                <i class="fas fa-user-check"></i> Verificar Cuenta
            </a>
        @endif


        @if((auth()->user()->hasPermissionTo('change_role_user') || auth()->user()->hasRole('Super Admin'))  && ($roles[0]['name'] !=='Partner' && $roles[0]['name'] !=='Super Admin '))
            <a class="dropdown-item btn-view-role">
                <i class="fas fa-user-check"></i> Cambiar Rol
            </a>
        @endif


        @if(!empty($password) || $roles[0]['name'] ==='Investment')
            <a class="dropdown-item btn-view-information">
                <i class="fas fa-info"></i>
                {{__('my_investors.view_profile')}}
            </a>
        @endif


        @if($roles[0]['name'] !=='Investment' && !empty($password))
            <a class="dropdown-item btn-reset-password">
                <i class="fas fa-key"></i> Cambiar Contraseña
            </a>
        @endif

        @if((auth()->user()->hasPermissionTo('delete_users') || !auth()->user()->hasRole('Super Admin')))
            <a class="dropdown-item delete-user">
                <i class="fas fa-trash"></i>
                {{__('my_investors.delete')}}
            </a>
        @endif


    </div>
</div>

