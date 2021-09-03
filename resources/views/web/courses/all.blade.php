@extends('layouts.web.app',['removeFooter' =>true])



@section('content')


    <div class="d-flex flex-column flex-1 courses-container">

        <div class="d-flex flex-1" style="overflow-y: hidden;">

            <div class="col-3 bg-white p-4 shadow-lg">


                <ul class="list-group list-group-flush mt-3">
                    <li class="list-group-item bg-transparent text-uppercase font-weight-bold border-0 mb-0">
                        <a class="text-zircon" href="{{route('web.courses.all')}}">
                            {!!  __('courses/index.recents') !!}
                        </a>
                    </li>
                    <li class="list-group-item bg-transparent text-uppercase font-weight-bold border-0">
                        <a class="text-zircon" href="{{route('web.courses.all',['best-rate' => true])}}">
                            {!!  __('courses/index.rate') !!}
                        </a>
                    </li>
                </ul>


                <h4 class="text-secondary-two font-weight-bold mt-3">
                    {!!  __('courses/index.categories') !!}
                </h4>
                <hr class="bg-zircon">

                <ul class="list-group list-group-flush">
                    @foreach($categories as $category)
                        <li class="list-group-item bg-transparent text-uppercase font-weight-bold border-0 mb-0">
                            <a class="text-zircon"
                               href="{{route('web.courses.all',['category' => $category->seo->slug])}}">
                                {{$category->name}}
                            </a>
                        </li>
                    @endforeach
                </ul>


                <h4 class="text-secondary-two font-weight-bold mt-3">
                    {!!  __('courses/index.price') !!}
                </h4>
                <hr class="bg-zircon">

                <ul class="list-group list-group-flush mt-3">
                    <li class="list-group-item  text-uppercase font-weight-bold border-0 mb-0">
                        <a class="text-zircon" href="{{route('web.courses.all',['free'=>true])}}">
                            {!!  __('courses/index.free') !!}
                        </a>
                    </li>
                    <li class="list-group-item  text-uppercase font-weight-bold border-0 mb-0">
                        <a class="text-zircon" href="{{route('web.courses.all',['higher_price'=>true])}}">
                            {!!  __('courses/index.higher_price') !!}
                        </a>
                    </li>
                    <li class="list-group-item  text-uppercase font-weight-bold border-0">
                        <a class="text-zircon" href="{{route('web.courses.all',['lower_price'=>true])}}">
                            {!!  __('courses/index.lower_price') !!}
                        </a>
                    </li>

                </ul>

            </div>
            <div class="col-9 p-5" style="overflow-x:hidden;">
                <div class="row wrap">
                    @foreach($courses as $course)
                        <div class="col-12 col-md-6 col-xl-4 my-3">
                            @include('_partials/course/card',[
                                'course'=>$course,
                                'rate' => $course->average_rate,
                                'progress' => null,
                                'route' =>route('web.courses.show',$course->seo->slug)
                            ])
                        </div>
                    @endforeach
                </div>

                {{ $courses->links() }}

            </div>
        </div>

    </div>


@endsection

@section('styles')

    <style>

        .courses-container {
            top: 0;
            height: 100vh;
            overflow-y: hidden;
            padding-top: 80px;
        }
    </style>

@endsection

@section('scripts')
    <script src="{{ asset(mix('js/web/course/index.js')) }}"></script>
@endsection
