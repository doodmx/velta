<div id="slide-out" class="side-nav fixed">
    <ul class="custom-scrollbar">

        <!-- Logo -->
        <li class="logo-sn waves-effect py-3">
            <div class="text-center">
                <a href="{{route('users.index')}}" class="pl-0">
                    <img src="https://cdn.veltacorp.com/img/velta_corto_blanco.png" alt="Velta Logo"
                         style="height:70px; object-fit: cover; object-position: center;">
                </a>
            </div>
        </li>

        <!-- Side navigation links -->
        <li>
            <ul class="collapsible collapsible-accordion">
                @include('layouts.admin.menu')
            </ul>
        </li>
        <!-- Side navigation links -->

    </ul>
    <div class="sidenav-bg mask-strong"></div>
</div>
