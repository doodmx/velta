<div class="card p-5 bg-secondary-gradient wow fadeInLeft">
    <div class="card-header bg-transparent border-0">
        <h3 class="h2-responsive font-weight-bold text-secondary text-uppercase">
            {{__('web/forms.contact')['title']}}
        </h3>

    </div>
    <div class="card-body">

        <form id="contactForm" action="{{route('mails.lead')}}">

            @csrf
            <div class="md-form form-group form-group-lg">
                <input
                        id="contact-email"
                        type="email"
                        name="email"
                        placeholder="micorreo@mail"
                        class="form-control"
                        data-parsley-required="true"
                        data-parsley-type="email"/>
                <label for="contact-email" class="control-label">
                    {{__('web/forms.contact')['fields']['email']['placeholder']}}
                </label>
            </div>

            <label for="contact-email" class="control-label text-primary">
                {{__('web/forms.contact')['fields']['whatsapp']['placeholder']}}
            </label>
            <div class="md-form form-group form-group-lg mt-1">
                <input id="contact-phone"
                       type="tel"
                       name="whatsapp"
                       class="form-control contact-phone"
                       data-parsley-errors-container="#errorPhoneNumber"
                       data-parsley-required="true">

            </div>
            <div class="red-text font-small" role="alert" id="errorPhoneNumber"></div>

            <button type="submit" class="btn btn-primary btn-lg btn-block">
                {{__('web/forms.contact')['action']}}
            </button>
        </form>
    </div>
</div>
