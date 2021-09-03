<div class="card bg-white">
    <!-- Card image -->
    <div class="view">
        <img src="{{asset('storage/'.$course->thumbnail)}}" class="card-img-top"
             alt="{{!empty($course->seo) ? $course->seo->image_alt : $course->name}}">


        <a href="{{$route}}">
            <div class="mask rgba-black-slight waves-effect waves-light"></div>
        </a>

    </div>
    <!-- Card image -->
    <!-- Button -->
    <a
            href="{{$route}}"
            class="btn-floating btn-action btn-primary  ml-auto mr-4 waves-effect waves-light"
    >
        <i class="fas fa-chevron-right pl-1"></i>
    </a>
    <!-- Card content -->
    <div class="card-body  text-left">

        <!-- Title -->
        <h4 class="card-title text-secondary-two font-weight-bold text-uppercase mt-3">{{$course->name}}</h4>
        @if($rate>0)
            <div class="course-rater" data-rate="{{$rate}}"></div>
        @endif

        @if(!empty($progress) && ($progress > 0  && $progress < 100 ))
            <div class="mb-3">
                <div class="progress">
                    <div class="progress-bar bg-lime-green"
                         role="progressbar"
                         aria-valuenow="{{$progress}}"
                         aria-valuemin="0"
                         aria-valuemax="100"
                         style="width: {{$progress}}%;">
                    </div>
                </div>
                <p class="text-small text-right  mt-1 font-weight-bold">
                    {{$progress}}%
                </p>
            </div>
    @endif



    <!-- Text-->
        <p class="card-text mb-0  mt-3 text-justify">
            {{$course->excerpt}}
        </p>
    </div>
    <!-- Card content -->

    <!-- Card footer -->
    <div class="card-footer  bg-white border-top rounded-bottom p-3">


        <div class="d-flex justify-content-between align-items-center">

            @if($course->doubts_count > 0 || $course->enrolls_count > 0)
                <div>

                    @if($course->doubts_count > 0)
                        <div class="list-inline-item pr-2">
                            <i class="fas fa-comments pr-1"></i> {{$course->doubts_count}}
                        </div>
                    @endif

                    @if($course->enrolls_count > 0)
                        <div class="list-inline-item pr-2">
                            <i class="fas fa-users pr-1"></i> {{$course->enrolls_count}}
                        </div>
                    @endif
                </div>
            @endif

            <div>
                @if(!empty($enroll->approval_certificate))
                    <a href="{{asset($enroll->approval_certificate)}}"
                       download="{{clean_file_name(auth()->user()->profile->lastname.' '.auth()->user()->profile->name)}}"
                       class="d-block lead ">
                        <i class="fas fa-file-pdf"></i>
                        {{__('courses/card.certificate')}}
                    </a>

                @endif
            </div>


            @if(empty($progress))
                <div class="lead font-weight-bolder">
                    @if(!empty($course->localized_currency))
                        {{number_format($course->localized_price,2)}} {{$course->currency->iso_code}}
                    @else
                        {{__('courses/card.free')}}
                    @endif
                </div>
            @endif

            @if($rate == 0 && intval($progress) === 100)
                <div>
                    <button type="button"
                            id="openRateModal"
                            class="btn btn-primary btn-sm btn-rounded font-weight-bold"
                            data-course="{{$enroll->course->name}}"
                            data-enroll="{{$enroll->id}}"
                    >
                        <i class="fas fa-star"></i>
                        {{__('courses/card.rate')}}
                    </button>
                </div>
            @endif


        </div>
    </div>
    <!-- Card footer -->

</div>
