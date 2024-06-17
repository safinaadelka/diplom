<header>
    <div class="container">
        <div class="h_content">
            <a href="/"><img src="{{asset('assets/img/header_logo.svg')}}" alt="" class="header_logo"></a>
            <ul class="h_menu">
                <button id="toggleMenu">
                    <p class="text2">меню</p><img src="{{asset('assets/img/icons/DiamondsFour.svg')}}" alt="">
                </button>
            </ul>

            @auth
            @if (Auth::user() && Auth::user()->role_id == 2)
            <a href="/profile" id="descktop_login" class="text3 small_button">
                <img src="{{asset('assets/img/icons/User.svg')}}" alt="">Личный кабинет
            </a>
            <a href="/profile" id="mobile_login" class="text3 small_button"><img src="{{asset('assets/img/icons/User.svg')}}" alt="" class="icon_login"></a>
            @elseif (Auth::user() && Auth::user()->role_id == 3)
            <a href="/admin" id="descktop_login" class="text3 small_button">
                <img src="{{asset('assets/img/icons/User.svg')}}" alt="">Личный кабинет
            </a>
            <a href="/admin" id="mobile_login" class="text3 small_button"><img src="{{asset('assets/img/icons/User.svg')}}" alt="" class="icon_login"></a>
            @endif
            @else
            <a href="/login" id="descktop_login" class="text3 small_button">Регистрация/Войти <img src="{{asset('assets/img/icon_login.svg')}}" alt="" class="icon_login"></a>
            <a href="/login" id="mobile_login" class="text3 small_button"><img src="{{asset('assets/img/icon_login.svg')}}" alt="" class="icon_login"></a>
            @endauth
        </div>
    </div>
</header>