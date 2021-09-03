@extends('layouts.admin.app')


@section('breadcrumb')

    @include('_partials/breadcrumb',[
          'module'=>'Publicaciones',
          'routes' =>[
                [
                  'description' => 'Inicio',
                  'url' => route('welcome')
              ],
              [
                  'description' => 'Publicaciones',
                   'url' => route('blogs.index')
              ],
              [
                    'description' => isset($blog)? $blog->title:'Nueva'
              ]

          ]
        ])

@endsection

@section('content')



    <form id="postForm"
          data-blog_id="{{isset($blog)?$blog->id:null}}"
          data-action="{{isset($blog)?'/admin/blogs/'.$blog->id:'/admin/blogs'}}"
    >

        @csrf

        <div class="container p-0 rounded">

            <div id="smartwizard" class=" rounded shadow">
                <ul>
                    <li>
                        <a href="#step-1">Información General</a>
                    </li>
                    <li>
                        <a href="#step-2">Artículo</a>
                    </li>
                    <li>
                        <a href="#step-3">SEO</a>
                    </li>
                    <li>
                        <a href="#step-4">Confirmación</a>
                    </li>

                </ul>

                <div class="p-1 p-lg-5">

                    <!--STEP 1 --->
                    <div id="step-1">

                        <div class="step-content-container">
                            @include('_partials/blog/steps/general')
                        </div>

                    </div>
                    <!-- END STEP 1-->


                    <!-- STEP 2 -->
                    <div id="step-2" class="">
                        <div class="step-content-container">
                            @include('_partials/blog/steps/article')
                        </div>
                    </div>
                    <!-- END STEP 2-->

                    <!-- STEP 3-->
                    <div id="step-3" class="">
                        <div class="step-content-container">
                            @include('_partials/blog/steps/seo')
                        </div>
                    </div>
                    <!-- END STEP 3-->


                    <!--STEP 4 -->
                    <div id="step-4">
                        <div class="step-content-container">
                            @include('_partials/blog/steps/confirmation')
                        </div>
                    </div>
                    <!--END STEP 3 -->


                </div>


            </div>
        </div>
    </form>


@endsection


@section('scripts')

    <script src="https://cdn.ckeditor.com/4.14.0/standard-all/ckeditor.js"></script>
    <script type="text/javascript" src="{{asset(mix('js/admin_panel/blog/app.js'))}}"></script>

@endsection()
