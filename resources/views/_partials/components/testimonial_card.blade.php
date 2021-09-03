<div class="card promoting-card wow fadeIn" data-wow-delay="{{$index*0.25}}s">

    <!-- Card content -->
    <div class="card-body">


        <!-- Title -->
        <h4 class="card-title font-weight-bold mb-2">
            {{$testimonial['person']}}
        </h4>
        <!-- Subtitle -->
        <p class="card-text">
            <i class="far fa-calendar pr-2"></i>
            {{$testimonial['date']}}
        </p>


    </div>

    <!-- Card image -->
    <div class="embed-responsive embed-responsive-16by9">
        <iframe class="embed-responsive-item"
                data-src="{{$testimonial['src']}}" allowfullscreen></iframe>
    </div>


    <!-- Card content -->
    <div class="card-body">

        <div class="collapse-content">

            <!-- Text -->
            <p class="card-text collapse" id="collapseContent">
                {{$testimonial['copy']}}
            </p>

            @for($i=1;$i<= $testimonial['stars'];++$i)
                <i class="fas fa-star text-warning"></i>
            @endfor


        </div>

    </div>

</div>
