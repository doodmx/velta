<!-- CONTENT -->
<div class="form-group">
    <label for="category" class="label text-ce-soir">Contenido</label>
    <textarea
            id="blogEditor"
            name="blog[content]"
            data-parsley-group="article"
            required
            rows="10"
            cols="80">{{isset($blog)? $blog->content:null}}</textarea>
</div>
<!-- END CONTENT -->


<div class="row align-items-center">
    <div class="col-12 col-lg-3">
        <!-- IMAGE -->
        <div class="form-group d-flex flex-column align-items-center align-items-lg-start">
            <label class="text-lime-green">Imagen</label>
            <div id="img_error" class="text-danger"></div>
            <div class="grid">
                <div class="grid-item text-center">
                    <div class="image-picker">
                        <i
                                id="btnClearImage"
                                class="fas fa-times-circle fa-2x text-primary clear"
                        >

                        </i>
                        {{ Html::image(isset($blog) ? asset('storage/'.$blog->detail_image) : 'https://cdn.veltacorp.com/img/placeholder.svg', 'Vista Previa del Post', [
                            'id' => 'imgThumbnail',
                            'class'=>'shadow'
                        ]) }}
                    </div>
                </div>
                <div class="grid-item d-flex justify-content-center">
                    <div class="file-field">
                        <div class="btn btn-primary btn-md btn-rounded waves-effect btn-sm float-left d-">
                            <span>{{isset($blog) ? 'Cambiar' : 'Elegir'}} Imagen</span>
                            {{ Form::file('blog[detail_image]',[
                                'id' => 'inputImgThumbnail',
                                'accept' => 'image/*',
                                'data-parsley-group'=> 'article',
                                'data-parsley-required' => isset($blog) ? false : true,
                                'data-parsley-required-message' => 'Debe adjuntar una imagen.',
                                'data-parsley-errors-container' => '#img_error',
                            ]) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--END IMAGE -->

    </div>
    <div class="col-12 col-lg-9">
        <!-- EXTRACT -->
        <div class="md-form">
          <textarea class="md-textarea form-control"

                    length="150"
                    name="blog[extract]"
                    required
                    data-parsley-maxlength="150"
                    data-parsley-group="article"
          >{{isset($blog)? $blog->extract:null}}</textarea>

            <label for="form1" class="">Extracto</label>
        </div>
        <!-- EXTRACT -->
    </div>
</div>


