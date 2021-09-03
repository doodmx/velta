<div class="card border-0 mt-4">
    <div class="card-header  z-depth-1" id="heading{{$index}}">
        <h1 class="mb-0 text-primary">
            <button class="btn w-100 btn-link btn-lg text-lime-green text-left font-weight-bold  text-uppercase"
                    type="button"
                    data-toggle="collapse"
                    data-target="#collapse{{$index}}"
                    aria-expanded="{{$index == 0 ?true:false}}"
                    aria-controls="collapse{{$index}}">
                <i class="fas fa-caret-down"></i> {{$title}}
            </button>
        </h1>
    </div>

    <div    id="collapse{{$index}}"
            class="collapse {{$index == 0 ?'show':''}}"
            aria-labelledby="heading{{$index}}"
            data-parent="#accordion">

                <div class="card-body white text-dark text-justify lead">
                    {!! $content!!}
                </div>
    </div>
</div>
