<form action="" id="frmAnalytics">

    <div class="row wrap justify-content-between align-items-center">
        <!-- FROM DATE-->
        <div class="col-12 col-lg-4">

            <div class="md-form">
                <input
                    type="text"
                    id="txtFrom"
                    class="form-control form-control-lg datepicker"
                    name="from"
                    data-value="{{\Carbon\Carbon::now()->subDays(7)->format('Y-m-d')}}"
                    required
                >
                <label class="active">Desde</label>
            </div>


        </div>
        <!-- FROM DATE -->

        <!-- TO DATE -->
        <div class="col-12 col-lg-4">

            <div class="md-form">
                <input
                    type="text"
                    id="txtTo"
                    class="form-control form-control-lg datepicker"
                    name="to"
                    data-value="{{\Carbon\Carbon::now()->format('Y-m-d')}}"
                    required
                >
                <label class="active">Hasta</label>
            </div>
        </div>

        <!-- TO DATE -->

        <div class="col-12 col-lg-4">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="fas fa-search"></i> Generar reporte
            </button>
        </div>
    </div>

</form>
