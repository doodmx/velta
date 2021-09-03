{{Form::open(['id'=>'frmRole','data-parsley-validate'=>true])}}

@method('PATCH')

<div class="modal fade" id="modalChangeRol" tabindex="-1" role="dialog" aria-labelledby="categoryModal"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content white-text bg-tangaroa">
            <div class="modal-header border-bottom">
                <h5 class="modal-title text-primary font-weight-bold">Cambiar Rol</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                {{ Form::select('role',$roleSelect, null,[
                    'id'=>'selectChangeRole',
                    'class' => 'mdb-select md-form colorful-select dropdown-primary',
                    'data-parsley-required'=>true
                ]) }}
                <label class="mdb-main-label" for="selectChangeRole">Rol</label>
            </div>
            <div class="modal-footer border-top">
                <button type="button" class="btn btn-md btn-primary btn-rounded btn waves-effect" data-dismiss="modal">
                    <i class="fas fa-times"></i> Cancelar
                </button>
                <button type="submit" class="btn btn-md btn-secondary btn-rounded text-tangaroa">
                    <i class="fas fa-check text-tangaroa"></i> Cambiar
                </button>
            </div>
        </div>
    </div>
</div>

{{Form::close()}}
