@extends('layouts.'.$layout.'.app')

@section('breadcrumb')

    @include('_partials/breadcrumb',[
          'module'=>'Mi Perfil',
          'routes' =>[
                [
                  'description' => 'Inicio',
                  'url' => route('welcome')
              ],
              [
                  'description' => 'Mi Perfil'
              ]

          ]
        ])

@endsection
@section('content')


    {{Form::open(['id'=>'frmProfile','class'=>'','data-parsley-validate'=>true])}}

    @method('PATCH')




    <div class="container shadow rounded-lg p-5">


        <!-- USER AVATAR -->
        <div class="avatar-container">

            <img id="avatarPreview"
                 src="{{isset($user) && !empty($user->profile->photo) ? asset($user->profile->photo) : "https://cdn.veltacorp.com/img/user.png"}}"
                 alt=""/>

            <!-- FILE PICKER -->
            <div class="file-field position-absolute" style="bottom:0px;right:0px;">
                <a class="btn-floating btn-primary btn-sm">
                    <i class="fas fa-paperclip font-weight-bold" aria-hidden="true"></i>

                    <input
                            type="file"
                            name="photo"
                            data-parsley-filemaxmegabytes="2"
                            data-parsley-trigger="change"
                            data-parsley-filemimetypes="image/png,image/jpg,image/bmp,image/gif,image/jpeg"
                            data-parsley-errors-container="#errorAvatar"
                    >
                </a>
            </div>
            <!--FILE PICKER -->

        </div>
        <!--USER AVATAR -->
        <div class="red-text font-small text-center d-block" role="alert" id="errorAvatar"></div>


        @include('admin/users/fields',[
            'module'=>'Profile',
            'user'=>$user,
            'hideMembership' => true,
            'proofResidence' => $proofResidence,
            'idCard' => $idCard
        ])

        <hr class="my-5 bg-white">

        <div class="row justify-content-end">
            <div class="col-12">
                <button type="submit" class="btn btn-lg btn-primary btn-rounded float-right clearfix">
                    <i class="fas fa-save"></i>
                    {{__('my_investors.update')}}
                </button>
            </div>
        </div>

    </div>



    {{Form::close()}}

    <a href="" id="localData" data-user="{{$user->id}}"></a>

@endsection

@section('styles')
    <link rel="stylesheet" href="{{asset(mix('css/admin_panel/user/profile.css'))}}">
@endsection

@section('scripts')
    <script src="{{asset(mix('js/admin_panel/user/profile.js'))}}"></script>
@endsection
