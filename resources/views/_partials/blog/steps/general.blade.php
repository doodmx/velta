<!-- TITLE -->
<div class="md-form">
    <input type="text"
           name="blog[title]"
           class="form-control form-control-lg"
           required
           value="{{isset($blog)?$blog->title:''}}"
           data-parsley-group="general">
    <label for="form1" class="">Título</label>
</div>
<!--END TITLE -->

<!-- AUTHOR -->
<div class="md-form mt-5">
    <input type="text"
           name="blog[author]"
           class="form-control form-control-lg"
           required
           value="{{isset($blog)?$blog->author:''}}"
           data-parsley-group="general">
    <label for="form1" class="">Autor</label>
</div>
<!-- END AUTHOR -->


<div class="row mt-5">
    <div class="col-12 col-md-6">
        <!-- CATEGORY -->
        <div class="form-group">

            <label class="mdb-main-label" for="categorySelect">Categoría</label>
            {{ Form::select('blog[category_id]', $categorySelect,isset($blog)? $blog->categories[0]->id:null,[
                'id' =>'categorySelect',
                'placeholder'=>"Selecciona una categoría",
                'class' => 'mdb-select md-form colorful-select dropdown-secondary',
                'required',
                'data-parsley-group'=>'general'
            ]) }}

        </div>
        <!-- END CATEGORY -->
    </div>
    <div class="col-12 col-md-6">
        <!-- TAGS -->
        <div class="form-group">

            <label class="mdb-main-label" for="tagSelect">Etiquetas</label>


            {{Form::select('blog_tag[]',$tagSelect,isset($blog)? $blog->tags->pluck('id'):null,[
                'class'=>'mdb-select md-form colorful-select dropdown-secondary',
                'multiple',
                'id'=>"tagSelect",
                "required",
                "data-parsley-group"=>"general"])}}

        </div>
        <!-- END TAGS -->
    </div>
</div>

<div class="row mt-5">
    <div class="col-12 col-md-6">
        <!-- DATE TO PUBLISH -->
        <div class="md-form">
            <input
                    type="text"
                    class="form-control form-control-lg datepicker"
                    name="blog[date_to_publish]"
                    value="{{isset($blog)? $blog->date_to_publish->format('Y-m-d'):null}}"
                    data-value="[{{isset($postDate) ? implode(',',$postDate): ''}}]"
                    required
                    data-parsley-group="general"
            >
            <label class="active">Fecha de Publicación</label>
        </div>
        <!-- END DATE TO PUBLISH -->
    </div>
    <div class="col-12 col-md-6">
        <!-- TIME TO PUBLISH -->
        <div class="md-form">
            <input type="text"
                   class="form-control form-control-lg timepicker"
                   name="blog[time_to_publish]"
                   value="{{isset($blog)? $blog->time_to_publish->format('h:i A'):null}}"
                   tabindex="2"
                   required
                   data-parsley-group="general">
            <label for="input_starttime" class="active">Hora de Publicación</label>
        </div>
        <!-- END TIME TO PUBLISH -->

    </div>
</div>



