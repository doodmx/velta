<div class="card-body pb-0">

    <div class="row">

        <div class="col-12">

            {{Form::open(['method'=>'GET','url' => route('web.blog.index')])}}
            <div class="md-form">
                <input
                        type="text"
                        class="form-control form-control-lg"
                        name="querySearch"
                        placeholder="">
                <label>
                    {!! __('web/blog.search_copy') !!}
                </label>

            </div>
            <div class="mt-1 float-right clearfix">
                <button type="submit" class="btn btn-primary btn-md btn-rounded">
                    <i class="fas fa-search"></i> {!! __('web/blog.search_button') !!}
                </button>
            </div>
            {{Form::close()}}
        </div>

    </div>

</div>
