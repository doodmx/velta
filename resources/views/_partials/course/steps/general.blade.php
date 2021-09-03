
<!-- Title input -->
<div class="md-form form-group form-lg mt-5">
    {{ Form::text('course[name]',
        isset($course) ? $course->name : null, [
        'id'=>'txtTitle',
        'class' => 'form-control form-control-lg',
        'placeholder' => 'Título de tu curso.',
        'data-parsley-maxlength' => '70',
        'data-parsley-required' => true,
         'data-parsley-group'=>'general'
    ]) }}
    <label for="txtTitle">Título</label>
</div>
<!-- Title input -->

<!-- CourseType input -->
<div class="md-form form-group form-lg mt-5">
    {{ Form::select('course_type[]',$courseTypeSelect, isset($courseType)?$courseType:[],[
        'multiple',
        'id' =>'selectCourseType',
        'data-parsley-required' => true,
        'data-parsley-group'=>'general',
        'searchable' => 'Buscar categoría...',
        'class' => 'mdb-select md-form colorful-select dropdown-secondary'
    ]) }}
    <label for="selectCourseType">Categoría</label>
</div>
<!-- CourseType input -->

<!-- Excerpt input -->
<div class="md-form mt-5">

    <label for="txtExcerpt">Resumen</label>
    {{ Form::textarea('course[excerpt]', isset($course) ? $course->excerpt : null, [
        'id'=>'txtExcerpt',
        'class' => 'form-control form-control-lg md-textarea',
        'rows'=>2,
        'length' => 150,
        'data-parsley-required' => true,
        'data-parsley-maxlength' => '150',
         'data-parsley-group'=>'general',
        'placeholder' => 'Breve descripción del curso'
    ]) }}

</div>
<!-- Excerpt input -->

<!-- Description input -->
<div class="form-group">
    <label for="txtDescription" class="text-lime-green">Descripción</label>
    {{ Form::textarea('course[description]', isset($course) ? $course->description : null,[
        'rows' => 10,
        'cols' => 80,
        'id' => 'txtDescription',
        'class' =>'form-control form-control-lg',
        'data-parsley-required' => true,
         'data-parsley-group'=>'general'
    ]) }}
</div>
<!-- Description input -->

<!-- Is Free -->
<div class="md-form form-group form-lg my-5">
    <input
            type="checkbox"
            id="freeCourse"
            class="form-check-input"
            name="is_free"
            data-parsley-required="false"
            {{isset($course) && empty($course->localized_price) ? 'checked':'unchecked'}}

    >
    <label class="form-check-label"
           for="freeCourse">Gratuito</label>
</div>

<!-- Is Free -->

<div class="row {{isset($course) && empty($course->localized_price) ? 'd-none':''}}" id="coursePrice">
    <div class="col-12 col-lg-6">
        <div class="md-form form-group form-lg">
            {{Form::select('course[currency_id]',$currencies, isset($course) ? $course->localized_currency:null,[
                'class'=>'mdb-select md-form colorful-select dropdown-primary pt-2',
                'placeholder'=>'Seleccione moneda',
                'searchable'=>'Buscar moneda...',
                'data-parsley-required'=> isset($course) && !empty($course->localized_price)
            ])}}
            <label for="courseTypeSelect" class="mdb-main-label">Moneda</label>
        </div>
    </div>
    <div class="col-12 col-lg-6">
        <!-- Price input -->
        <div class="md-form form-group form-lg">
            {{ Form::text('course[price]',
                isset($course) ? $course->localized_price : null, [
                'class' => 'form-control form-control-lg',
                'placeholder' => 'Precio por idioma del curso',
                'data-parsley-required' => isset($course) && !empty($course->localized_price)   ,
                'data-parsley-type'=> 'number',
                 'data-parsley-group'=>'general'
            ]) }}
            <label for="txtTitle">Precio</label>
        </div>
        <!-- Price input -->
    </div>
</div>


<!-- Thumbnail -->
<div class="row mt-3 text-center">
    <div class="col-12">
        <label class="text-lime-green">Vista Previa del Curso</label>
        <div id="img_error" class="text-danger"></div>
        <div class="grid">
            <div class="grid-item text-center">
                <div class="image-picker">
                    <i
                            id="btnClearImage"
                            class="fas fa-times-circle fa-2x text-primary clear"
                    >

                    </i>
                    {{ Html::image(isset($course)?asset('storage/'.$course->thumbnail): 'https://cdn.veltacorp.com/img/placeholder.svg', 'Vista Previa del Curso', [
                        'id' => 'imgThumbnail',
                        'class'=>'shadow'
                    ]) }}
                </div>
            </div>
            <div class="grid-item d-flex justify-content-center">
                <div class="file-field">
                    <div class="btn btn-primary btn-rounded waves-effect btn-sm float-left">
                        <span>{{isset($course) ? 'Cambiar' : 'Elegir'}} Imagen</span>
                        {{ Form::file('course[thumbnail]',[
                            'id' => 'inputImgThumbnail',
                            'accept' => 'image/*',
                            'data-parsley-required' => isset($course) ? false : true,
                            'data-parsley-required-message' => 'Debe adjuntar una imagen.',
                            'data-parsley-filemaxmegabytes' => 2,
                            'data-parsley-trigger' => 'change',
                            'data-parsley-filemimetypes' => 'image/png,image/jpg,image/bmp,image/gif,image/jpeg',
                            'data-parsley-group'=>'general',
                            'data-parsley-errors-container' => '#img_error',
                        ]) }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!--Thumbnail -->

