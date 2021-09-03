<div class="card mt-3 mt-xl-0 mx-xl-2 {{$loop->index == 0 ? ' bg-transparent shadow-none text-left d-none d-xl-block': 'bg-secondary-two'}}">

    <div class="card-body approach-card text-white p-1 py-3 p-sm-4 d-flex flex-column justify-content-between">

        <h3 class="h3-responsive text-white {{$loop->index == 0 ? 'text-left text-uppercase': 'text-center'}} font-weight-bold">
            {{$plan['name']}}

            @if(isset($plan['subtitle']))
                <div class="d-block mt-1">
                    {{$plan['subtitle']}}
                </div>
            @endif
        </h3>

        <ul class="list-group list-group-flush {{$loop->index == 0 ? 'text-left': 'text-right text-xl-center'}} lead">

            <!-- INITIAL AMOUNT -->
            <li class="list-group-item bg-transparent border-0 d-flex justify-content-between">

                <div class="d-block d-xl-none text-left">
                    <strong>{{__('web/membership.formats')[0]['amount']}}</strong>
                </div>
                <div class="flex-grow-1">{{$plan['amount']}}</div>
            </li>
            <!-- INITIAL AMOUNT -->

            <!-- PROFIT -->
            <li class="list-group-item  bg-transparent border-0 d-flex justify-content-between">
                <div class="d-block d-xl-none text-left">
                    <strong>{{__('web/membership.formats')[0]['profit']}}</strong>
                </div>
                <div class="flex-grow-1">{{$plan['profit']}}</div>
            </li>
            <!-- PROFIT -->

            <!-- PERIOD -->
            <li class="list-group-item  bg-transparent border-0 d-flex justify-content-between">
                <div class="d-block d-xl-none text-left">
                    <strong>{{__('web/membership.formats')[0]['period']}}</strong>
                </div>
                <div class="flex-grow-1">{{$plan['period']}}</div>
            </li>
            <!-- PERIOD -->

            <!--LIQUIDITY -->
            <li class="list-group-item  bg-transparent border-0 d-flex justify-content-between">
                <div class="d-block d-xl-none text-left">
                    <strong>{{__('web/membership.formats')[0]['liquidity']}}</strong>
                </div>
                <div class="flex-grow-1">{{$plan['liquidity']}}</div>
            </li>
            <!--LIQUIDITY -->

            <!--RISK -->
            <li class="list-group-item bg-transparent border-0 d-flex justify-content-between">
                <div class="d-block d-xl-none text-left">
                    <strong>{{__('web/membership.formats')[0]['risk']}}</strong>
                </div>
                <div class="flex-grow-1">{{$plan['risk']}}</div>
            </li>
            <!--RISK -->


            <!--APP -->

            @if(isset($plan['app']))
                <li class="list-group-item bg-transparent border-0 d-flex justify-content-between">
                    {{$plan['app']}}
                </li>

            @else
                <li class="list-group-item bg-transparent border-0 d-flex justify-content-between">
                    <div class="d-block d-xl-none text-left">
                        <strong>{{__('web/membership.formats')[0]['app']}}</strong>
                    </div>
                    <div class="flex-grow-1">
                        <i class="fa fa-2x fa-check"></i>
                    </div>
                </li>

        @endif
        <!-- APP -->
        </ul>
    </div>
</div>
