<!--CARD -->
<div class="card course-price-card" id="coursePrice">

    <!--CARD BODY -->
    <div class="card-body  p-0">


        <!-- COURSE PREVIEW -->+
        @if(!empty($course->preview))
            <div class="embed-responsive embed-responsive-16by9 d-none d-lg-block">

                <iframe src="{{$course->preview->video_link}}"
                        class="embed-responsive-item" frameborder="0" allow="autoplay; fullscreen"
                        allowfullscreen>
                </iframe>


            </div>

    @endif
    <!--COURSE PREVIEW -->

        <div class="p-0 p-lg-4 text-left">

            <!-- TITLE -->
            <div class="title">

                <h2 class="text-primary font-weight-bolder">
                     <span class="d-block d-lg-none text-lime-green lead mb-2">
                        {{$course->name}}
                    </span>
                    @if(!empty($course->localized_currency))
                        {{number_format($course->price,2 )}} {{$course->currency->iso_code}}
                    @else
                        {{__('courses/price_card.free')}}
                    @endif
                </h2>


                @if(auth()->guest())

                    <a href="{{route('register')}}"
                       class="btn btn-lg btn-primary btn-rounded mt-lg-3 purchase-btn">
                        {{empty($course->localized_currency) ? __('courses/price_card.enroll'):  __('courses/price_card.buy')}}
                    </a>

                @endif


                @if(auth()->user())

                    @if(!empty($enroll))


                        <a href="{{route('web.enrolls.course',$enroll->id)}}"
                           class="btn btn-lg btn-primary btn-rounded  mt-lg-3 purchase-btn">
                            {{__('courses/price_card.go_to')}}
                        </a>

                    @else

                        @if(empty($course->localized_currency))


                            {{Form::open(['url' => route('web.enrolls.free',$course->id),'method'=>'PUT'] )}}



                            <button type="submit"
                                    class="btn btn-lg btn-primary mt-lg-3 purchase-btn">
                                {{__('courses/price_card.enroll')}}
                            </button>

                            {{Form::close()}}

                        @else


                            {{Form::open(['url' => route('cart.addItem'),'method'=>'POST'] )}}

                            <input type="hidden" name="resource_id" value="{{$course->id}}">
                            <input type="hidden" name="thumbnail"
                                   value="{{asset('storage/'.$course->thumbnail)}}">
                            <input type="hidden" name="quantity" value="1">
                            <input type="hidden" name="price" value="{{$course->price}}">
                            <input type="hidden" name="currency_id"
                                   value="{{$course->currency->id}}">
                            <input type="hidden" name="currency_code"
                                   value="{{$course->currency->iso_code}}">
                            <input type="hidden" name="unit" value="servicio">
                            <input type="hidden" name="description" value="{{$course->name}}">
                            <input type="hidden" name="subtotal" value="{{$course->price}}">
                            <input type="hidden" name="discount" value="0">
                            <input type="hidden" name="tax" value="{{number_format($course->price * 0.16,2)}}">
                            <input type="hidden" name="total" value="{{number_format($course->price * 1.16,2)}}">

                            <button type="submit"
                                    class="btn btn-lg btn-primary btn-rounded mt-lg-3 purchase-btn">
                                <i class="fas fa-shopping-cart"></i>
                                {{__('courses/price_card.add_to_cart')}}
                            </button>

                            {{Form::close()}}

                        @endif


                    @endif


                @endif


            </div>
            <!--TITLE -->


            <!-- SHARE LINKS -->
            <div class="share-links d-none d-lg-block text-center">
                <hr class="my-3 bg-zircon">
                <h5 class="text-lime-green font-weight-bold mb-3">
                    {{__('courses/price_card.share')}}
                </h5>
                @include('_partials/components/rrss_share',['url' => request()->url()])
            </div>
            <!--SHARE LINKS -->

        </div>

    </div>
    <!--CARD BODY -->
</div>
<!-- CARD -->
