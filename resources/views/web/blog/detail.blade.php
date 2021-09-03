@extends('layouts.web.app')





@section('content')

    <div class="container-fluid main-padding">

        <div class="card bg-transparent shadow-none">




            <div class="card-body p-0">

                <!-- Grid row -->
                <div class="row no-gutters">

                    <!-- Blog Content -->
                    <div class="col-lg-8 col-12">
                        <!-- Card -->

                        <div class="card-body">


                            <img class="d-block mx-auto shadow"
                                 style="max-height: 400px;object-position: center;object-fit: cover;"
                                 src="{{asset($blog->detail_image)}}"
                                 alt="Velta {{$blog->title}}">

                            <!-- Section heading -->
                            <h1 class="h1-responsive text-primary text-center mt-5">
                                <strong>{{$blog->title}}</strong>
                            </h1>

                            <div class="row text-secondary">
                                <div class="col-md-12 col-xl-12 d-flex justify-content-center">
                                    <p class="lead mb-1 text-uppercase">
                                        {!! __('web/blog.written_by') !!}
                                        <strong> {{$blog->author}}</strong>
                                    </p>
                                    <p class="lead mb-0 ml-3">
                                        <i class="far fa-clock-o dark-grey-text"></i>
                                        {{$blog->date_to_publish->format('d F Y')}}
                                    </p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    @include('_partials/blog/tag_list')
                                </div>
                            </div>

                            <!-- Grid row -->
                            <div class="row pt-lg-5 pt-3">
                                <div class="col-md-12 col-xl-12">
                                    {!! $blog->content !!}
                                </div>
                            </div>
                            <!-- Grid row -->


                        </div>


                        <!-- Card -->
                    </div>
                    <!-- Grid column -->


                    <!-- Blog Sidebar -->
                    <div class="col-lg-4 col-12 ">

                        <div class="container">

                            <!-- Section: Search Input -->
                            <section class="section">
                                @include('_partials/blog/search_input')
                            </section>
                            <!--  Section: Search input -->

                            <hr class="my-5">

                            <!-- Section: Related posts -->
                            <section class="section widget-content">
                                @include('_partials/blog/related_posts')
                            </section>
                            <!--  Section: Related posts -->

                            <hr class="my-5">

                            <!-- Section: Categories -->
                            <section class="section">
                                @include('_partials/blog/category_list')
                            </section>
                            <!-- Section: Categories -->

                            <hr class="my-5">

                            <!-- Section: Tags -->
                            <section class="section">
                                @include('_partials/blog/tag_list')
                            </section>
                            <!-- Section: Tags -->

                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Grid row -->


        <div class="row my-5 justify-content-center">
            <div class="col-12 col-lg-6 pr-lg-2">

                @include('_partials/components/contact_card')

            </div>
            <div class="col-12 col-lg-6 mt-3 mt-lg-0">
                @include('_partials/components/appointment_card')

            </div>
        </div>
    </div>

@endsection()

@section('styles')
    {{Html::style(asset(mix('css/web/blog.detail.css')))}}
@endsection

@section('scripts')
    <script src="{{ asset(mix('js/web/contact.js')) }}"></script>
@endsection





