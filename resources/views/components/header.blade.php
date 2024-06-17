<?php

use Illuminate\Support\Facades\Auth;
use App\Models\User;
?>


<header>
    <div class="container">
        <div class="h_content">
            <a href="/"><img src="{{asset('assets/img/header_logo.svg')}}" alt="" class="header_logo"></a>
            <ul class="h_menu">
                <li><a href="/#kurses" class="text3 h_link">Курсы</a></li>
                <li><a href="/#test" class="text3 h_link">Пройти тест</a></li>
                <li><a href="/#review" class="text3 h_link">Отзывы</a></li>
                <li><a href="/#blog" class="text3 h_link">Блог</a></li>
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
            <a href="/login" id="descktop_login" class="text3 small_button">Регистрация/Войти
                <img src="{{asset('assets/img/icon_login.svg')}}" alt="" class="icon_login"></a>
            <a href="/login" id="mobile_login" class="text3 small_button">
                <img src="{{asset('assets/img/icon_login.svg')}}" alt="" class="icon_login"></a>
            @endauth
        </div>
    </div>
</header>