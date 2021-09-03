<!--FORMATS-->
<div class="row no-gutters wow zoomIn" data-wow-delay=".6s">

    <div class="col-12 bg-secondary p-2 p-sm-5">


        <div class="d-flex wrap flex-column flex-xl-row justify-content-xl-between">

            @foreach(__('web/membership.formats') as $plan)
                @include('_partials/membership/format_card',['plan'=>$plan])
            @endforeach


        </div>


    </div>
</div>

<!--FORMATS -->
<!-- VELTA MEMBERSHIP SLIDE -->
<div class="row no-gutters wow slideInDown" data-wow-delay="1s">

    <div class="col-12 view jarallax">

        <div class="mask rgba-black-slight">
            <img class="jarallax-img"
                 data-src="https://cdn.veltacorp.com/img/fondo_rojo.jpg"
                 alt="Azell">
        </div>

        @include('_partials/we_do/slide',[
               'sectionClass'=> '',
               'title' => __('web/membership.vp_membership')['title'],
               'copy' => __('web/membership.vp_membership')['copy']
           ])


    </div>
</div>
<!-- VELTA MEMBERSHIP SLIDE -->
