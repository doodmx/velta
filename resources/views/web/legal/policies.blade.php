@extends('layouts.web.app')

@section('content')

    <section class="main-padding">
        <div class="mask">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col-flex text-center py-4">
                    <h1 class="heading h2 font-weight-bold text-primary">
                        {!! __('web/policies.title') !!}
                    </h1>
                </div>

            </div>
        </div>
    </section>

    <div class="container white-text">
        <div class="row d-flex justify-content-center">
            <div class="col-12 text-secondary lead text-justify">
                {!! __('web/policies.description') !!}
                @each('_partials/police_section', __('web/policies.content'), 'police')
            </div>
        </div>
    </div>


@endsection
