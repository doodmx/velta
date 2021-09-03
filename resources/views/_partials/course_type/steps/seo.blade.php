@include(
    '_partials.components.seo_card',
    [
    'title' => isset($courseType) ? $courseType->seo->title :'',
    'separator' => isset($courseType) ? $courseType->seo->separator :'|',
    'description' => isset($courseType) ? $courseType->seo->description :'',
    'image' => isset($courseType)?asset('storage/'.$courseType->image):asset('img/default-image.png')
    ]
)

<div class="row mt-3">
    <!-- SEPARATOR -->
    <div class="col-12 col-md-2">
        <div class="md-form">
            <input type="text"
                   id="txtSeoSeparator"
                   name="course_type_seo[separator]"
                   class="form-control form-control-lg"
                   required
                   value="{{isset($courseType)?$courseType->seo->separator:'|'}}"
                   data-parsley-group="seo">
            <label for="form1" class="">Separador</label>
        </div>
    </div>
    <!-- END SEPARATOR -->
    <!-- SLUG -->
    <div class="col-12 col-md-10">

        <div class="md-form">
            <input type="text"
                   id="txtSeoSlug"
                   name="course_type_seo[slug]"
                   class="form-control form-control-lg"
                   required
                   value="{{isset($courseType)?$courseType->seo->slug:''}}"
                   data-parsley-group="seo">
            <label for="form1" class="">Slug</label>
        </div>
    </div>
    <!-- END SLUG -->
</div>

<!-- TITLE -->
<div class="md-form mt-5">
    <input type="text"
           id="txtSeoTitle"
           name="course_type_seo[title]"
           class="form-control form-control-lg"
           required
           value="{{isset($courseType)?$courseType->seo->title:''}}"
           data-parsley-group="seo">
    <label for="form1" class="">Título</label>
</div>
<!-- END TITLE -->


<!-- DESCRIPTION -->
<div class="md-form mt-5">
      <textarea
                id="txtSeoDescription"
                class="md-textarea form-control form-control-lg"
                length="150"
                name="course_type_seo[description]"
                required
                data-parsley-group="seo"
                data-parsley-maxlength="150"
      >{{isset($courseType)? $courseType->seo->description:null}}</textarea>

    <label for="form1" class="">Descripción</label>
</div>
<!-- DESCRIPTION -->

<!-- IMAGE ALT -->
<div class="md-form mt-5">
    <input type="text"
           name="course_type_seo[image_alt]"
           class="form-control form-control-lg"
           required
           value="{{isset($courseType)?$courseType->seo->image_alt:''}}"
           data-parsley-group="seo">
    <label for="form1" class="">Descripción de la imagen</label>
</div>
<!-- END IMAGE ALT -->


