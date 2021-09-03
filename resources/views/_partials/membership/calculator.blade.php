<section id="calculator" class="container-fluid mt-5">

    <div class="wow slideInDown">


        <h2 class="h2-responsive text-primary font-weight-bold text-center text-uppercase">
            {{__('web/membership.calculator')['title']}}
        </h2>

        <p class="text-muted text-center mt-1">
            {{__('web/membership.calculator')['subtitle']}}

        </p>

        <!-- INVESTMENT FORM -->
        <form action="" id="calculatorForm" data-parsley-validate="true">
            <div class="row mt-5">

                <div class="col-12 d-flex flex-column flex-lg-row wrap">
                    <div class="md-form form-group flex-grow-1 mr-0 mr-lg-4">
                        <input id="initialInvestment"
                               type="text"
                               placeholder="50,000"
                               class="form-control form-control-lg"
                               data-parsley-required="true"
                               data-parsley-type="number"/>
                        <label for="investment-amount" class="control-label">
                            {{__('web/membership.calculator')['input_label']}}
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg flex-shrink-1">
                        <i class="fas fa-calculator mr-2"></i>
                        {{__('web/membership.calculator')['cta']}}
                    </button>
                </div>


            </div>
        </form>
    </div>
    <!--INVESTMENT FORM -->

    <div class="row mt-5 wow slideInUp" data-wow-delay=".6s">

        <!-- ANUAL PROFIT -->
        <div class="col-12 col-lg-6">
            <h3 class="h3-responsive font-weight-bold text-secondary text-uppercase text-center">
                {{__('web/membership.profits')['anual']['title']}}
            </h3>
            <div class="table-responsive text-nowrap">

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>{{__('web/membership.profits')['anual']['table_cross']}}</th>
                        <th>{{__('web/membership.profits')['anual']['first_year']}}</th>
                        <th>{{__('web/membership.profits')['anual']['third_year']}}</th>
                        <th>{{__('web/membership.profits')['anual']['fifth_year']}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>10.44%</td>
                        <td id="yearly-investment11"></td>
                        <td id="yearly-investment13"></td>
                        <td id="yearly-investment15"></td>
                    </tr>
                    <tr>
                        <td>13.92%</td>
                        <td id="yearly-investment21"></td>
                        <td id="yearly-investment23"></td>
                        <td id="yearly-investment25"></td>
                    </tr>
                    <tr>
                        <td>17.4%</td>
                        <td id="yearly-investment31"></td>
                        <td id="yearly-investment33"></td>
                        <td id="yearly-investment35"></td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th colspan="4" class="text-right text-muted">
                            {{__('web/membership.profit_tax')}}
                        </th>
                    </tr>
                    </tfoot>
                </table>

            </div>
        </div>

        <!-- MONTHLY PROFIT -->
        <div class="col-12 col-lg-6 mt-3 mt-lg-0">


            <h3 class="h3-responsive font-weight-bold text-secondary text-uppercase text-center">
                {{__('web/membership.profits')['monthly']['title']}}
            </h3>
            <div class="table-responsive text-nowrap">

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>{{__('web/membership.profits')['monthly']['table_cross']}}</th>
                        <th>{{__('web/membership.profits')['monthly']['twelve_months']}}</th>
                        <th>{{__('web/membership.profits')['monthly']['thirty_six_months']}}</th>
                        <th>{{__('web/membership.profits')['monthly']['sixty_months']}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>0.87%</td>
                        <td id="monthly-investment11"></td>
                        <td id="monthly-investment13"></td>
                        <td id="monthly-investment15"></td>
                    </tr>
                    <tr>
                        <td>1.16%</td>
                        <td id="monthly-investment21"></td>
                        <td id="monthly-investment23"></td>
                        <td id="monthly-investment25"></td>
                    </tr>
                    <tr>
                        <td>1.45%</td>
                        <td id="monthly-investment31"></td>
                        <td id="monthly-investment33"></td>
                        <td id="monthly-investment35"></td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th colspan="4" class="text-right text-muted">
                            {{__('web/membership.profit_tax')}}
                        </th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!-- MONTHLY PROFIT -->
    </div>
</section>
