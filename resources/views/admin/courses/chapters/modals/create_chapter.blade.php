{{ Form::open([
    'id' => 'frmAddChapter',
    'data-parsley-validate'=>true,
    'autocomplete' => 'off',
    'data-route'=>route('courses.store')
]) }}

@method('POST')

<div class="modal fade right modal-right modal-notify "
     id="chapterModal" tabindex="-1" role="dialog"
     aria-labelledby="chapterModal"

     aria-hidden="true">
    <div class="modal-dialog modal-full-height modal-right modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h5 class="modal-title text-primary font-weight-bold" id="textModalTitleChapter">
                    Agregar Capítulo
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                {{ Form::hidden('',null, ['id'=>'txtChapterId']) }}
                {{ Form::hidden('',null, ['id'=>'txtAppendChapterTo']) }}
                {{ Form::hidden('',null, ['id'=>'txtReRenderChapter']) }}

                {{ Form::hidden('parent_node_id') }}
                {{ Form::hidden('parent_course_id') }}


                <div class="md-form form-group form-lg my-0 pb-2 ">
                    <i class="fas fa-font prefix"></i>
                    {{ Form::text('title', null, [
                        'class' => 'form-control form-control-lg',
                        'placeholder' => 'Título del capítulo.',
                        'data-parsley-maxlength' => '150',
                        'data-parsley-required' => true
                    ]) }}
                    <label for="txtTitle" class="d-none d-sm-block">Título</label>
                </div>
                <div class="md-form form-group form-lg my-0 pb-2">
                    <i class="fab fa-youtube prefix"></i>
                    {{ Form::text('url', null, [
                        'class' => 'form-control form-control-lg',
                        'placeholder' => 'Url del capítulo.',
                        'data-parsley-required' => false
                    ]) }}
                    <label for="txtTitle" class="d-none d-sm-block">URL del Video</label>
                </div>
                <div class="md-form form-group form-lg my-0 pb-2">
                    <i class="fas fa-file-alt prefix"></i>
                    {{ Form::textarea('description', null,[
                        'rows' => 4,
                        'class' =>'md-textarea form-control form-control-lg'
                    ]) }}
                    <label for="txtDescription">Descripción</label>
                </div>


                <!-- Thumbnail input -->
                <div class="row mt-3 text-center">
                    <div class="col-12">
                        <label class="text-lime-green">Ícono del Capítulo</label>
                        <div id="img_error" class="text-danger"></div>
                        <div class="grid">
                            <div class="grid-item text-center">
                                <div class="image-picker">
                                    <i
                                            id="btnClearImage"
                                            class="fas fa-times-circle fa-2x text-primary clear"
                                    >

                                    </i>
                                    {{ Html::image('https://cdn.veltacorp.com/img/placeholder.svg', 'Icono del capítulo', [
                                        'id' => 'imgThumbnail',
                                        'class'=>'shadow'
                                    ]) }}
                                </div>
                            </div>
                            <div class="grid-item d-flex justify-content-center">
                                <div class="file-field">
                                    <div class="btn btn-primary btn-rounded waves-effect btn-md float-left d-">
                                        <span>Buscar Imagen...</span>
                                        {{ Form::file('icon',[
                                            'id' => 'inputImgThumbnail',
                                            'accept' => 'image/*',
                                            'data-parsley-filemaxmegabytes' => 2,
                                            'data-parsley-trigger' => 'change',
                                            'data-parsley-filemimetypes' => 'image/png,image/jpg,image/bmp,image/gif,image/jpeg',
                                            'data-parsley-errors-container' => '#img_error',

                                        ]) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
            <div class="modal-footer border-top">
                <button type="button" class="btn btn-md btn-primary btn-rounded waves-effect" data-dismiss="modal">
                    <i class="fas fa-times"></i> Cerrar
                </button>
                <button id="btnTextModalChapter" type="submit" class="btn btn-md btn-secondary btn-rounded waves-effect">
                    <i class="fas fa-plus"></i> Agregar
                </button>
            </div>
        </div>
    </div>
</div>

{{ Form::close() }}
