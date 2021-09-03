    <style>
    html, body {
        margin: 0px
    }

    body {
        position: relative;
        background-image: url("{{asset('img/certificado.png')}}");
        background-repeat: no-repeat;
        background-size: cover;

    }

    h1 {
        position: absolute;
        top: 790px;
        left: 970px;
    }

    h2 {
        position: absolute;
        top: 1000px;
        left: 1040px;
    }

    p {
        position: absolute;
        top: 1340px;
        left: 900px;
        font-size: 38px;
        font-weight: bold;
    }

</style>


<div class="container">
    <h1>{{$partner}}</h1>
    <h2>{{$course}}</h2>

    <p>
        {{date('d/m/Y')}}
    </p>
</div>
