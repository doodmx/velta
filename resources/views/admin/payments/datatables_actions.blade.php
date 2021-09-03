<div class="btn-group">
    <button type="button" class="btn-floating btn-sm  btn-primary  dropdown-toggle py-0 my-0"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-ellipsis-v"></i>
    </button>
    <div class="dropdown-menu">

        <a class="dropdown-item deactivateCourse"
           download="{{$payment_uuid.'.pdf'}}"
           href="{{asset('payments/'.$payment_uuid.'.pdf')}}">
            <i class="fas fa-file-pdf"></i> Descargar
        </a>

        <a class="dropdown-item send-receipt"
           data-id="{{$id}}"
           data-receipt="{{$payment_uuid}}"
           data-email="{{$email}}"

        >
            <i class="fas fa-envelope"></i> Enviar por correo
        </a>

    </div>
</div>
