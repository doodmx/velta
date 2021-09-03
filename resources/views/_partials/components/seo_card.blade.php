<ul class="nav md-tabs bg-primary nav-justified">
    <li class="nav-item waves-effect waves-light">
        <a class="nav-link active" data-toggle="tab" href="#desktop-seo" role="tab">Vista Previa Escritorio</a>
    </li>
    <li class="nav-item waves-effect waves-light">
        <a class="nav-link" data-toggle="tab" href="#mobile-seo" role="tab">Vista Previa Móvil</a>
    </li>

</ul>

<div class="tab-content" id="pills-tabContent">
    <!-- DESKTOP SEO -->
    <div class="tab-pane fade show active" id="desktop-seo" role="tabpanel" aria-labelledby="desktop-seo-tab">
        <div class="google-card mt-3">
            <cite class="cite">
                azellft.test
                <span class="caret">
                <i class="fas fa-angle-right caret ml-2"></i>
                blog
                <i class="fas fa-caret-down caret ml-1"></i>
            </span>
            </cite>
            <h3 class="title mt-1">
                <span class="post-title">{{$title}}</span>
                <span class="post-separator">{{$separator}}</span> Velta
            </h3>
            <p class="description">
                {{$description}}
            </p>
        </div>

    </div>
    <!-- END DESKTOP SEO -->

    <!-- MOBILE SEO -->
    <div class="tab-pane fade" id="mobile-seo" role="tabpanel" aria-labelledby="mobile-seo-tab">

        <div class="google-card mt-3">

            <div class="row justify-content-center align-items-center">
                <div class="col-6 col-lg-6">
                    <cite class="cite">
                        velta
                        <span class="caret">
                            <i class="fas fa-angle-right caret ml-2"></i>
                            blog
                            <i class="fas fa-caret-down caret ml-1"></i>
                        </span>
                    </cite>
                    <h3 class="title mt-1">
                        <span class="post-title">{{$title}}</span>
                        <span class="post-separator">{{$separator}}</span> Velta
                    </h3>
                    <p class="description">
                        {{$description}}
                    </p>
                </div>
                <div class="col-6 col-lg-3">

                    {{ Html::image($image, 'Vista Previa de Seo', [
                       'id' => 'seoThumbnail',
                       'class' => 'img-fluid avatar',
                       'src'=>'https://cdn.veltacorp.com/img/placeholder.svg'
                    ]) }}

                </div>
            </div>

        </div>
    </div>
    <!-- END MOBILE SEO -->
</div>

