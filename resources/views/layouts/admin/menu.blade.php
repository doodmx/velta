<!-- USERS OPTIONS -->
@if(auth()->user()->hasRole('Super Admin') || auth()->user()->hasAnyDirectPermission(['analytics']))
    <li>
        <a href="{{route('analytics')}}"
           class="collapsible-header waves-effect {{request()->routeIs('analytics') ? 'active':''}}">
            <i class="fas fa-chart-pie"></i> Estadísticas del Sitio
        </a>
    </li>
@endif
<!--USER OPTIONS -->

<!-- USERS OPTIONS -->
@if(auth()->user()->hasRole('Super Admin') || auth()->user()->hasAnyDirectPermission(['view_users']))
    <li>
        <a href="{{route('users.index')}}"
           class="collapsible-header waves-effect {{request()->routeIs('users.index') ? 'active':''}}">
            <i class="fas fa-users"></i> Usuarios
        </a>
    </li>
@endif
<!--USER OPTIONS -->


<!--ROLE OPTIONS -->

<li>
    @if(auth()->user()->hasRole('Super Admin') || auth()->user()->hasAnyDirectPermission(['view_roles','create_role']))
        <a class="collapsible-header waves-effect arrow-r">
            <i class="fas fa-users"></i>Roles de Usuario<i class="fas fa-angle-down rotate-icon"></i>
        </a>
    @endif
    <div class="collapsible-body">
        <ul>
            @if(auth()->user()->hasPermissionTo('create_role') || auth()->user()->hasRole('Super Admin'))
                <li>
                    <a href="{{route('roles.create')}}"
                       class="collapsible-header waves-effect  {{request()->routeIs('roles.create') ? 'active':''}}">
                        <i class="fas fa-plus"></i>Nuevo
                    </a>
                </li>
            @endif


                @if(auth()->user()->hasPermissionTo('view_roles') || auth()->user()->hasRole('Super Admin') )
                    <li>
                        <a href="{{route('roles.index')}}"
                           class="collapsible-header waves-effect  {{request()->routeIs('roles.index') ? 'active':''}}">
                            <i class="fas fa-list-alt"></i> Catálogo
                        </a>
                    </li>
                @endif


        </ul>
    </div>
</li>
<!--ROLE OPTIONS -->


<!-- BLOG OPTIONS -->
<li>
    @if(auth()->user()->hasRole('Super Admin') || auth()->user()->hasAnyDirectPermission(['view_categories','view_tags','view_blogs','create_blog']))
        <a class="collapsible-header waves-effect arrow-r">
            <i class="fas fa-file-pdf"></i>Blog<i class="fas fa-angle-down rotate-icon"></i>
        </a>
    @endif
    <div class="collapsible-body">
        <ul>

            @if(auth()->user()->hasPermissionTo('view_tags') || auth()->user()->hasRole('Super Admin') )
                <li>
                    <a href="{{route('tags.index')}}"
                       class="collapsible-header waves-effect  {{request()->routeIs('tags.index') ? 'active':''}}">
                        <i class="fas fa-tag"></i>Etiquetas
                    </a>
                </li>
            @endif


            @if(auth()->user()->hasPermissionTo('view_categories') || auth()->user()->hasRole('Super Admin'))
                <li>
                    <a href="{{route('categories.index')}}"
                       class="collapsible-header waves-effect  {{request()->routeIs('categories.index') ? 'active':''}}">
                        <i class="fas fa-list-alt"></i>Categorías
                    </a>
                </li>
        @endif


        <!-- POST OPTIONS -->
            <li>
                <a href="#postsCollapse"
                   class="collapsible-header waves-effect arrow-r"
                   data-toggle="collapse"
                   role="button"
                   aria-expanded="false"
                   aria-controls="postsCollapse"
                >
                    Publicaciones <i class="fas fa-angle-down rotate-icon"></i>
                </a>

                <div class="collapse" id="postsCollapse">
                    <ul>
                        @if((auth()->user()->hasPermissionTo('create_blog')|| auth()->user()->hasRole('Super Admin')) && app()->getLocale() === 'es')
                            <li>
                                <a href="{{route('blogs.create')}}"
                                   class="waves-effect {{request()->routeIs('blogs.create') ? 'active':''}}">
                                    Nueva
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->hasPermissionTo('view_blogs') || auth()->user()->hasRole('Super Admin'))
                            <li>
                                <a href="{{route('blogs.index')}}"
                                   class="waves-effect {{request()->routeIs('blogs.index') ? 'active':''}}">
                                    Catálogo
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            <li>
                <!-- POST OPTIONS -->


        </ul>
    </div>
