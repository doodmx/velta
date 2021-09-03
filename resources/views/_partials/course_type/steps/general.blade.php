<!-- Title input -->
<div class="md-form form-group form-lg mt-5">
    {{ Form::text('course_type[name]', isset($courseType) ? $courseType->name : null, [
        'id'=>'txtName',
        'class' => 'form-control form-control-lg',
        'placeholder' => 'Nombre.',
        'data-parsley-maxlength' => '70',
        'data-parsley-required' => true,
        'data-parsley-group' => 'general',
    ]) }}
    <label for="txtName">Nombre</label>
</div>
<!-- Title input -->

<!-- DESCRIPTION -->
<div class="md-form mt-5">
      <textarea class="md-textarea form-control form-control-lg"
                length="150"
                name="course_type[description]"
                required
                data-parsley-maxlength="150"
                data-parsley-group="general"
      >{{isset($courseType)? $courseType->description:null}}</textarea>

    <label for="form1" class="">Descripción</label>
</div>
<!-- DESCRIPTION -->


<!-- Image input -->
<div class="row">
    <div class="col-sm-12">
        <label class="text-lime-green">Vista Previa de la Categoría</label>
        <div id="img_error" class="text-danger"></div>
        <div class="grid">
            <div class="grid-item text-center">
                <div class="image-picker">
                    <i
                            id="btnClearImage"
                            class="fas fa-times-circle fa-2x text-primary clear"
                    >

                    </i>
                    {{ Html::image(isset($courseType) ? asset('storage/'.$courseType->image): 'https://cdn.veltacorp.com/img/placeholder.svg', 'Vista Previa de la Categoría', [
                        'id' => 'imgThumbnail',
                        'class'=>'shadow'
                    ]) }}
                </div>
            </div>
            <div class="grid-item d-flex justify-content-center">
                <div class="file-field">
                    <div class="btn btn-primary btn-rounded waves-effect btn-sm float-left">
                        <span>{{isset($courseType) ? 'Cambiar' : 'Elegir'}} Imagen</span>
                        {{ Form::file('course_type[image]',[
                            'id' => 'inputImgThumbnail',
                            'accept' => 'image/*',
                            'data-parsley-required' => isset($courseType) ? false : true,
                            'data-parsley-required-message' => 'Debe adjuntar una imagen.',
                            'data-parsley-errors-container' => '#img_error',
                            'data-parsley-group' => 'general'
                        ]) }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- Image input -->
