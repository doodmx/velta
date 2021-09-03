<nav class="navbar navbar-expand-lg scrolling-navbar navbar-light bg-white z-depth-0 fixed-top">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
            aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="{{ url('/') }}">

        @if(auth()->guest())
            <picture>
                <source media="(max-width:599.98px)" srcset="https://cdn.veltacorp.com/img/velta_corto.png">
                <source media="(min-width:600px)" srcset=" https://cdn.veltacorp.com/img/velta_logo.png">
                <img src=" https://cdn.veltacorp.com/img/velta_logo.png" alt="{{ config('app.name', 'Velta') }}"
                     style="width:auto;">
            </picture>
        @else
            <img src=" https://cdn.veltacorp.com/img/velta_corto.png" alt="{{ config('app.name', 'Velta') }}"
                 style="width:auto;">
        @endif


    </a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
        <ul class="navbar-nav ml-auto text-uppercase smooth-scroll align-items-lg-center">
            @include('layouts.web.menu')
        </ul>
    </div>

    @include('layouts.language_dropdown')
</nav>