</li>
<!-- BLOG OPTIONS-->


<!-- COURSE OPTIONS -->
<li class="{{request()->routeIs('courses.*') ? 'active':''}}">
    @if(auth()->user()->hasRole('Super Admin') || auth()->user()->hasAnyDirectPermission(['view_courses','create_course','edit_course','delete_course']))
        <a class="collapsible-header waves-effect arrow-r {{request()->routeIs('courses.*') ? 'active':''}}">
            <i class="fas fa-bookmark"></i>Cursos<i class="fas fa-angle-down rotate-icon"></i>
        </a>
    @endif
    <div class="collapsible-body">
        <ul>

            <!-- COURSE CATEGORIES OPTIONS -->
            <li>
                <a href="#courseTypeCollapse"
                   class="collapsible-header waves-effect arrow-r"
                   data-toggle="collapse"
                   role="button"
                   aria-expanded="false"
                   aria-controls="courseTypeCollapse"
                >
                    Categorías <i class="fas fa-angle-down rotate-icon"></i>
                </a>

                <div class="collapse" id="courseTypeCollapse">
                    <ul>
                        @if((auth()->user()->hasPermissionTo('create_course_category') || auth()->user()->hasRole('Super Admin')) && app()->getLocale() === 'es')
                            <li>
                                <a href="{{route('course_types.create')}}"
                                   class="collapsible-header waves-effect  {{request()->routeIs('course_types.create') ? 'active':''}}">
                                    <i class="fas fa-plus"></i> Nueva
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->hasPermissionTo('view_course_categories') || auth()->user()->hasRole('Super Admin'))
                            <li>
                                <a href="{{route('course_types.index')}}"
                                   class="collapsible-header waves-effect  {{request()->routeIs('course_types.index') ? 'active':''}}">
                                    <i class="fas fa-list-alt"></i> Catálogo
                                </a>
                            </li>
                        @endif


                    </ul>
                </div>
            <li>
                <!-- COURSE CATEGORIES OPTIONS -->

                <!-- COURSE LIST OPTIONS -->
            <li>
                <a href="#courseListCollapse"
                   class="collapsible-header waves-effect arrow-r"
                   data-toggle="collapse"
                   role="button"
                   aria-expanded="false"
                   aria-controls="courseListCollapse"
                >
                    Cursos <i class="fas fa-angle-down rotate-icon"></i>
                </a>

                <div class="collapse" id="courseListCollapse">
                    <ul>
                        @if((auth()->user()->hasPermissionTo('create_course') || auth()->user()->hasRole('Super Admin')) && app()->getLocale() === 'es' )
                            <li>
                                <a href="{{route('courses.create')}}"
                                   class="collapsible-header waves-effect  {{request()->routeIs('courses.create') ? 'active':''}}">
                                    <i class="fas fa-plus"></i> Nuevo
                                </a>
                            </li>
                        @endif

                        @if(auth()->user()->hasPermissionTo('view_courses') || auth()->user()->hasRole('Super Admin'))
                            <li>
                                <a href="{{route('courses.index')}}"
                                   class="collapsible-header waves-effect  {{request()->routeIs('courses.index') ? 'active':''}}">
                                    <i class="fas fa-list-alt"></i> Catálogo
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            <li>
                <!-- COURSE LIST OPTIONS -->


        </ul>
    </div>
</li>
<!-- COURSE OPTIONS -->



@if(auth()->user()->hasPermissionTo('view_payments')|| auth()->user()->hasRole('Super Admin'))
    <li>
        <a href="{{route('payments.index')}}"
           class="waves-effect {{request()->routeIs('payments.index') ? 'active':''}}">
            <i class="fas fa-wallet"></i> Pagos
        </a>
    </li>
@endif
