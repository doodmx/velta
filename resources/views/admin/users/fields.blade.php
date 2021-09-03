<h6 class="py-3 font-weight-bold text-secondary-two">
    {{  __('my_investors.contact_information')}}
</h6>

<!-- LASTNAME -->
<div class="md-form form-group form-lg ">
    {{ Form::text('lastname',
        isset($user) ? $user->profile->lastname:null, [
        'id'=>'txt'.$module.'Lastname',
        'class' => 'form-control',
        'data-parsley-required' => true
    ]) }}
    <label for="txt{{$module}}LastName" class="d-none d-sm-block">
        {{  __('my_investors.last_name')}}
    </label>
</div>
<!-- LASTNAME -->

<!-- FIRST NAME -->
<div class="md-form form-group form-lg">
    {{ Form::text('name',
        isset($user) ? $user->profile->name:null, [
        'id'=>'txt'.$module.'Name',
        'class' => 'form-control',
        'data-parsley-required' => true
    ]) }}
    <label for="txt{{$module}}Name" class="d-none d-sm-block">
        {{  __('my_investors.first_name')}}
    </label>
</div>
<!-- FIRST NAME -->

<!-- MEMBERSHIP -->

@if(!isset($hideMembership))
<div class="md-form form-group">
    {{ Form::select('membership',$membershipSelect, isset($user) ? $user->membership:null,[
                'placeholder' => 'Seleccciona una membresía',
                'id'=>'select'.$module.'Membership',
               'class' => 'mdb-select md-form colorful-select dropdown-secondary'
    ]) }}
    <label for="select{{$module}}Membership" class="d-none d-sm-block">
        {{  __('my_investors.membership')}}
    </label>
</div>
@endif

<!-- MEMBERSHIP -->


<!-- PHONE -->
<label for="txt{{$module}}Whatsapp" class="d-none d-sm-block text-primary mt-3">
    {{  __('my_investors.whatsapp')}}
</label>
<div class="md-form form-group form-lg mt-1">
    <input id="txt{{$module}}Whatsapp"
           type="tel"
           name="whatsapp"
           class="form-control"
           value="{{ isset($user) ? $user->profile->whatsapp:null}}"
           data-parsley-errors-container="#error{{$module}}Whatsapp"
           data-parsley-required="true">
</div>

<div class="red-text font-small" role="alert" id="error{{$module}}Whatsapp"></div>


<!-- PHONE -->

<!-- EMAIL -->
<div class="md-form form-group form-lg">
    {{ Form::text('email',
         isset($user) ? $user->email:null, [
        'id'=>'txt'.$module.'Email',
        'class' => 'form-control',
        'data-parsley-required' => true,
        'data-parsley-type' => 'email',
        isset($user) ? 'readonly':''
    ]) }}
    <label for="txt{{$module}}Email" class="d-none d-sm-block">
        {{  __('my_investors.email')}}
    </label>
</div>
<!-- EMAIL -->


<!-- USER DOCS-->
<h6 class="py-3 text-secondary-two font-weight-bold">
    {{  __('my_investors.attachments')}}
</h6>
<div class="row text-center justify-content-start">

    <!-- ID CARD -->
    <div class="col-12 col-lg-5 mt-3 mt-lg-0">
        <div class="card-body shadow rounded edit-context-menu"
             style="height: 10rem;"
             id="containerIdCard"
             data-file_id="#{{$module}}fileCardId">

            <div class="card-container d-flex flex-column justify-content-center align-items-center h-100">

                <a href="{{isset($user) ? asset($user->profile->id_card):'#'}}"
                   class="id-card-link"
                   target="_blank"
                >
                    <i class="fas fa-address-card fa-3x text-lime-green"></i>
                    <h5 class="mt-3 mb-0 text-secondary  font-weight-bold">
                        {{  __('my_investors.user_id')}}
                    </h5>
                    <p class="mt-1  text-secondary-two font-small id-card-name"
                       id="idCardFilename">
                        {{isset($idCard) ? $idCard:''}}
                    </p>
                </a>

            </div>


            <div class="file-field position-absolute" style="top:0px;right:10px;">
                <a class="btn-floating btn-secondary">
                    <i class="fas fa-paperclip" aria-hidden="true"></i>
                    <input
                            id="{{$module}}fileCardId"
                            type="file"
                            name="id_card"
                            data-parsley-filemaxmegabytes="2"
                            data-parsley-trigger="change"
                            data-parsley-filemimetypes="image/png,image/jpg,image/bmp,image/gif,image/jpeg,application/pdf"
                            data-parsley-errors-container="#errorIdCard"
                    >
                </a>
            </div>


        </div>
        <div class="red-text font-small" role="alert" id="errorIdCard"></div>
    </div>
    <!-- ID CARD -->

    <!--PROOF RESIDENCE-->
    <div class="col-12 col-lg-5 mt-3 mt-lg-0">
        <div class="card-body shadow rounded edit-context-menu"
             style="height: 10rem;"
             data-file_id="#{{$module}}fileProofResidence">

            <div class="card-container d-flex flex-column justify-content-center align-items-center h-100">
                <a href="{{isset($user) ? asset($user->profile->proof_residence):'#'}}"
                   class="proof-residence-link"
                   target="_blank"
                >
                    <i class="fas fa-address-card fa-3x text-lime-green"></i>
                    <h5 class="mt-3 mb-0 text-secondary font-weight-bold">
                        {{  __('my_investors.proof_residency')}}
                    </h5>
                    <p class="mt-1  text-secondary-two proof-residence-name">
                        {{isset($proofResidence) ? $proofResidence:''}}
                    </p>

                </a>
            </div>


            <div class="file-field position-absolute" style="top:0px;right:10px;">
                <a class="btn-floating btn-secondary">
                    <i class="fas fa-paperclip" aria-hidden="true"></i>

                    <input
                            id="{{$module}}fileProofResidence"
                            type="file"
                            name="proof_residence"
                            data-parsley-filemaxmegabytes="2"
                            data-parsley-trigger="change"
                            data-parsley-filemimetypes="image/png,image/jpg,image/bmp,image/gif,image/jpeg,application/pdf"
                            data-parsley-errors-container="#errorProofResidence"
                    >
                </a>
            </div>
            <div class="red-text font-small" role="alert" id="errorProofResidence"></div>
        </div>

    </div>
    <!--PROOF RESIDENCE -->
</div>

<!-- USER DOCS -->
