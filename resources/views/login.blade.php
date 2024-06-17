<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="google-site-verification" content="xB-at2R64Yh-rvKTzhvNLKaoJq3BFwbZMC8fKteUaSY" />

    <meta property="og:site_name" content="EasyFrench">
    <meta property="og:type" content="website">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:title" content="EasyFrench - французский по онлайн-урокам ">
    <meta property="og:description" content="Сайт для самостоятельного изучения французского языка">
    <meta property="og:image" content="http://x223.pautinaweb.ru/try_diplom/assets/img/og_image.jpg">
    <meta property="og:url" content="http://x223.pautinaweb.ru/try_diplom/">


    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{asset('assets/css/profile.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/kurs.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/reg.css')}}">
    <link rel="shortcut icon" href="{{asset('assets/img/favicon.svg')}}" type="image/x-icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Onest:wght@100..900&display=swap');
    </style>



    <script src="{{asset('assets/js/tabs.js')}}" defer></script>
    <script src="{{asset('assets/js/scroll.js')}}" defer></script>
    <script src="{{asset('assets/js/header.js')}}" defer></script>
    <script src="{{asset('assets/js/profile_tabs.js')}}" defer></script>
    <script src="{{asset('assets/js/validation.js')}}" defer></script>

    <title>Авторизация</title>
</head>

<body>
    <div class="registration">
        <div class="container">
            <div class="reg_content">
                <div class="modal">
                    <a href="/" class="close_krest"><img src="{{asset('assets/img/icons/X_black.svg')}}" alt=""></a>
                    <a href="/"><img src="{{asset('assets/img/header_logo.svg')}}" alt="" class="form_logo"></a>
                    <h1>Авторизация</h1>
                    <form method="post" action="/login" class="form_profile" id="auth_form">
                        @csrf
                        <div class="animate_input">
                            <div class="form">
                                <input type="text" name="email" id="email" placeholder="" value="{{old('email')}}">
                                <label for="email">Email</label>
                            </div>
                            @error('email')
                            <p class="error red">{{$message}}</p>
                            @enderror
                        </div>


                        <div class="animate_input">
                            <div class="form">
                                <input type="password" name="password" id="password" placeholder="" value="">
                                <label for="password">Пароль</label>
                                <i class="bi bi-eye-slash" id="togglePassword"></i>
                            </div>
                            @error('password')
                            <p class="error red">{{$message}}</p>
                            @enderror
                        </div>

                    </form>

                    <button form="auth_form" class="button black_btn text2" id="register_btn" disabled>Войти</button>
                    <p class="signin_link text3 ">Еще нет аккаунта? <a href="/register">Регистрация</a></p>
                </div>

            </div>
        </div>
    </div>

</body>

</html>