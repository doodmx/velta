@csrf

<!-- Name input -->
<div class="md-form form-group form-lg mt-5">
    {{ Form::text('role[name]',
        isset($role) ? $role->name : null, [
        'class' => 'form-control',
        'placeholder' => 'Nombre del rol.',
        'data-parsley-maxlength' => '150',
        'data-parsley-required' => true
    ]) }}
    <label for="txtTitle">Nombre</label>
</div>
<!-- Name input -->


<div class="row">
    <div class="col-12">
        @include('admin.roles.permissions_module',[
             'module' => 'Panel de Administración',
             'permissions' =>    $permissions->where('module','admin_panel')
         ])
    </div>


</div>
<div class="row">
    <div class="col-12 col-lg-6 px-4">


        @include('admin.roles.permissions_module',[
            'module' => 'Usuarios',
            'permissions' =>    $permissions->where('module','users')
        ])


        @include('admin.roles.permissions_module',[
           'module' => 'Etiquetas (Blog)',
           'permissions' =>    $permissions->where('module','tags')
       ])

        @include('admin.roles.permissions_module',[
           'module' => 'Publicaciones (Blog)',
           'permissions' =>    $permissions->where('module','blogs')
       ])

        @include('admin.roles.permissions_module',[
          'module' => 'Categorías (Cursos)',
          'permissions' =>    $permissions->where('module','course_categories')
      ])

        @include('admin.roles.permissions_module',[
          'module' => 'Cuestionarios de Certificación (Cursos)',
          'permissions' =>    $permissions->where('module','quizzes')
      ])


    </div>

    <div class="col-12 col-lg-6 px-4">
        @include('admin.roles.permissions_module',[
               'module' => 'Roles de usuario',
               'permissions' =>    $permissions->where('module','roles')
       ])

        @include('admin.roles.permissions_module',[
            'module' => 'Categorías (Blog)',
            'permissions' =>    $permissions->where('module','blog_categories')
        ])

        @include('admin.roles.permissions_module',[
           'module' => 'Cursos',
           'permissions' =>    $permissions->where('module','courses')
       ])

        @include('admin.roles.permissions_module',[
          'module' => 'Capítulos (Cursos)',
          'permissions' =>    $permissions->where('module','chapters')
      ])
    </div>
</div>


<div class="mt-5 d-flex justify-content-end border-top pt-3 pb-5">



    <button type="button" class="btn btn-primary btn-lg btn-rounded font-weight-bold" id="btnSaveRole">
        <i class="fa fa-save"></i> Guardar
    </button>

</div>


