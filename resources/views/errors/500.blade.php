@extends('layouts.errors')
@section('content')

    <div class="row justify-content-center align-items-center  p-5">
        <div class="col-sm-6 text-left">

            <h3 class="text-secondary-two">
                Estamos trabajando para ofrecerte los mejores cursos.</h3>
            <a href="{{route('index')}}" type="button"
               class="btn btn-primart btn-rounded waves-effect">
                Ir a Inicio
            </a>
        </div>
        <div class="col-sm-6">
            <img src="https://cdn.veltacorp.com/img/work_500.svg" class="img-fluid" alt="404 error">
        </div>
    </div>



@endsection
