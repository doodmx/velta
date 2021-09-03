@extends('layouts.web.app')


@section('content')

    <div class="container main-padding">


        @if(request()->session()->has('success_cart'))
            <div class="row no-gutters">
                <div class="col-12">
                    <div class="alert alert-secondary-two lead" role="alert">
                        {{session('success_cart')}}
                    </div>
                </div>
            </div>
        @endif

        @if(request()->session()->has('error_cart'))
            <div class="row no-gutters">
                <div class="col-12">
                    <div class="alert alert-primary lead" role="alert">
                        {{session('error_cart')}}
                    </div>
                </div>
            </div>
        @endif

        <div class="card bg-transparent shadow-none">
            <div class="card-body rounded cart">
                <div id="header" class="pt-3 pl-3">
                    <h1 class="h1-responsive text-primary font-weight-bold">
                        {{__('cart.shopping_cart')}}
                    </h1>
                    <p class="text-secondary">
                        {{__('cart.shopping_cart_copy')}}
                    </p>

                </div>


                <div class="container mt-5">


                    @if(empty($cart))
                        <div class="my-5 text-center">
                            <i class="fas fa-shopping-cart fa-5x text-primary"></i>
                            <h3 class="h3-responsive text-primary font-weight-bold mt-3">
                                {{__('cart.cart_is_empty')}}
                            </h3>
                        </div>
                    @endif



                    @if(isset($cart['items']))
                        <div class="row wrap bg-primary text-white p-3 lead rounded d-none d-lg-flex">
                            <div class="col-lg-2"> {{__('cart.thumbnail')}}</div>
                            <div class="col-lg-10  d-flex row no-gutters">
                                <div class="col-lg"> {{__('cart.item')}}</div>
                                <div class="col-lg-2 text-center"> {{__('cart.price')}}</div>
                                <div class="col-lg-2 text-center"> {{__('cart.quantity')}}</div>
                                <div class="col-lg-2 text-center"> {{__('cart.total')}}</div>
                                <div class="col-lg-1 text-center">-</div>
                            </div>


                        </div>
                        @foreach($cart['items'] as $cartItem)

                            <div class="row wrap justify-content-between align-items-center  lead text-center mt-5 mt-lg-0 item">

                                <div class="col-12 col-lg-2">
                                    <img class="avatar shadow"
                                         src="{{asset($cartItem['thumbnail'])}}" alt=""
                                    >
                                </div>

                                <div class="totals col-12 col-lg-10 d-flex row no-gutters mt-5 mt-lg-0 text-secondary-two">

                                    <div class="col-12 col-lg total-item text-left">
                                        <div class="title d-lg-none">{{__('cart.item')}}</div>
                                        <div> {{$cartItem['description']}}</div>
                                    </div>

                                    <div class="col-12 col-lg-2  total-item">
                                        <div class="title d-lg-none">{{__('cart.price')}}</div>
                                        <div> {{number_format($cartItem['price'],2)}}</div>


                                    </div>
                                    <div class="col-12 col-lg-2  total-item">
                                        <div class="title d-lg-none">{{__('cart.quantity')}}</div>
                                        {{number_format($cartItem['quantity'],2)}}
                                    </div>
                                    <div class="col-12 col-lg-2  total-item">
                                        <div class="title d-lg-none">{{__('cart.total')}}</div>
                                        {{$cartItem['subtotal']}}
                                    </div>
                                    <div class="col-12 col-lg-1 total-item">


                                        {{Form::open(['url'=> route('cart.deleteItem',$loop->index),'method'=>'DELETE','class'=>'frm-delete-cart-item'])}}
                                        <div class="title d-lg-none">{{__('cart.delete')}}</div>
                                        <button type="button"
                                                class="btn-floating btn-sm btn-flat btn-danger btn-delete-cart-item">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        {{Form::close()}}
                                    </div>
                                </div>

                            </div>


                        @endforeach

                    @endif
                    @if(isset($cart['totals']))

                        <div class="row mt-5">

                            <!--TOTALS-->
                            <div class="col-12 col-lg-4 p-lg-0">
                                <div class="card bg-transparent shadow-none">
                                    <div class="card-body">
                                        <h3 class="h3-responsive text-primary font-weight-bold">
                                            {{__('cart.totals')}}
                                        </h3>

                                        <div class="table-responsive bg-transparent mt-5">
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <th class="lead text-lime-green font-weight-bold">Subtotal</th>
                                                    <td class="lead text-right">
                                                        {{number_format($cart['totals']['subtotal'],2)}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="lead text-lime-green">{{__('cart.tax')}}</th>
                                                    <td class="lead text-right">
                                                        {{number_format($cart['totals']['tax'],2)}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="lead text-lime-green">Total</th>
                                                    <td class="lead text-right font-weight-bold">
                                                        <h4 class="text-primary font-weight-bold">
                                                            {{number_format($cart['totals']['total'],2)}} {{$cart['items'][0]['currency_code']}}
                                                        </h4>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--TOTALS -->

                            <!--PAYMENT-->
                            <div class="col-12 col-lg-8">
                                <div class="card bg-transparent shadow-none">
                                    <div class="card-body">

                                        <h3 class="h3-responsive text-primary font-weight-bold">
                                            {{__('cart.credit_card')}}
                                        </h3>


                                        {{Form::open([
                                            'id'=>'cartForm',
                                            'data-stripe-publishable-key'=>env('APP_ENV') === 'local' ? env('STRIPE_TEST_KEY') : env('STRIPE_KEY'),
                                            'data-parsley-validate' => true,
                                            'autocomplete' => 'off'
                                        ])
                                        }}


                                        <h5 class="mb-3">

                                            <div class="mb-0 d-flex justify-content-between align-items-center">

                                                <div class="text-center text-md-left ">
                                                    {{__('cart.accepted_cards')}}
                                                </div>
                                                <div>
                                                    <img class="img-fluid"
                                                         src="{{asset('img/stripe.png')}}">
                                                </div>
                                            </div>

                                        </h5>


                                        {!! Form::hidden('paymentToken',null) !!}
                                        {!! Form::hidden('description',__('cart.cart_concept').' '.implode(',',array_column($cart['items'],'description'))) !!}
                                        {!! Form::hidden('currency_id',$cart['items'][0]['currency_id']) !!}
                                        {!! Form::hidden('currency_code',$cart['items'][0]['currency_code']) !!}
                                        {!! Form::hidden('payment_method','stripe_credit_card') !!}
                                        {!! Form::hidden('amount',$cart['totals']['total']) !!}
                                        {!! Form::hidden('status','paid') !!}


                                        <div id="card-element" class="my-5">
                                            <!-- Elements will create input elements here -->
                                        </div>

                                        <!-- We'll put the error messages in this element -->
                                        <div id="card-errors" class="text-danger"></div>


                                        <div class="md-form text-charcoal mt-4">
                                            <input
                                                    class="form-check-input"
                                                    type="checkbox"
                                                    id="termsCheck"
                                                    name="terms"
                                                    data-parsley-required="true"
                                                    required
                                            >
                                            <label class="form-check-label font-weight-bold lead" for="termsCheck">

                                                <a href="{{route('terms')}}" target="_blank">
                                                    {{__('cart.terms')}}
                                                </a>
                                            </label>
                                        </div>

                                        <button type="button" id="btnCheckout"
                                                class="btn btn-block btn-primary btn-rounded mt-5">
                                            {{__('cart.pay')}}
                                        </button>

                                        {{Form::close()}}
                                    </div>
                                </div>
                            </div>
                            <!--PAYMENT -->
                        </div>
                    @endif


                </div>

            </div>
        </div>
    </div>


@endsection


@section('styles')

    {{Html::style(asset(mix('css/web/cart.css')))}}

@endsection



@section('scripts')

    {{ Html::script('https://js.stripe.com/v3/') }}
    {{Html::script(asset(mix('js/web/cart/app.js')))}}

@endsection

