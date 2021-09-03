<!-- NAME FIELD -->
<div class="md-form my-2">
    <input type="text"
           id="txtName"
           name="name"
           data-parsley-required="true"
           data-parsley-required-message="{!! __('web/forms.register.fields.name.validate_msg.required') !!}"
           class="form-control ">
    <label for="txtName">{!! __('web/forms.register.fields.name.placeholder') !!}</label>
</div>
<!-- END NAME FIELD-->
<!-- LASTNAME FIELD -->
<div class="md-form my-2">
    <input type="text"
           id="txtLastname"
           name="lastname"
           data-parsley-required="true"
           data-parsley-required-message="{!! __('web/forms.register.fields.lastname.validate_msg.required') !!}"
           class="form-control ">
    <label for="txtLastname" class="">{!! __('web/forms.register.fields.lastname.placeholder') !!}</label>
</div>
<!-- END LASTNAME -->

<!-- EMAIL FIELD -->
<div class="md-form my-2">
    <input type="email"
           id="txtEmail"
           name="email"
           data-parsley-required="true"
           data-parsley-required-message="{!! __('web/forms.register.fields.email.validate_msg.required') !!}"
           data-parsley-type-message="{!! __('web/forms.register.fields.email.validate_msg.type') !!}"
           class="form-control ">
    <label for="txtEmail" class="">{!! __('web/forms.register.fields.email.placeholder') !!}</label>
</div>
<!-- END EMAIL FIELD -->

<!-- PHONE NUMBER -->
<div class="md-form my-1">
    <input id="phone"
           type="tel"
           name="whatsapp"
           class="form-control"
           data-parsley-errors-container="#errorPhoneNumber"
           data-parsley-required-message="{!! __('web/forms.register.fields.whatsapp.validate_msg.required') !!}"
           data-parsley-required="true">
</div>
<div class="red-text font-small" role="alert" id="errorPhoneNumber"></div>
<!-- END PHONE NUMBER -->

<!-- ID FILE -->
<div class="md-form mb-1 mt-3">
    <div class="file-field">
        <a class="btn-floating btn-primary mt-0 float-left">
            <i class="fas fa-paperclip" aria-hidden="true"></i>
            <input type="file" name="id_card"
                   data-parsley-errors-container="#errorIdCard"
                   data-parsley-required-message="{!! __('web/forms.register.fields.id_card.validate_msg.required') !!}"
                   data-parsley-required="true">
        </a>
        <div class="file-path-wrapper">
            <input class="file-path" type="text" readonly
                   placeholder="{!! __('web/forms.register.fields.id_card.placeholder') !!}">
        </div>
    </div>
    <div class="red-text font-small position-absolute py-1 mb-2" role="alert" id="errorIdCard">
    </div>
</div>
<br>
<!-- END ID FILE -->
<!-- PROOF RESIDENCE FILE -->
<div class="md-form mb-1 mt-1">
    <div class="file-field">
        <a class="btn-floating btn-primary mt-0 float-left">
            <i class="fas fa-paperclip" aria-hidden="true"></i>
            <input type="file" name="proof_residence"
                   data-parsley-errors-container="#errorProofResidence"
                   data-parsley-required-message="{!! __('web/forms.register.fields.proof_residence.validate_msg.required') !!}"
                   data-parsley-required="true">
        </a>
        <div class="file-path-wrapper">
            <input class="file-path validate" type="text" readonly
                   placeholder="{!! __('web/forms.register.fields.proof_residence.placeholder') !!}">
        </div>
    </div>
    <div class="red-text font-small position-absolute py-1" role="alert" id="errorProofResidence">
    </div>
</div>
<!-- END PROOF RESIDENCE FILE -->

<!-- TERMS -->
<div class="md-form my-2 pt-3">
    <div class="form-check pl-0">
        <input type="checkbox" name="terms" class="form-check-input" id="chkTerms"
               data-parsley-required-message="{!! __('web/forms.register.fields.terms.validate_msg.required') !!}"
               data-parsley-errors-container="#errorTerms"
               data-parsley-required="true">
        <label class="form-check-label" for="chkTerms">
            <a href="#" data-toggle="modal" data-target="#modalTerms">
                {!! __('web/forms.register.fields.terms.placeholder') !!}
            </a>
        </label>
    </div>
</div>
<div class="red-text font-small pt-2" role="alert" id="errorTerms">
</div>
<!-- END TERMS -->
