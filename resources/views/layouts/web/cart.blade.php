@if(session()->has('cart'))

    <li class="nav-item dropdown">

        <a
                id="cartDropdown"
                class="nav-link dropdown-toggle waves-effect"
                href="#"
                data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="true">

            <span class="badge red">{{ count(session()->get('cart')['items'])}}</span>
            <i class="fas fa-shopping-cart"></i>

        </a>


        <div class="dropdown-menu dropdown-menu-right " aria-labelledby="cartDropdown">

            @foreach(collect(session()->get('cart')['items'])->slice(0,2) as $cartItem)
                <div class="dropdown-item waves-effect waves-light d-flex justify-content-between align-items-center">

                    <!--THUMBNAIL-->
                    <img style="width: 2rem;height:2rem; object-fit: cover;object-position: center;border-radius: 50%;"
                         src="{{$cartItem['thumbnail']}}" alt="{{$cartItem['description']}}"
                    />
                    <!--THUMBNAIL-->

                    <!--ARTICLE-->
                    <div class="flex-grow-1 px-3 left">
                        <p class="font-weight-bolder my-0 ">

                            {{$cartItem['description']}}
                        </p>

                        <p class="text-sm mt-1 text-lime-green font-weight-bold">
                            {{number_format($cartItem['total'],2)}} {{$cartItem['currency_code']}}
                        </p>
                    </div>
                    <!--ARTICLE-->

                    <!--DELTE BUTTON-->
                    <div class="flex-shrink-1">
                        {{Form::open(['url'=> route('cart.deleteItem',$loop->index),'method'=>'DELETE','class'=>'frm-delete-cart-item','style'=>'width:auto;'])}}

                        <button type="button" class="btn-sm btn-floating btn-danger btn-delete-cart-item">
                            <i class="fas fa-trash-alt"></i>
                        </button>

                        {{Form::close()}}
                    </div>
                    <!--DELETE BUTTON-->


                </div>

                <hr class="my-2 bg-zircon">

            @endforeach

        <!--CART ToTAL-->
            <div class="dropdown-item waves-effect waves-light d-flex justify-content-between align-items-center">

                <div class="lead ">Total</div>
                <div class="lead text-lime-green font-weight-bold">
                    {{number_format(session()->get('cart')['totals']['total'],2)}} {{session()->get('cart')['items'][0]['currency_code']}}
                </div>

            </div>
            <!--CART TOTAL -->

            <a class="dropdown-item  text-center mt-1"
               href="{{ route('cart.list') }}"
            >
                {{__('cart.checkout')}}
            </a>


            <!-- TO EMPTY CART CTA-->
            {{Form::open(['url'=> route('cart.empty'),'method'=>'DELETE','class'=>'frm-empty-cart'])}}

            <button type="button" class="dropdown-item  text-center mt-1 btn-empty-cart">
                <i class="fas fa-trash"></i>
                {{__('cart.to_empty')}}
            </button>

        {{Form::close()}}
        <!-- TO EMPTY CART CTA-->


        </div>
    </li>



@endif
