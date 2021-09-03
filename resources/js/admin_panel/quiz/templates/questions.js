export default function getQuestionsHtml() {

    return `

        <div class="row no-gutters mt-5" id="question{{:#index}}">
            <div class="col-12 card px-0 ">
                <div class="card-header bg-transparent">

                    <div class="d-flex flex-column flex-lg-row text-center text-md-left justify-content-md-between align-items-center">
                        <div class="col-12 col-lg-9">

                            <div class="md-form mb-1">
                                    <input type="text"
                                           class="form-control form-control-lg"
                                           value="{{:name}}"
                                           data-parsley-required="true"
                                           data-link="name"
                                    >
                                    <label for="question" class="active">Pregunta</label>
                            </div>

                            <span class="badge badge-secondary-two p-2 font-weight-bold rounded mt-2">
                              {{:~getType(type)}} - {{:credits}} puntos
                            </span>
                        </div>
                        <button
                            type="button"
                            class="btn btn-red btn-floating delete-question"

                          >
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>

                </div>
                <div class="card-body">



                    <ul class="list-group list-group-flush">

                        {^{for options ~isCheckbox= #data.type == 'checkbox' ~question=#index}}

                        <li class="list-group-item d-flex justify-content-between align-items-center my-2">


                           <i class="fas fa-times fa-2x text-danger mr-3 delete-option"  style="cursor:pointer;" ></i>

                            <div class="md-form flex-grow-1">
                                    <input type="text"
                                           class="form-control "
                                           value="{{:option}}"
                                           data-parsley-required="true"
                                           data-link="option"
                                    >
                                    <label for="question" class="active">Respuesta</label>
                            </div>


                            <div class="form-check">
                               {{if ~isCheckbox}}

                                    <input
                                            id="question-option{{:~question}}{{:#getIndex()}}"
                                            class="form-check-input question-option"
                                            data-link="is_right_one"
                                            type="checkbox"
                                            {{if is_right_one}} checked {{/if}}
                                    >
                                     <label class="form-check-label" for="question-option{{:~question}}{{:#getIndex()}}"></label>

                                {{else}}



                                    <input
                                            id="q{{:~question}}-a{{:#getIndex()}}"
                                            name="q{{:~question}}-answers"
                                            class="form-check-input question-option"
                                            data-link="is_right_one"
                                            type="radio"
                                            value="true"
                                            {{if is_right_one}} checked {{/if}}
                                    >
                                     <label class="form-check-label" for="q{{:~question}}-a{{:#getIndex()}}">Correcto</label>


                               {{/if}}
                           </div>



                        </li>
                        {{/for}}
                    </ul>

                    {{if ~getLocale() === 'es'}}
                        <button
                            type="button"
                            class="btn btn-primary btn-rounded mt-5 float-right clearfix add-option"

                            >
                            Agregar Respuesta
                        </button>
                    {{/if}}

                </div>
            </div>
        </div>


    `;

}
