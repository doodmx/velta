<div class="container-fluid shadow">
    <footer class="text-center text-md-left text-secondary px-5">


        <!--Grid row-->
        <div class="row py-4 d-flex align-items-center">
            <!--Grid column-->
            <div class="col-md-6 col-lg-5 text-center text-md-left mb-md-0">
                <h6 class="mb-0 ">
                    {{__('web/index.rrss')}}
                </h6>
            </div>
            <!--Grid column-->
            <!--Grid column-->
            <div class="col-md-6 col-lg-7 text-center text-md-right mt-3 mt-lg-0">

                @foreach(config('social') as $social)
                    <a class="p-2 m-2 fa-lg fb-ic"
                       href="{{$social['url']}}"
                       target="_blank">
                        <i class="{{$social['icon']}} text-primary mr-lg-4"> </i>
                    </a>
                @endforeach

            </div>
            <!--Grid column-->
        </div>
        <!--Grid row-->

        <!-- Grid row -->
        <div class="row wrap flex-column flex-sm-row justify-content-between align-items-center py-3 border-top border-primary">

            <div class="font-weight-bold text-center text-sm-left">

                <div class="d-block d-inline-lg-block">© {{date('Y')}} {{__('web/index.rights')}}</div>

                <a href="{{route('policies')}}" class="d-block d-inline-lg-block text-secondary font-weight-bold ml-2">
                    {!! __('web/footer.privacy_policy') !!}
                </a>

                <a href="{{route('terms')}}" class="d-block d-inline-lg-block text-secondary font-weight-bold ml-2">
                    {!! __('web/footer.terms_of_use') !!}
                </a>
            </div>

            <div class="mt-3 ml-0 ml-lg-3 text-center text-md-right">
                <div class="d-inline-block">
                    <a href="https://apps.apple.com/us/app/dood-velta/id1522729629">
                        <img src="https://cdn.veltacorp.com/img/app_store.svg" alt="Aplicacion Velta" width="32"
                             height="32">

                    </a>
                </div>
                <div class="ml-5 d-inline-block">
                    <a href="https://play.google.com/store/apps/details?id=com.dood.veltacorp">
                        <img src="https://cdn.veltacorp.com/img/playstore_icon.svg" alt="Aplicacion Velta" width="32"
                             height="32">
                    </a>
                </div>
            </div>

        </div>
        <!-- Grid row -->


    </footer>
</div>

