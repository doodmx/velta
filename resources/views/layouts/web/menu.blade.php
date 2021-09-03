<li class="nav-item {{request()->routeIs('about') ? 'active':''}}">
    <a class="nav-link" href="{{route('about')}}" data-offset="100">
        <strong>{{__('web/menu.about_us')}}</strong>
    </a>
</li>

<li class="nav-item {{request()->routeIs('we_do') ? 'active':''}}">
    <a class="nav-link" href="{{route('we_do')}}" data-offset="100">
        <strong>{{__('web/menu.we_do')}}</strong>
    </a>
</li>

<li class="nav-item {{request()->routeIs('membership') ? 'active':''}}">
    <a class="nav-link" href="{{route('membership')}}" data-offset="100">
        <strong>{{__('web/menu.membership')}}</strong>
    </a>
</li>


<!-- PROJECTS -->
<li class="nav-item dropdown {{request()->routeIs(['intro','velta_center']) ? 'active':''}}">
    <a class="nav-link dropdown-toggle"
       id="brandsDropdown"
       href="#"
       data-toggle="dropdown"
       aria-haspopup="true"
       aria-expanded="false"
    >

        <div class="d-inline-block">
            {{__('web/menu.projects')}}
        </div>

    </a>

    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="brandsDropdown">


        <a class="dropdown-item {{request()->routeIs('intro') ? 'active':''}}" href="{{route('intro')}}">
            {{__('web/menu.intro')}}
        </a>
        <a class="dropdown-item {{request()->routeIs('velta_center') ? 'active':''}}" href="{{route('velta_center')}}">
            {{__('web/menu.velta_center')}}
        </a>


    </div>
</li>
<!-- PROJECTS -->


@if(auth()->guest())

    <!-- AUTH ROUTES -->
    <li class="nav-item dropdown {{request()->routeIs(['register','login']) ? 'active':''}}">
        <a class="nav-link dropdown-toggle"
           id="partnersDropdown"
           href="#"
           data-toggle="dropdown"
           aria-haspopup="true"
           aria-expanded="false"
        >

            <div class="d-inline-block">
                {{__('web/menu.partners')}}
            </div>

        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="partnersDropdown">


            <a class="{{ (request()->is('register*')) ? 'active' : '' }} dropdown-item"
               href="{{route('register')}}" data-offset="100">
                <i class="fas fa-user-plus"></i> <strong>{{__('web/menu.register')}}</strong>
            </a>

            <a class="{{ (request()->is('login*')) ? 'active' : '' }} dropdown-item"
               href="{{ route('login') }}" data-offset="100">

                <i class="fas fa-angle-double-right"></i> {{__('web/menu.login')}}
            </a>


        </div>
    </li>
    <!-- AUTH ROUTES -->



    <!-- CONTACT CTAS -->
    <div class="nav-item d-flex justify-content-end ml-lg-4 ">
        <li class="nav-item nav-cta ">
            <a class="nav-link"
               data-whatsapp
               href="#"
               data-offset="100">
                <strong>
                    <i class="fab fa-whatsapp fa-2x"></i>
                </strong>
            </a>
        </li>

        <li class="nav-item nav-cta ml-4 ml-lg-0">
            <a class="nav-link"
               data-calling
               href="#"
               data-offset="100">
                <strong>
                    <i class="fas fa-phone fa-2x"></i>
                </strong>
            </a>
        </li>
    </div>
    <!--CONTACT CTAS -->
@endif

<div class="d-flex row wrap align-items-center mx-2">
    @if(auth()->user())
        <li class="nav-item {{request()->routeIs('web.courses.all') ? 'active':''}}">
            <a class="nav-link" href="{{route('web.courses.all')}}" data-offset="100">
                <strong>{{__('web/menu.partner_program')}}</strong>
            </a>
        </li>
    @endif

    @includeWhen(auth()->user(), 'layouts.web.cart')
    @includeWhen(auth()->user(), 'layouts.profile_dropdown')
</div>



