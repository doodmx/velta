export default function getQuizHtml() {

    return `

       <div class="row no-gutters">
            <div class="col-12 card bg-transparent shadow-none">
                <div class="card-body">
                    <div class="md-form">
                        <input type="text"
                               data-link="name"
                               class="form-control form-control-lg "
                               data-parsley-required="true"
                               autofocus
                        >
                        <label for="question" class="active">Nombre del cuestionario</label>
                    </div>

                     <div class="md-form">
                        <input type="text"
                               data-link="credits_to_approve"
                               class="form-control form-control-lg "
                               data-parsley-required="true"
                               data-parsley-type="number"
                        >
                        <label for="question" class="active">Puntos necesarios para aprobar</label>
                    </div>

                    <div class="md-form">
                            <textarea
                                    id="briefing"
                                    data-link="briefing"
                                    class="md-textarea form-control form-control-lg"
                                    rows="2"></textarea>
                        <label for="briefing" class="active">Instrucciones</label>
                    </div>

                    {^{if total_credits > 0 }}
                     <span class="lead badge badge-primary font-weight-bold p-2 rounded d-block d-md-inline-block mr-md-3 float-right clearfix">
                         <i class="fas fa-poll-h text-tangaroa"></i> {^{:total_credits}} puntos
                     </span>

                     {{/if}}

                </div>
            </div>
        </div>

    `;

}
