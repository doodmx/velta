@include(
    '_partials.components.seo_card',
    [
    'title' => isset($blog) ? $blog->seo->title :'',
    'separator' => isset($blog) ? $blog->seo->separator :'|',
    'description' => isset($blog) ? $blog->seo->description :'',
    'image' => isset($blog)?asset('storage/'.$blog->detail_image):asset('img/default-image.png')
    ]
)

<div class="row mt-3">
    <!-- SEPARATOR -->
    <div class="col-12 col-md-2">
        <div class="md-form">
            <input type="text"
                   id="txtSeoSeparator"
                   name="blog_seo[separator]"
                   class="form-control form-control-lg"
                   required
                   value="{{isset($blog)?$blog->seo->separator:'|'}}"
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
                   name="blog_seo[slug]"
                   class="form-control form-control-lg"
                   required
                   value="{{isset($blog)?$blog->seo->slug:''}}"
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
           name="blog_seo[title]"
           class="form-control form-control-lg"
           required
           value="{{isset($blog)?$blog->seo->title:''}}"
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
              name="blog_seo[description]"
              required
              data-parsley-group="seo"
              data-parsley-maxlength="150"
      >{{isset($blog)? $blog->seo->description:null}}</textarea>

    <label for="form1" class="">Descripción</label>
</div>
<!-- DESCRIPTION -->

<!-- IMAGE ALT -->
<div class="md-form mt-5">
    <input type="text"
           name="blog_seo[image_alt]"
           class="form-control form-control-lg"
           required
           value="{{isset($blog)?$blog->seo->image_alt:''}}"
           data-parsley-group="seo">
    <label for="form1" class="">Descripción de la imagen</label>
</div>
<!-- END IMAGE ALT -->


