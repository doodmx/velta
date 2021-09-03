<form data-action="" method="POST" id="categoryForm" autocomplete="off">
    <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModal"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" >
                <div class="modal-header border-bottom">
                    <h3 class="modal-title text-primary font-weight-bold" id="modalTitle"></h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{Form::hidden('_method',null)}}

                    <div class="md-form form-group">
                        {{ Form::text('category', null, [
                            'class' => 'form-control form-control-lg',
                            'id'=> 'txtCategory',
                            'placeholder' => 'Título de la Categoría.',
                            'required'=>true,
                        ]) }}
                        <label for="txtCategory">Categoría</label>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-md btn-primary btn-rounded" data-dismiss="modal">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-md btn-secondary btn-rounded">
                        <i class="fas fa-save"></i> Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
