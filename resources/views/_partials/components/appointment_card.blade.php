<div class="card p-5 bg-secondary wow fadeInRight" data-wow-delay=".6s">
    <div class="card-header bg-transparent border-0">
        <h3 class="h2-responsive font-weight-bold text-white text-uppercase">
            {{__('web/forms.schedule')['title']}}
        </h3>

    </div>
    <div class="card-body">

        <form id="appointmentForm" action="{{route('mails.appointment')}}">

           @csrf

            <div class="md-form form-group form-group-lg">
                <input
                        id="appointment-name"
                        type="text"
                        name="name"
                        placeholder="Nombre"
                        class="form-control text-white"
                        data-parsley-required="true"
                />
                <label for="appointment-name" class="control-label">
                    {{__('web/forms.schedule')['fields']['name']['placeholder']}}
                </label>
            </div>

            <div class="md-form form-group form-group-lg">
                <input
                        id="appointment-lastname"
                        type="text"
                        name="lastname"
                        placeholder="tus apellidos"
                        class="form-control text-white"
                        data-parsley-required="true"
                />
                <label for="appointment-lastname" class="control-label">
                    {{__('web/forms.schedule')['fields']['lastname']['placeholder']}}
                </label>
            </div>

            <div class="md-form form-group form-group-lg">
                <input
                        id="appointment-email"
                        type="email"
                        name="email"
                        placeholder="micorreo@mail"
                        class="form-control text-white"
                        data-parsley-required="true"
                        data-parsley-type="email"/>
                <label for="appointment-email" class="control-label">
                    {{__('web/forms.schedule')['fields']['email']['placeholder']}}
                </label>
            </div>

            <label for="contact-email" class="control-label text-primary">
                {{__('web/forms.schedule')['fields']['whatsapp']['placeholder']}}
            </label>
            <div class="md-form form-group form-group-lg mt-1">
                <input id="appointment-phone"
                       type="tel"
                       name="whatsapp"
                       class="form-control contact-phone text-white"
                       data-parsley-errors-container="#errorAppointPhoneNumber"
                       data-parsley-required="true">

            </div>
            <div class="red-text font-small" role="alert" id="errorAppointPhoneNumber"></div>

            <button type="submit" class="btn btn-primary btn-lg btn-block">
                {{__('web/forms.schedule')['action']}}
            </button>
        </form>
    </div>
</div>
