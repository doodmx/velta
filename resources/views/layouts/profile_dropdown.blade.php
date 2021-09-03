<li class="nav-item dropdown mx-2">
    <a class="nav-link dropdown-toggle waves-effect" href="#" id="userDropdown" data-toggle="dropdown"
       aria-haspopup="true" aria-expanded="false">

        <img
            src="{{!empty(auth()->user()->profile->photo) ? asset(auth()->user()->profile->photo) : 'https://cdn.veltacorp.com/img/user.png'}}"
            class="profile-avatar"
            alt=""/>

        <div class="clearfix d-none d-sm-inline-block ml-2">
            {{ auth()->user()->profile->name }}
        </div>

    </a>
    <!-- PROFILE LINK -->


    <!-- LOGOUT LINK -->
    <div class="dropdown-menu dropdown-menu-right  dropdown-primary" aria-labelledby="userDropdown">
        <a class="dropdown-item" href="{{route('users.profile',auth()->user()->id)}}">
            {{__('web/menu.profile')}}
        </a>
        <a class="dropdown-item {{ (request()->is('partner/investments*')) ? 'active' : '' }}"
           href="{{ route('investments.index') }}" data-offset="100">
            <strong>{{__('web/menu.my_investors')}}</strong>
        </a>
        <a class="dropdown-item {{ (request()->is('enrolls*')) ? 'active' : '' }}"
           href="{{ route('web.enrolls')}}" data-offset="100">
            <strong>{{__('web/menu.enrolls')}}</strong>
        </a>
        <a class="dropdown-item" href="{{ route('logout') }}"
           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            {{ __('web/menu.signout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST"
              style="display: none;">
            @csrf
        </form>

    </div>
    <!-- LOGOUT LINK -->
</li>
