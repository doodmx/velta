<div class="row no-gutters   justify-content-between align-items-center" id="myHeader">

    <div>
        <h1 class="text-primary font-weight-bold">
            {{$module}}
        </h1>
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb primary">

            @foreach($routes as $route)

                <li class="breadcrumb-item">
                    <a href="{{isset($route['url']) ? $route['url'] : '#'}}"
                       class="{{!isset($route['url'])?'text-primary':'text-secondary'}}"
                            {{!isset($route['url'])?'aria-current="page"':''}}
                    >
                        {{$route['description']}}

                    </a>
                </li>
            @endforeach
        </ol>
    </nav>
</div>


