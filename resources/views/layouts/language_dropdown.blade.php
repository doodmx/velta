<ul class="nav navbar-nav nav-flex-icons ml-auto ">
    <!-- Dropdown -->
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle waves-effect align-items-center d-flex" href="#" id="userDropdown"
           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="iti-flag {{config('locale.languages')[app()->getLocale()][3]}}"></div>
            <div class="mx-2 text-uppercase"> {{app()->getLocale()}}</div>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            @foreach (config('locale.languages') as $i => $lang)
                @if ($lang[0] != app()->getLocale())
                    <a href="{{route('web.changeLocale',$lang[0])}}"
                       class="dropdown-item align-items-center d-flex">
                        <div class="iti-flag {{$lang[3] }}"></div>
                        <span class="pl-2">{{$lang[4] }}</span>
                    </a>
                @endif
            @endforeach
        </div>
    </li>
</ul>


