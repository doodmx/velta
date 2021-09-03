<section id="investmentPlans" class="my-5">

    <h2 class="h2-responsive text-primary font-weight-bold text-center text-uppercase wow fadeIn">
        {{__('web/membership.investment_plans')}}
    </h2>


    <div class="container-fluid mt-5 d-flex flex-column flex-sm-row flex-sm-wrap justify-content-around align-items-center">

        @foreach(__('web/membership.plans') as $plan)

            <div class="pricing-card mx-sm-2 {{$loop->index>0 ?'mt-5 mt-lg-0':''}} {{$plan['name']=='Silver' ? 'recommended':''}} wow slideInUp"
                 data-wow-delay="{{0.25* $loop->index}}s">

                <figure class="circle circle-md {{$plan['circle']}} d-block mx-auto">

                </figure>
                <h4 class="h3-responsive text-primary font-weight-bold mt-3 text-uppercase">
                    {{$plan['name']}}
                </h4>
                <p class="h4-responsive text-secondary mt-3 mb-0">
                    {{$plan['from_amount']}}
                </p>

                @if(!empty($plan['to_amount']))
                    <p class="font-weight-bold my-1">
                        -
                    </p>
                @endif

                <p class="h4-responsive text-secondary">
                    {{$plan['to_amount']}}
                </p>

                <button class="btn btn-primary shadow  px-5 rounded-pill open-chat"
                        type="button"
                        data-message="Hola buen día , quiero informes del plan de inversión {{strtoupper($plan['name'])}}">
                    {{__('web/membership.investment_plan_cta')}}

                </button>
                <div class="mt-3 text-center text-lg-left text-secondary">
                    @foreach($plan['features'] as $feature)
                        <div class="d-block mt-2">
                            <i class="fa fa-check-circle mr-2"></i>
                            {{$feature}}
                        </div>
                    @endforeach
                </div>
            </div>


        @endforeach
    </div>
</section>


<section id="membership-slides" class="mt-5 pt-5">

    <!-- PROJECT ACTIONS SLIDE -->
    <div class="row no-gutters wow slideInDown" data-wow-delay=".25s">

        <div class="col-12 view jarallax">

            <div class="mask rgba-black-slight">
                <img class="jarallax-img"
                     data-src="https://cdn.veltacorp.com/img/ciudad.jpg"
                     alt="Azell">
            </div>

            @include('_partials/we_do/slide',[
                   'sectionClass'=> '',
                   'title' => __('web/membership.project_actions')['title'],
                   'copy' => __('web/membership.project_actions')['copy']
               ])


        </div>
    </div>
    <!-- PROJECT ACTIONS SLIDE -->


    <!-- FACTORING SLIDE -->
    <div class="row no-gutters wow slideInUp" data-wow-delay=".5s">

        <div class="col-12 view jarallax">

            <div class="mask rgba-black-slight">
                <img class="jarallax-img"
                     data-src="https://cdn.veltacorp.com/img/reporte.jpg"
                     alt="Azell">
            </div>

            @include('_partials/we_do/slide',[
                   'sectionClass'=> '',
                   'title' => __('web/membership.factoring')['title'],
                   'copy' => __('web/membership.factoring')['copy']
               ])


        </div>
    </div>
    <!-- FACTORING SLIDE -->

</section>


