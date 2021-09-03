@if($reviews->count()>0)
    <div class="p-3 p-sm-5">

        <h2 class="text-primary font-weight-bold">
            {{__('courses/detail.reviews')}}
        </h2>
        @foreach($reviews as $review)


            <div class="row mt-5 no-gutters review">
                <div class="col-12 col-lg-5 d-flex justify-content-start">

                    <div class="">
                        <div class="avatar bg-lime-green">
                            {{$review->partner->profile->name[0]}}
                            {{$review->partner->profile->lastname[0]}}
                        </div>
                    </div>

                    <div class="ml-2 flex-shrink-1">
                        <div class="d-block text-muted">
                            {{$review->updated_at->diffForHumans()}}
                        </div>
                        <div class="text-wrap text-break text-lime-green">
                            {{$review->partner->profile->name}}
                            {{$review->partner->profile->lastname}}
                        </div>

                    </div>


                </div>
                <div class="col-12 col-lg-7 lead mt-3 mt-lg-0 text-justify">

                    <div class="course-rater d-block" data-rate="{{$review->rate}}"></div>
                    <div class="mt-3">
                        {{$review->comment}}

                    </div>
                </div>
            </div>
        @endforeach


    </div>
@endif

