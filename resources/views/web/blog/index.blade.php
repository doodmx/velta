@extends('layouts.web.app')


@section('title')
    <title>Azell FT | Registro</title>
@endsection

@section('intro')
    <!-- Intro Section -->
    <div class="view jarallax" data-jarallax='{"speed": 0.2}'
         style="background-image: url('https://cdn.veltacorp.com/img/fondo_nosotros2.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
        <div class="mask rgba-black-strong  ">
            <div class="container h-100 d-flex justify-content-center align-items-center">
                <div class="row pt-5 mt-3">
                    <div class="col-md-12">
                        <div class="text-center">
                            <h1 class="h1-responsive white-text text-uppercase font-weight-bold mb-3 wow fadeInDown"
                                data-wow-delay="0.3s">
                                {!! __('web/blog.title') !!}
                            </h1>
                            <h4 class="mb-5 white-text wow fadeInDown" data-wow-delay="0.4s">
                                {!! __('web/blog.subtitle') !!}
                            </h4>
                            <a class="btn btn-primary btn-rounded btn-lg font-weight-bold wow fadeInDown"
                               data-wow-delay="0.4s"
                               href="{{route('membership')}}">{!! __('web/blog.want_to_invest') !!}</a>
                            <a class="btn btn-primary btn-lg btn-rounded font-weight-bold wow fadeInDown"
                               data-wow-delay="0.4s" href="{{route('we_do')}}">{!! __('web/blog.learn_more') !!}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')




    <div class="container white-text">

        <!-- Section: Blog v.3 -->
        <section class="my-5 text-center text-lg-left wow fadeIn" data-wow-delay="0.3s">


            @if(!empty($filter) && !$blogs->isEmpty())
                <div class="row text-center mb-5">
                    <div class="col-12">
                        <h2 class="font-weight-bold text-primary">  {!! __('web/blog.success_search') !!}</h2>
                        <p class="font-medium lead text-secondary font-weight-bolder">{{$filter}}</p>
                    </div>

                </div>
            @endif

            @if($blogs->isEmpty())
                <div class="row text-center mb-5">
                    <div class="col-12">
                        <h2 class="font-weight-bold text-primary">  {!! __('web/blog.wrong_search') !!}</h2>
                        <p class="font-medium lead text-secondary font-weight-bolder">{{$filter}}</p>
                    </div>

                </div>
            @endif

            @if(!$blogs->isEmpty())
            <!-- Section heading -->
                <h2 class="text-primary text-center mt-5 h1-responsive font-weight-bold">
                    {!! __('web/blog.recent_posts') !!}
                </h2>

                <!-- Section description -->
                <p class="text-secondary lead text-center mt-3 mb-5 w-responsive mx-auto">
                    {!! __('web/blog.recent_posts_copy') !!}
                </p>



                <div class="flex row wrap">
                    @foreach($blogs as $blog)
                        @include('_partials/blog/postCard',['blog' => $blog])
                    @endforeach
                </div>




                {{ $blogs->links() }}
            @endif


        </section>
        <!-- Section: Blog v.3 -->

        <hr class="mb-5 white">

        <!-- Section: Blog v.2 -->
        @if($oldPosts->count()>0)
            <section class="text-center my-5 wow fadeIn" data-wow-delay="0.3s">

                <!-- Section heading -->
                <h2 class=" h2-responsive text-primary text-center my-5 h1">
                    {!! __('web/blog.older_posts') !!}
                </h2>


                <div class="flex row wrap">
                    @foreach($oldPosts as $oldPost)
                        @include('_partials/blog/postCard',['blog' => $oldPost])
                    @endforeach
                </div>

            </section>
            <!-- Section: Blog v.2 -->
        @endif
    </div>


@endsection



@section('styles')
    {{Html::style(asset(mix('css/web/blog.index.css')))}}
@endsection





