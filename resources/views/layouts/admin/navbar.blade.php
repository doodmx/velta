<nav class="navbar fixed-top navbar-expand-lg scrolling-navbar double-nav navbar-light bg-white z-depth-0 fixed-top">
    <!-- SideNav slide-out button -->
    <div class="float-left">
        <a href="#" data-activates="slide-out" class="button-collapse collapse-left"><i
                    class="fas fa-bars text-secondary"></i></a>
    </div>


    <!-- Breadcrumb -->
    <div class="breadcrumb-dn mr-auto">
        <img src="https://cdn.veltacorp.com/img/velta_corto.png" alt="Velta Logo" class="ml-3 d-inline-block"
             style="height:40px; object-fit: cover; object-position: center;">
    </div>

    <div class="d-flex change-mode">

        <!-- Navbar links -->
        <ul class="nav navbar-nav nav-flex-icons ml-auto align-items-center ">


            @include('layouts.profile_dropdown')
            @include('layouts.language_dropdown')

        </ul>
        <!-- Navbar links -->

    </div>

</nav>
