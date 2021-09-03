@extends('layouts.errors')
@section('content')

    <div class="row justify-content-center align-items-center p-5">
        <div class="col-sm-6 text-left">
            <h1 class="display-2 text-primary">Oops!
            </h1>


            <h3 class="text-secondary-two">
                Vaya, parece que no podemos encontrar la página que estás buscando.</h3>

            <p class="h6 text-danger">Error 404</p>
            <a href="{{route('index')}}" type="button"
               class="btn btn-primary btn-rounded waves-effect">
                Ir a Inicio
            </a>
        </div>
        <div class="col-sm-6">
            <img src="https://cdn.veltacorp.com/img/empty_404.svg" class="img-fluid" alt="404 error">
        </div>
    </div>


@endsection
