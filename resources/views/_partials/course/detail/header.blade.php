<div class="p-3 p-sm-5 rounded">

    <h1 class="h1-responsive text-primary font-weight-bold">{{$course->name}}</h1>
    <h5 class="mt-2 text-secondary font-weight-bold">
        {{__('courses/detail.author')}}
        {{$course->instructor->profile->lastname}}
        {{$course->instructor->profile->name}}
    </h5>

    <p class="mt-3 lead text-secondary-two text-justify">
        {{$course->excerpt}}
    </p>

    <div class="d-flex justify-content-between">
        @if(!empty($course->average_rate))
            <div class="mt-2 mt-md-0 d-block d-md-inline-block">
                <div class="course-rater" data-rate="{{$course->average_rate}}"></div>
                <span class="white-text ml-2"> {{number_format($course->average_rate,1)}}</span>
            </div>
        @endif


        @if($course->enrolls->count() >0)
            <div class="white-text mt-2 mt-md-0  ml-md-2 d-block d-md-inline-block">
                <i class="fas fa-users"></i>
                {{number_format($course->enrolls->count(),0)}}
                {{__('courses/detail.enrolled')}}
            </div>
        @endif


    </div>

    <div class="d-block d-lg-none mt-3">
        @include('_partials/components/rrss_share',['url' => request()->url()])
    </div>


</div>
