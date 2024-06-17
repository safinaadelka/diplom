<?php

use App\Models\Word;
use App\Models\Lesson;
use App\Models\Kurs;
use App\Models\Study;
use App\Models\Certificate;
use App\Models\Dictionary;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="google-site-verification" content="xB-at2R64Yh-rvKTzhvNLKaoJq3BFwbZMC8fKteUaSY" />
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <meta property="og:site_name" content="EasyFrench">
    <meta property="og:type" content="website">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:title" content="EasyFrench - французский по онлайн-урокам ">
    <meta property="og:description" content="Сайт для самостоятельного изучения французского языка">
    <meta property="og:image" content="http://x223.pautinaweb.ru/try_diplom/assets/img/og_image.jpg">
    <meta property="og:url" content="http://x223.pautinaweb.ru/try_diplom/">

    <link rel="stylesheet" href="{{asset('assets/css/reg.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{asset('assets/css/profile.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/kurs.css')}}">

    <link rel="shortcut icon" href="{{asset('assets/img/favicon.svg')}}" type="image/x-icon">


    <script src="https://code.responsivevoice.org/responsivevoice.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Onest:wght@100..900&display=swap');
    </style>


    <script src="{{asset('assets/js/tabs.js')}}" defer></script>
    <script src="{{asset('assets/js/scroll.js')}}" defer></script>
    <script src="{{asset('assets/js/header.js')}}" defer></script>
    <script src="{{asset('assets/js/profile_tabs.js')}}" defer></script>
    <script src="{{asset('assets/js/validation.js')}}" defer></script>
    <script src="{{asset('assets/js/admin_tabs.js')}}" defer></script>
    <script src="{{asset('assets/js/open_modal.js')}}" defer></script>
    <script src="{{asset('assets/js/lesson_tabs.js')}}" defer></script>
    <script src="{{asset('assets/js/status.js')}}" defer></script>
    <script src="{{asset('assets/js/searchWords.js')}}" defer></script>
    <script src="{{asset('assets/js/searchMyWords.js')}}" defer></script>

    <script src="{{asset('assets/js/dictionaryProfile.js')}}" defer></script>
    <script src="{{asset('assets/js/dictionary_tabs.js')}}" defer></script>


    <script src="{{asset('assets/js/sound.js')}}" defer></script>
    <title>Admin</title>
</head>


<body>
    <div class="modal_small" id="successEditModal">
        <div class="container">
            <div class="modal_small_inner">
                <img src="{{asset('assets/img/icons/success.svg')}}" alt="" class="">
                <p class="text2_reg">Изменения сохранены!</p>
            </div>

        </div>
    </div>

    <div class="modal_small" id="successAddModal">
        <div class="container">
            <div class="modal_small_inner">
                <img src="{{asset('assets/img/icons/success.svg')}}" alt="" class="">
                <p class="text2_reg">Обьект создан!</p>
            </div>

        </div>
    </div>


    <div class="modal_small" id="successDeleteModal">
        <div class="container">
            <div class="modal_small_inner">
                <img src="{{asset('assets/img/icons/successDelete.svg')}}" alt="" class="">
                <p class="text2_reg">Обьект удален!</p>
            </div>

        </div>
    </div>


    @include('components.header_profile')
    @php
    $user = Auth::user();
    @endphp


    <div class="profile_nav" id="profile_nav">
        <div class="profile_nav_up">
            <div class="profile_foto"><img src="{{asset("/storage/avas/".$user->foto)}}" alt="" class=""></div>
            <div class="profile_nav_up_main">
                <h3>{{$user->surname}} {{$user->name}}</h3>
                <p class="text4">
                    @if ($user->role_id === 3)
                    Администратор
                    @elseif ($user->role_id === 2)
                    Пользователь
                    @endif
                </p>
            </div>
            <a href="#" class="krest" id="krest"><img src="{{asset('assets/img/icons/X.svg')}}" alt=""></a>
        </div>
        <div class="profile_nav_scroll">
            <p class="text4">Управление</p>
            <a href="#" class="profile_nav_link text1" data-tab="tab5">
                <img src="{{asset('assets/img/icons/DiamondsFour.svg')}}" alt="" class="profile_nav_icon">Админ-панель</a>

            <a href="#" class="profile_nav_link text3" data-tab="tab6">
                Курсы</a>
            <a href="#" class="profile_nav_link text3" data-tab="tab7">
                Уроки</a>
            <a href="#" class="profile_nav_link text3" data-tab="tab8">
                Словарь</a>

            <br>
            <p class="text4">Обучение</p>
            <a href="#" class="profile_nav_link text1" data-tab="tab1">
                <img src="{{asset('assets/img/icons/House.svg')}}" alt="" class="profile_nav_icon">Главная</a>
            <a href="#" class="profile_nav_link text1" data-tab="tab2"><img src="{{asset('assets/img/icons/ChartBar.svg')}}" alt="" class="profile_nav_icon">Мои курсы</a>
            <a href="#" class="profile_nav_link text1" data-tab="tab3"><img src="{{asset('assets/img/icons/GraduationCap_white.svg')}}" alt="" class="profile_nav_icon">Мой словарь</a>
            <a href="#" class="profile_nav_link text1" data-tab="tab4"><img src="{{asset('assets/img/icons/UserSquare.svg')}}" alt="" class="profile_nav_icon">Профиль</a>

        </div>
        @auth
        <form action="/logout" method="post">
            @csrf
            <button type="submit" class="button text2 white_btn exit">Выйти</button>
        </form>
        @endauth
    </div>









    <div class="tab_container">
        <!-- админ панель -->
        <div class="tab-content" id="tab5">
            <section class="profile">
                <div class="container">
                    <h1>Админ-панель</h1>
                    <br> <br>
                    <div class="profile_content">
                        <div class="admin_profile_content">
                            <a href="#" class="profile_block yellow_color">
                                <div class="dictiony_up">
                                    <h2>Курсы</h2>
                                    <button href="#" class="black_arrow_btn"><img src="{{asset('assets/img/arrow_white.svg')}}" alt="" class="black_arrow"></button>
                                </div>
                                @php
                                $IssetKurses = Kurs::where('status', 1)->get();
                                $NonKurses = Kurs::where('status', 0)->get();
                                @endphp
                                <div class="dictionary_main">
                                    <div class="dictionary_statistic">
                                        <p class="text2_reg">на модерации</p>
                                        <h3>{{ $NonKurses->count()}}</h3>
                                    </div>
                                    <div class="dictionary_statistic">
                                        <p class="text2_reg">опубликовано</p>
                                        <h3>{{$IssetKurses->count()}}</h3>
                                    </div>

                                </div>
                                <img src="{{asset('assets/img/levels.svg')}}" alt="" class="go_image">
                            </a>

                            <a href="#" class="profile_block green_color">
                                <div class="dictiony_up">
                                    <h2>Уроки</h2>
                                    <button href="#" class="black_arrow_btn"><img src="{{asset('assets/img/arrow_white.svg')}}" alt="" class="black_arrow"></button>
                                </div>
                                @php
                                $IssetLessons = Lesson::whereNot('modul', 0)->get();
                                $NonLessons = Lesson::where('modul', 0)->get();
                                @endphp
                                <div class="dictionary_main">
                                    <div class="dictionary_statistic">
                                        <p class="text2_reg">на модерации</p>
                                        <h3>{{$NonLessons->count()}}</h3>
                                    </div>
                                    <div class="dictionary_statistic">
                                        <p class="text2_reg">опубликованы</p>
                                        <h3>{{$IssetLessons->count()}}</h3>
                                    </div>
                                </div>
                                <img src="{{asset('assets/img/icons/BookOpen.svg')}}" alt="" class="go_image">
                            </a>
                            <a href="#" class="profile_block sky_color">
                                <div class="dictiony_up">
                                    <h2>Словарь</h2>
                                    <button href="#" class="black_arrow_btn"><img src="{{asset('assets/img/arrow_white.svg')}}" alt="" class="black_arrow"></button>
                                </div>
                                @php
                                $all_words = Word::all();
                                @endphp
                                <div class="dictionary_main">
                                    <div class="dictionary_statistic">
                                        <p class="text2_reg">всего слов</p>
                                        <h3>{{$all_words->count()}}</h3>
                                    </div>
                                </div>
                                <img src="{{asset('assets/img/icons/GraduationCap_white.svg')}}" alt="" class="go_image">
                            </a>
                            <a href="#" class="profile_block violet_color">
                                <div class="dictiony_up">
                                    <h2>Пользователи</h2>
                                    <button href="#" class="black_arrow_btn"><img src="{{asset('assets/img/arrow_white.svg')}}" alt="" class="black_arrow"></button>
                                </div>
                                <div class="dictionary_main">
                                    <p class="text2_reg">Поиск и модерация пользователей</p>
                                </div>
                                <img src="{{asset('assets/img/users_avas.svg')}}" alt="" class="user_avas">
                            </a>



                            <a href="#" class="profile_block white_color">
                                <div class="dictiony_up">
                                    <h2>Блог</h2>
                                    <button href="#" class="black_arrow_btn"><img src="{{asset('assets/img/arrow_white.svg')}}" alt="" class="black_arrow"></button>
                                </div>
                                <br>
                                <div class="profile_block_down">
                                    <div class="new_up">
                                        <img src="{{asset('assets/img/new_foto.jpg')}}" alt="" class="user_avas">
                                    </div>
                                </div>
                            </a>

                            <a href="#" class="profile_block coral_color">
                                <div class="dictiony_up">
                                    <h2>Отзывы</h2>
                                    <button href="#" class="black_arrow_btn"><img src="{{asset('assets/img/arrow_white.svg')}}" alt="" class="black_arrow"></button>
                                </div>

                                <img src="{{asset('assets/img/icons/ChatCircleText.svg')}}" alt="" class="go_image">
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- админ панель -->

        <!-- курсы -->
        <div class="tab-content" id="tab6">
            <section class="profile" id="mydictionary">
                <div class="container">
                    <div class="mycourses_content">
                        <div class="up">
                            <h1>Курсы</h1>
                            <a href="/add_kurs" class="button green_btn">
                                <p class="text2">Новый курс</p><img src="{{asset('assets/img/icons/Plus.svg')}}" alt="" class="btn_icon">
                            </a>
                        </div>
                        <div class="kurs_cards">
                            @php
                            $kurses = Kurs::all();
                            @endphp

                            @foreach ($kurses as $kurs)
                            <div class="kurs_card" id="kurs_card_1">


                                <h2 class="kurs_card_name"><a style="color:black" href="/modul/{{$kurs->id}}">{{$kurs->name}}</a></h2>
                                <ul class="kurs_card_info">
                                    <p class="text2_reg">{{$kurs->descript}}</p>
                                </ul>
                                <div class="kurs_statistics">
                                    <div class="kurs_statistic">
                                        <img src="{{asset('assets/img/icons/ChatTeardropDots.svg')}}" alt="" class="kurs_statistic_icon">
                                        <div class="kurs_statistic_text">
                                            @php
                                            if($kurs->lessons){
                                            $lessons = json_decode(json_decode(($kurs->lessons)));
                                            $kurs_lessons = Lesson::whereIn('id', $lessons)->get()->sortBy(function ($item) use ($lessons) {
                                            return array_search($item->id, $lessons);
                                            });
                                            $lessonsCount = count($kurs_lessons);
                                            }
                                            @endphp

                                            <p class="text1">{{$lessonsCount}}</p>
                                            <p class="text4">{{ $lessonsCount == 1 ? 'урок' : ($lessonsCount >= 2 && $lessonsCount <= 4 ? 'урока' : 'уроков') }}</p>

                                        </div>

                                    </div>

                                    <div class="kurs_statistic">
                                        <img src="{{asset('assets/img/icons/Exam.svg')}}" alt="" class="kurs_statistic_icon">

                                        <div class="kurs_statistic_text">
                                            <p class="text1">3</p>
                                            <p class="text4">теста</p>
                                        </div>
                                    </div>

                                    <div class="kurs_statistic">
                                        <img src="{{asset('assets/img/icons/GraduationCap.svg')}}" alt="" class="kurs_statistic_icon">
                                        <div class="kurs_statistic_text">
                                            <p class="text1">100+</p>
                                            <p class="text4">слов</p>
                                        </div>

                                    </div>
                                </div>
                                <div class="kurs_card_about">
                                    <a href="edit_kurs/{{$kurs->id}}" class="small_button text3 word_edit">Изменить <img src="{{asset('assets/img/icons/PencilSimple.svg')}}" alt=""></a>
                                    @if ($kurs->status == 1)
                                    <a href="hide_kurs/{{$kurs->id}}" class="small_button text3 word_delete">Скрыть <img src="{{asset('assets/img/icons/EyeSlash.svg')}}" alt=""></a>
                                    @elseif ($kurs->status == 0)
                                    <a href="publish_kurs/{{$kurs->id}}" class="small_button text3 green_btn">Публиковать <img src="{{asset('assets/img/icons/GlobeSimple.svg')}}" alt=""></a>
                                    @endif

                                </div>


                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- курсы -->



        <!-- уроки -->
        <div class="tab-content" id="tab7">
            <section class="profile" id="mydictionary">
                <div class="container">
                    <div class="mycourses_content" id="filterPagination">
                        <div class="up">
                            <h1>Уроки</h1>
                            <a href="/add" class="button green_btn">
                                <p class="text2">Новый урок</p><img src="{{asset('assets/img/icons/Plus.svg')}}" alt="" class="btn_icon">
                            </a>
                        </div>
                        <div class="mycourses_middle">
                            <div class="filters">
                                @php
                                $kurses = Kurs::all();
                                $IndexKurs = 1;
                                $IndexKursInner = 1;
                                @endphp
                                @foreach ($kurses as $kurs)
                                <a href="" class="filter text2 @php
                                if ($IndexKurs == 1) echo 'filter_active'
                                @endphp ">{{$kurs->name}}</a>
                                @php
                                $IndexKurs++;
                                @endphp
                                @endforeach
                                <a href="" class="filter text2 ">Новые уроки</a>
                            </div>
                            <br>
                        </div>
                        @foreach ($kurses as $kurs)
                        @if($kurs->lessons)
                        @php
                        $lessons = json_decode(json_decode(($kurs->lessons)));
                        $kurs_lessons = Lesson::whereIn('id', $lessons)->get()->sortBy(function ($item) use ($lessons) {
                        return array_search($item->id, $lessons);
                        });
                        @endphp
                        @endif


                        <div class="program_cards @php
                        if($IndexKursInner == 1) echo 'program_cards_active'; 
                        @endphp ">
                            @php
                            $LessonNumber = 1;
                            @endphp
                            @foreach ($kurs_lessons as $lesson)

                            <div class="program_card">
                                <div class="program_card_main">
                                    <div class="program_card_number">
                                        <p class="text2">
                                            {{ $LessonNumber }}
                                        </p>
                                    </div>
                                    <a href="/modul/{{$lesson->modul}}/lesson/{{$lesson->id}}" style="color: black;" class="text2">
                                        {{$lesson->name}}
                                    </a>
                                </div>
                                <div class="program_card_actions">
                                    <a href="/lesson/{{$lesson->id}}/edit" class="black_arrow_btn"><img src="{{asset('assets/img/icons/PencilSimple.svg')}}" alt=""></a>
                                    <button onclick="showDeleteLessonModal('{{$lesson->id}}', '{{rawurlencode($lesson->name)}}')" class="red_arrow_btn"><img src="{{asset('assets/img/icons/Trash.svg')}}" alt=""></button>
                                </div>
                            </div>

                            @php
                            $LessonNumber ++;
                            @endphp
                            @endforeach
                            @php
                            $IndexKursInner++;
                            @endphp

                        </div>
                        @endforeach

                        <div class="program_cards">
                            @php
                            $LessonNumber = 1;
                            $emptyLessons = Lesson::where('modul', 0)->get()->sortDesc();
                            @endphp
                            @foreach ($emptyLessons as $lesson)

                            <div class="program_card">
                                <div class="program_card_main">
                                    <div class="program_card_number">
                                        <p class="text2">
                                            {{ $LessonNumber }}
                                        </p>
                                    </div>
                                    <a href="/modul/{{1}}/lesson/{{$lesson->id}}" style="color: black;" class="text2">
                                        {{$lesson->name}}
                                    </a>
                                </div>
                                <div class="program_card_actions">
                                    <a href="/lesson/{{$lesson->id}}/edit" class="black_arrow_btn"><img src="{{asset('assets/img/icons/PencilSimple.svg')}}" alt=""></a>
                                    <button onclick="showDeleteLessonModal('{{$lesson->id}}', '{{rawurlencode($lesson->name)}}')" class="red_arrow_btn"><img src="{{asset('assets/img/icons/Trash.svg')}}" alt=""></button>
                                </div>
                            </div>
                            @php
                            $LessonNumber ++;
                            @endphp
                            @endforeach

                        </div>




                    </div>
                </div>
            </section>
        </div>
        <!-- уроки -->











        <!-- словарь -->
        <div class="tab-content" id="tab9">
            <section class="profile" id="mydictionary">
                <div class="container">
                    <div class="mycourses_content">
                        <div class="up">
                            <h1>Cловарь</h1>
                            <a id="open_word_modal" class="button green_btn">
                                <p class="text2">Новое слово</p><img src="{{asset('assets/img/icons/Plus.svg')}}" alt="" class="btn_icon">
                            </a>
                        </div>
                        <div class="mycourses_middle">
                            <div class="search_div">
                                <input type="search" id="searchInput" name="" class="text3" placeholder="Слово в оригинале или перевод">
                            </div>
                        </div>
                        <div class="mydictionary_main mydictionary_main_active">
                            @foreach ($words->reverse() as $word)
                            <div class="word_card" data-card="{{$word->id}}">
                                <div class="word_card_up">
                                    <div class="word_card_left">
                                        <h3 data-original="{{$word->original}}">{{$word->original}}</h3>
                                        <p data-translate="{{$word->translate}}" class="text2_reg">{{$word->translate}}</p>
                                    </div>
                                    <div class="word_card_actions">
                                        <button class="sound" onclick="speakWord('{{rawurlencode($word->original) }}')"><img src="{{asset('assets/img/icons/SpeakerSimpleHigh.svg')}}" alt="" class="icon_sound"></button>
                                    </div>
                                </div>

                                <div class="word_card_down">
                                    <button onclick="showDeleteModal('{{rawurlencode($word->original)}}', '{{rawurlencode($word->translate)}}', '{{$word->id}}')" class="word_delete">
                                        <p class="text2">Удалить</p><img src="{{asset('assets/img/icons/Trash.svg')}}" alt="" class="learn_icon">
                                    </button>

                                    <button onclick="showModal('{{rawurlencode($word->original)}}', '{{rawurlencode($word->translate)}}', '{{$word->id}}')" class="word_edit">
                                        <p class="text2">Изменить</p><img src="{{asset('assets/img/icons/PencilSimple.svg')}}" alt="" class="learn_icon">
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- словарь -->

        <!-- обучение -->
        @php

        $user = Auth::user();
        $my_courses_arr = Study::where('id_user', $user->id)->distinct()->pluck('modul');

        $my_courses = Kurs::whereIn('id', $my_courses_arr)->get();

        @endphp

        <div class="tab-content" id="tab1">
            <section class="profile">
                <div class="fuck"></div>
                <div class="container">
                    <div class="profile_content">
                        <div class="profile_left">

                            @php
                            $last_studies = Study::where('id_user', $user->id)->latest('updated_at')->first();

                            @endphp


                            @if ($last_studies)
                            @php
                            $last_kurs = Kurs::findOrFail($last_studies->modul);
                            @endphp

                            <div class="privet">
                                <div class="privet_main">
                                    <div class="privet_up">
                                        <h1>С возвращением, <br> {{$user->name}}</h1>
                                        <p class="text2_reg">Уроки французского ждут тебя!</p>
                                    </div>
                                    <a href="/modul/{{$last_kurs->id}}/lesson/{{$last_studies->id_lesson}}" class="button orange_btn text2">Продолжить учебу
                                        <img src="assets/img/arrow_white.svg" alt="" class="white_arrow"> </a>
                                </div>

                                <div class="benefit_card_image">
                                    <img src="assets/img/benefit_education.svg" alt="" class="privet_img">
                                </div>
                            </div>
                            @elseif(!$last_studies)
                            <div class="privet">
                                <div class="privet_main">
                                    <div class="privet_up">
                                        <h1>Начнем учиться, <br> {{$user->name}}</h1>
                                        <p class="text2_reg">Уроки французского ждут тебя!</p>
                                    </div>
                                    <a href="/#kurses" class="button orange_btn text2">Выбрать курс
                                        <img src="assets/img/arrow_white.svg" alt="" class="white_arrow"> </a>
                                </div>

                                <div class="benefit_card_image">
                                    <img src="assets/img/benefit_education.svg" alt="" class="privet_img">
                                </div>
                            </div>
                            @endif


                            <div class="user_courses">

                                @php
                                $currentIndex = 0;
                                @endphp


                                @foreach ($my_courses as $my_course)

                                @php
                                $done_studies = Study::where('modul', $my_course->id)->where('id_user', $user->id)->latest('updated_at')->first();

                                $last_lesson = Lesson::where('id', $done_studies->id_lesson)->first();


                                $LessonNumber = 0;
                                if($my_course->lessons){
                                $lessons = json_decode(json_decode(($my_course->lessons)));
                                $kurs_lessons = Lesson::whereIn('id', $lessons)->get()->sortBy(function ($item) use ($lessons) {
                                return array_search($item->id, $lessons);
                                });
                                }

                                @endphp
                                @foreach ($kurs_lessons as $link)
                                @php
                                $LessonNumber++;
                                @endphp

                                @endforeach

                                @php
                                $progress = Study::whereIn('id_lesson', $lessons)->where('status', 3)->where('id_user', $user->id)->where('modul', $my_course->id)->get();
                                @endphp

                                <a class="user_course" href="/modul/{{$my_course->id}}/lesson/{{$done_studies->id_lesson}}">
                                    <div class="user_course_left">
                                        <div>
                                            <div class="diagram">
                                                @php
                                                $progress_procent = round($progress->count() / $LessonNumber * 100);
                                                @endphp
                                                <div class="pie animate" style="--p: {{$progress_procent}};--c:#16CA48;--b:8px">
                                                    <div class="users_statistic">
                                                        <p class="text1">{{$progress_procent}}%</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="text3" id="mobile_text3">Урок {{$currentIndex+1}}. {{$last_lesson->name}}
                                            </p>
                                        </div>

                                        <div class="user_course_left_main">
                                            <h2>{{$my_course->name}}</h2>
                                            <p class="text3" id="desctop_text3">Урок {{$currentIndex+1}}. {{$last_lesson->name}}</p>
                                        </div>
                                    </div>

                                    <form action="/modul/{{$my_course->id}}" method="get">
                                        <button type="submit" href="/modul/{{$my_course->id}}" class="black_arrow_btn">
                                            <img src="assets/img/arrow_white.svg" alt="" class="black_arrow">
                                        </button>
                                    </form>

                                </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="profile_right">
                            <a href="#" class="profile_block sky_color" id="go_dictionary_admin" data-tab="tab3">
                                <div class="dictiony_up">
                                    <h2>Мой словарь</h2>
                                    <button href="#" class="black_arrow_btn"><img src="{{asset('assets/img/arrow_white.svg')}}" alt="" class="black_arrow"></button>
                                </div>
                                @php
                                $newDictionary = Dictionary::where('status', 1)->where('id_user', $user->id);
                                $forgetDictionary = Dictionary::where('status', 0)->where('id_user', $user->id);
                                $learnDictionary = Dictionary::where('status', 2)->where('id_user', $user->id);
                                @endphp
                                <div class="dictionary_main">
                                    <div class="dictionary_statistic">
                                        <p class="text2_reg">выучено</p>
                                        <h3>{{$learnDictionary->count()}}</h3>
                                    </div>
                                    <div class="dictionary_statistic">
                                        <p class="text2_reg">новых</p>
                                        <h3>{{$newDictionary->count()}}</h3>
                                    </div>
                                    <div class="dictionary_statistic">
                                        <p class="text2_reg">забыто</p>
                                        <h3>{{$forgetDictionary->count()}}</h3>
                                    </div>
                                </div>
                                <img src="{{asset('assets/img/icons/GraduationCap_white.svg')}}" alt="" class="go_image">
                            </a>
                            <div href="#" class="profile_block violet_color">
                                <div class="dictiony_up">
                                    <h2>Сертификаты</h2>
                                    <button href="#" class="black_arrow_btn"><img src="{{asset('assets/img/arrow_white.svg')}}" alt="" class="black_arrow"></button>
                                </div>

                                @php
                                $certificates = Certificate::where('id_user', $user->id)->get();
                                @endphp
                                <div class="dictionary_main">
                                    @foreach ( $certificates as $certificate)
                                    @php
                                    $path = public_path('app/public/certificates/' . $certificate->certificate);
                                    @endphp
                                    <div class="dictionary_statistic">
                                        <div class="dictionary_statistic_div">
                                            <img src="{{asset('assets/img/icons/pdf.svg')}}" alt="" class="pdf_icon">


                                            <a href="{{ Storage::url('certificates/'.$certificate->certificate) }}" class="text2_reg" download>{{$certificate->certificate}}</a>

                                        </div>
                                    </div>


                                    @endforeach


                                </div>

                            </div>
                        </div>



                    </div>
                </div>
            </section>
        </div>

        <div class="tab-content" id="tab2">
            <section class="profile" id="mycourses">
                <div class="container">
                    <div class="mycourses_content">
                        <div class="up">
                            <h1>Мои курсы</h1>
                        </div>

                        <div class="mycourses_main">
                            @foreach ($my_courses as $my_course)

                            @php
                            $done_studies = Study::where('modul', $my_course->id)->where('id_user', $user->id)->latest('updated_at')->first();

                            $last_lesson = Lesson::where('id', $done_studies->id_lesson)->first();


                            $LessonNumber = 0;
                            if($my_course->lessons){
                            $lessons = json_decode(json_decode(($my_course->lessons)));
                            $kurs_lessons = Lesson::whereIn('id', $lessons)->get()->sortBy(function ($item) use ($lessons) {
                            return array_search($item->id, $lessons);
                            });
                            }

                            @endphp
                            @foreach ($kurs_lessons as $link)
                            @php
                            $LessonNumber++;
                            @endphp

                            @endforeach

                            @php
                            $progress = Study::whereIn('id_lesson', $lessons)->where('status', 3)->where('id_user', $user->id)->where('modul', $my_course->id)->get();
                            @endphp



                            <a href="/modul/{{$my_course->id}}/lesson/{{$done_studies->id_lesson}}" class="user_course">
                                <div class="my_course_up">
                                    <div class="user_course_left">
                                        <div>
                                            <div class="diagram">
                                                @php
                                                $progress_procent = round($progress->count() / $LessonNumber * 100);
                                                @endphp

                                                <div class="pie animate" style="--p: {{ $progress_procent }}; --c:#16CA48; --b:8px">
                                                    <div class="users_statistic">
                                                        <p class="text1">
                                                            {{$progress_procent}}%
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="text3" id="mobile_text3">Урок {{$currentIndex+1}}. {{$last_lesson->name}}</p>
                                        </div>

                                        <div class="user_course_left_main">
                                            <h2>{{$my_course->name}}</h2>
                                            <p class="text3" id="desctop_text3">Урок {{$currentIndex+1}}. {{$last_lesson->name}}</p>
                                        </div>
                                    </div>
                                    <button href="/modul" class="black_arrow_btn"><img src="{{asset('assets/img/arrow_white.svg')}}" alt="" class="black_arrow"></button>
                                </div>
                                <div class="my_course_down">


                                    <form action="/delete_study/{{$my_course->id}}" method="post" id="delete_study_form">
                                        @csrf
                                        <button type="submit" form="delete_study_form" class="small_button red_btn">
                                            <p class="text3">Отписаться от курса</p> <img src="{{asset('assets/img/icons/x_white.svg')}}" alt="" class="white_arrow">
                                        </button>
                                    </form>

                                    <form action="/modul/{{$my_course->id}}" method="get">
                                        <button type="submit" class="line_button" href="/modul/{{$my_course->id}}">
                                            <p class="text3">Подробнее о курсе</p>
                                        </button>

                                    </form>

                                </div>
                            </a>

                            @endforeach




                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div class="tab-content" id="tab3">
            <section class="profile" id="mydictionary">
                <div class="container">
                    <div class="mycourses_content" id="wordPagination">
                        <div class="up">
                            <h1>Мои словарь</h1>
                            <a href="/test" class="button green_btn">
                                <p class="text2">Пройти тест</p><img src="assets/img/icons/Exam_white.svg" alt="" class="btn_icon">
                            </a>
                        </div>
                        <div class="mycourses_middle">
                            <div class="filters">
                                <a href="#" class="filter filter_active text2">Новые</a>
                                <a href="#" class="filter text2">Выучено</a>
                                <a href="#" class="filter text2">Забыто</a>
                            </div>
                            <br> <br>
                            <div class="search_div">
                                <input type="search" id="searchInputWord" name="" class="text3" placeholder="Слово в оригинале или перевод">
                            </div>
                        </div>
                        @php
                        $userId = Auth::user()->id;
                        $newWords = Dictionary::where('id_user', $userId)->where('status', 1)->get();
                        $forgetWords = Dictionary::where('id_user', $userId)->where('status', 0)->get();
                        $learnWords = Dictionary::where('id_user', $userId)->where('status', 2)->get();
                        @endphp
                        <div class="mydictionary_main mydictionary_main_active">
                            @foreach ($newWords->reverse() as $newWord)
                            @php
                            $word = Word::find($newWord->id_word);
                            @endphp
                            @if ($word)
                            <div class="word_card" data-card="{{$word->id}}">
                                <div class="word_card_up">
                                    <div class="word_card_left">
                                        <h3 data-original="{{$word->original}}">{{$word->original}}</h3>
                                        <p data-translate="{{$word->translate}}" class="text2_reg">{{$word->translate}}</p>
                                    </div>
                                    <div class="word_card_actions">
                                        <button class="sound" onclick="speakWord('{{rawurlencode($word->original) }}')"><img src="{{asset('assets/img/icons/SpeakerSimpleHigh.svg')}}" alt="" class="icon_sound"></button>
                                        <button class="save" onclick="mydictionary('{{$word->id}}')">
                                            <svg class="save_svg @if ($word) @php $dictionary = Dictionary::where('id_word', $word->id)->where('id_user', $userId)->first(); @endphp @if($dictionary) save_svg_active @endif @endif" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                                                <path d="M16.55 23.8375L22.85 27.8375C23.6625 28.35 24.6625 27.5875 24.425 26.65L22.6 19.475C22.5506 19.2762 22.5585 19.0674 22.6226 18.8728C22.6868 18.6781 22.8046 18.5056 22.9625 18.375L28.6125 13.6625C29.35 13.05 28.975 11.8125 28.0125 11.75L20.6375 11.275C20.4363 11.2633 20.2428 11.1933 20.0808 11.0734C19.9187 10.9535 19.7951 10.789 19.725 10.6L16.975 3.67503C16.9022 3.47491 16.7696 3.30204 16.5952 3.17988C16.4207 3.05772 16.2129 2.99219 16 2.99219C15.787 2.99219 15.5793 3.05772 15.4048 3.17988C15.2304 3.30204 15.0978 3.47491 15.025 3.67503L12.275 10.6C12.2049 10.789 12.0813 10.9535 11.9192 11.0734C11.7572 11.1933 11.5637 11.2633 11.3625 11.275L3.98749 11.75C3.02499 11.8125 2.64999 13.05 3.38749 13.6625L9.0375 18.375C9.19541 18.5056 9.31323 18.6781 9.37736 18.8728C9.4415 19.0674 9.44934 19.2762 9.39999 19.475L7.71249 26.125C7.42499 27.25 8.62499 28.1625 9.58749 27.55L15.45 23.8375C15.6144 23.733 15.8052 23.6775 16 23.6775C16.1948 23.6775 16.3856 23.733 16.55 23.8375Z" stroke="#FF6131" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <div class="word_card_down">
                                    <button onclick="forgetWord('{{$word->id}}')" class="forget">
                                        <p class="text2">Забыто</p><img src="assets/img/icons/no.svg" alt="" class="learn_icon">
                                    </button>
                                    <button onclick="learnWord('{{$word->id}}')" class="learn">
                                        <p class="text2">Выучить</p><img src="assets/img/icons/yes.svg" alt="" class="learn_icon">
                                    </button>
                                </div>
                            </div>
                            @endif
                            @endforeach

                        </div>
                        <div class="mydictionary_main" id="forgetCards">
                            @foreach ($learnWords->reverse() as $newWord)
                            @php
                            $word = Word::find($newWord->id_word);
                            @endphp
                            @if ($word)
                            <div class="word_card" data-card="{{$word->id}}">
                                <div class="word_card_up">
                                    <div class="word_card_left">
                                        <h3 data-original="{{$word->original}}">{{$word->original}}</h3>
                                        <p data-translate="{{$word->translate}}" class="text2_reg">{{$word->translate}}</p>
                                    </div>
                                    <div class="word_card_actions">
                                        <button class="sound" onclick="speakWord('{{rawurlencode($word->original) }}')"><img src="{{asset('assets/img/icons/SpeakerSimpleHigh.svg')}}" alt="" class="icon_sound"></button>
                                        <button class="save" onclick="mydictionary('{{$word->id}}')">
                                            <svg class="save_svg @if ($word) @php $dictionary = Dictionary::where('id_word', $word->id)->where('id_user', $userId)->first(); @endphp @if($dictionary) save_svg_active @endif @endif" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                                                <path d="M16.55 23.8375L22.85 27.8375C23.6625 28.35 24.6625 27.5875 24.425 26.65L22.6 19.475C22.5506 19.2762 22.5585 19.0674 22.6226 18.8728C22.6868 18.6781 22.8046 18.5056 22.9625 18.375L28.6125 13.6625C29.35 13.05 28.975 11.8125 28.0125 11.75L20.6375 11.275C20.4363 11.2633 20.2428 11.1933 20.0808 11.0734C19.9187 10.9535 19.7951 10.789 19.725 10.6L16.975 3.67503C16.9022 3.47491 16.7696 3.30204 16.5952 3.17988C16.4207 3.05772 16.2129 2.99219 16 2.99219C15.787 2.99219 15.5793 3.05772 15.4048 3.17988C15.2304 3.30204 15.0978 3.47491 15.025 3.67503L12.275 10.6C12.2049 10.789 12.0813 10.9535 11.9192 11.0734C11.7572 11.1933 11.5637 11.2633 11.3625 11.275L3.98749 11.75C3.02499 11.8125 2.64999 13.05 3.38749 13.6625L9.0375 18.375C9.19541 18.5056 9.31323 18.6781 9.37736 18.8728C9.4415 19.0674 9.44934 19.2762 9.39999 19.475L7.71249 26.125C7.42499 27.25 8.62499 28.1625 9.58749 27.55L15.45 23.8375C15.6144 23.733 15.8052 23.6775 16 23.6775C16.1948 23.6775 16.3856 23.733 16.55 23.8375Z" stroke="#FF6131" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <div class="word_card_down">
                                    <button onclick="forgetWord('{{$word->id}}')" class="forget">
                                        <p class="text2">Забыто</p><img src="assets/img/icons/no.svg" alt="" class="learn_icon">
                                    </button>


                                </div>
                            </div>
                            @endif
                            @endforeach

                        </div>
                        <div class="mydictionary_main" id="learnedCards">

                            @foreach ($forgetWords->reverse() as $newWord)
                            @php
                            $word = Word::find($newWord->id_word);
                            @endphp
                            @if ($word)
                            <div class="word_card" data-card="{{$word->id}}">
                                <div class="word_card_up">
                                    <div class="word_card_left">
                                        <h3 data-original="{{$word->original}}">{{$word->original}}</h3>
                                        <p data-translate="{{$word->translate}}" class="text2_reg">{{$word->translate}}</p>
                                    </div>
                                    <div class="word_card_actions">
                                        <button class="sound" onclick="speakWord('{{rawurlencode($word->original) }}')"><img src="{{asset('assets/img/icons/SpeakerSimpleHigh.svg')}}" alt="" class="icon_sound"></button>
                                        <button class="save" onclick="mydictionary('{{$word->id}}')">
                                            <svg class="save_svg @if ($word) @php $dictionary = Dictionary::where('id_word', $word->id)->where('id_user', $userId)->first(); @endphp @if($dictionary) save_svg_active @endif @endif" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                                                <path d="M16.55 23.8375L22.85 27.8375C23.6625 28.35 24.6625 27.5875 24.425 26.65L22.6 19.475C22.5506 19.2762 22.5585 19.0674 22.6226 18.8728C22.6868 18.6781 22.8046 18.5056 22.9625 18.375L28.6125 13.6625C29.35 13.05 28.975 11.8125 28.0125 11.75L20.6375 11.275C20.4363 11.2633 20.2428 11.1933 20.0808 11.0734C19.9187 10.9535 19.7951 10.789 19.725 10.6L16.975 3.67503C16.9022 3.47491 16.7696 3.30204 16.5952 3.17988C16.4207 3.05772 16.2129 2.99219 16 2.99219C15.787 2.99219 15.5793 3.05772 15.4048 3.17988C15.2304 3.30204 15.0978 3.47491 15.025 3.67503L12.275 10.6C12.2049 10.789 12.0813 10.9535 11.9192 11.0734C11.7572 11.1933 11.5637 11.2633 11.3625 11.275L3.98749 11.75C3.02499 11.8125 2.64999 13.05 3.38749 13.6625L9.0375 18.375C9.19541 18.5056 9.31323 18.6781 9.37736 18.8728C9.4415 19.0674 9.44934 19.2762 9.39999 19.475L7.71249 26.125C7.42499 27.25 8.62499 28.1625 9.58749 27.55L15.45 23.8375C15.6144 23.733 15.8052 23.6775 16 23.6775C16.1948 23.6775 16.3856 23.733 16.55 23.8375Z" stroke="#FF6131" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <div class="word_card_down">
                                    <button onclick="learnWord('{{$word->id}}')" class="learn">
                                        <p class="text2">Выучить</p><img src="assets/img/icons/yes.svg" alt="" class="learn_icon">
                                    </button>
                                </div>
                            </div>
                            @endif
                            @endforeach


                        </div>



                        <script>
                            function speakWord(word) {
                                let voices = speechSynthesis.getVoices(); // Получаем список голосов
                                let frenchVoice = voices.find(voice => voice.name === "Google français"); // Находим французский голос (замените "French" на имя нужного голоса)

                                frenchVoice.localService = true;
                                frenchVoice.default = true;
                                console.log(voices);
                                if (frenchVoice) {
                                    let sound = new SpeechSynthesisUtterance(decodeURIComponent(word));
                                    sound.voice = frenchVoice; // Устанавливаем голос
                                    sound.lang = 'fr-FR';
                                    sound.rate = 0.9;
                                    sound.pitch = 0.9;
                                    speechSynthesis.speak(sound);
                                } else {
                                    console.error("Французский голос не найден");
                                }
                            }
                        </script>
                    </div>
                </div>
            </section>
        </div>

        <div class="tab-content" id="tab4">
            <section class="profile" id="myprofile">
                <div class="container">
                    <div class="mycourses_content">
                        <div class="up">
                            <h1>Профиль</h1>
                        </div>
                        <div class="myprofile_main">
                            <div class="myprofile_part">
                                <div class="myprofile_foto">
                                    <img src="{{asset("/storage/avas/".$user->foto)}}" alt="">
                                </div>
                                <div class="myprofile_info">
                                    <div class="profile_nav_up_main">
                                        <p class="text3">@if ($user->role_id === 3)
                                            Администратор
                                            @elseif ($user->role_id === 2)
                                            Пользователь
                                            @endif</p>
                                        <h2>{{$user->surname}} {{$user->name}}</h2>
                                    </div>
                                    <div class="myprofile_info_items">
                                        <div class="myprofile_info_item">
                                            <img src="{{asset('assets/img/icons/email_black.svg')}}" alt="">
                                            <p class="text2_reg">{{$user->email}}</p>
                                        </div>
                                        <div class="myprofile_info_item">
                                            <img src="{{asset('assets/img/icons/level.svg')}}" alt="">
                                            <p class="text2_reg">Beginner level</p>
                                        </div>
                                        <div class="myprofile_info_item">
                                            <img src="{{asset('assets/img/icons/CalendarBlank.svg')}}" alt="">
                                            <p class="text2_reg">{{$user->created_at}}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="profile_status">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                                        <path d="M26 11H6C5.44772 11 5 11.4477 5 12V26C5 26.5523 5.44772 27 6 27H26C26.5523 27 27 26.5523 27 26V12C27 11.4477 26.5523 11 26 11Z" stroke="#16CA48" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M11.5 11V6.5C11.5 5.30653 11.9741 4.16193 12.818 3.31802C13.6619 2.47411 14.8065 2 16 2C17.1935 2 18.3381 2.47411 19.182 3.31802C20.0259 4.16193 20.5 5.30653 20.5 6.5" stroke="#16CA48" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            </div>

                            <div class="myprofile_part myprofile_part_column ">
                                <h3>Личные данные</h3>
                                <form action="/edit_profile" method="post" class="form_profile" id="edit_profile" name="edit_profile" enctype="multipart/form-data">
                                    @csrf
                                    <div class="animate_input">
                                        <div class="form">
                                            <input type="text" name="surname" id="surname" placeholder="" value="@if(old('surname')){{old('surname')}}
                                            @else{{$user->surname}}@endif">
                                            <label for="surname">Фамилия</label>
                                        </div>
                                        @error('surname')
                                        <p class=" red error">{{$message}}</p>
                                        @enderror
                                    </div>



                                    <div class="animate_input">
                                        <div class="form">
                                            <input type="text" name="name" id="name" placeholder="" value="@if(old('name')){{old('name')}}
                                            @else{{$user->name}}@endif" />
                                            <label for="name">Имя</label>
                                        </div>
                                        @error('name')
                                        <p class="error red">{{$message}}</p>
                                        @enderror
                                    </div>


                                    <div class="animate_input">
                                        <div class="form">
                                            <select name="level" id="level">
                                                <option value="0" selected disabled>Уровень</option>
                                                <option value="1">Beginner A1</option>
                                                <option value="2">Beginner A2</option>
                                                <option value="3">Intermediate B1</option>
                                                <option value="4">Intermediate B2</option>
                                            </select>
                                            <!-- <input type="text" name="level" id="level" placeholder="" value="">  -->
                                        </div>
                                    </div>


                                    <div class="animate_input">
                                        <div class="form">
                                            <br>
                                            <input type="file" value="новое фото" name="foto" id="fileInput" accept=".jpg , .jpeg">
                                        </div>
                                    </div>

                                </form>
                                <button form="edit_profile" type="submit" class="button black_btn text2">Сохранить</button>
                            </div>



                            <div class="myprofile_part myprofile_part_column ">
                                <h3>Пароль</h3>
                                <form action="/edit_password" class="form_profile" method="post" id="edit_password">
                                    @csrf
                                    <div class="animate_input">
                                        <div class="form">
                                            <input type="password" name="old_password" id="old_password" placeholder=" " value="">
                                            <label for="old_password">Старый пароль</label>
                                            <i class="bi bi-eye-slash" id="toggleOldPassword"></i>
                                        </div>
                                        @error('old_password')
                                        <p class="error red">{{$message}}</p>
                                        @enderror
                                    </div>


                                    <div class="animate_input">
                                        <div class="form">
                                            <input type="password" name="password" id="password" placeholder="" value="">
                                            <label for="password">Новый пароль</label>
                                            <i class="bi bi-eye-slash" id="togglePassword"></i>
                                        </div>
                                        @error('password')
                                        <p class="error red">{{$message}}</p>
                                        @enderror
                                    </div>

                                    <div class="animate_input">
                                        <div class="form">
                                            <input type="password" name="password_confirmation" id="password_repeat" placeholder="" value="">
                                            <label for="password_repeat">Пароль повторно</label>
                                            <i class="bi bi-eye-slash" id="toggleRepeatPassword"></i>
                                        </div>
                                        @error('password_confirmation')
                                        <p class="error red">{{$message}}</p>
                                        @enderror
                                    </div>

                                </form>
                                <button form="edit_password" type="submit" class="button black_btn text2">Сохранить</button>
                            </div>


                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- обучение -->
    </div>





    <div class="word_modal" id="add_word_modal">
        <div class="container">
            <div class="reg_content">
                <div class="modal">
                    <a class="close_krest" id="close_word_modal"><img src="{{asset('assets/img/icons/X_black.svg')}}" alt=""></a>
                    <h2>Новое слово</h2>
                    <form method="post" action="/add_word" id="add_word_form" class="form_profile">
                        @csrf
                        <div class="animate_input">
                            <div class="form">
                                <input type="text" name="original" id="original" placeholder="" value="{{old('original')}}">
                                <label for="original">оригинал</label>
                            </div>
                            @error('original')
                            <p class=" red error">{{$message}}</p>
                            @enderror
                        </div>


                        <div class="animate_input">
                            <div class="form">
                                <input type="text" name="translate" id="translate" placeholder="" value="{{old('translate')}}">
                                <label for="translate">перевод</label>
                            </div>
                            @error('translate')
                            <p class="error red">{{$message}}</p>
                            @enderror
                        </div>
                    </form>
                    <button form="add_word_form" class="button text2 black_btn" id="add_word_btn_first" disabled>Добавить в словарь</button>
                </div>
            </div>
        </div>
    </div>

    <div class="word_modal" id="edit_word_modal">
        <div class="container">
            <div class="reg_content">
                <div class="modal">
                    <button class="close_krest" onclick="hideModal()"><img src="{{asset('assets/img/icons/X_black.svg')}}" alt=""></button>
                    <!-- <a class="close_krest" id=""><img src="{{asset('assets/img/icons/X_black.svg')}}" alt=""></a> -->
                    <h2>Редактировать слово</h2>
                    <div class="edit_word_place">
                        <h3 id="original_place">

                        </h3>
                        <p class="text2_reg" id="translate_place">
                        </p>
                    </div>
                    <form method="post" id="edit_word_form" class="form_profile">
                        @csrf
                        <div class="animate_input">
                            <div class="form">
                                <input type="text" name="original" id="original" placeholder="" value="{{old('original')}}">
                                <label for="original">оригинал</label>
                            </div>
                            @error('original')
                            <p class=" red error">{{$message}}</p>
                            @enderror
                        </div>


                        <div class="animate_input">
                            <div class="form">
                                <input type="text" name="translate" id="translate" placeholder="" value="{{old('translate')}}">
                                <label for="translate">перевод</label>
                            </div>
                            @error('translate')
                            <p class="error red">{{$message}}</p>
                            @enderror
                        </div>
                    </form>

                    <button form="edit_word_form" class="button text2 black_btn" id="edit_word_btn" disabled>Сохранить</button>


                </div>
            </div>
        </div>
    </div>


    <div class="word_modal" id="delete_word_modal">
        <div class="container">
            <div class="reg_content">
                <div class="modal">
                    <a class="close_krest" onclick="hideModal()" id="close_word_modal"><img src="{{asset('assets/img/icons/X_black.svg')}}" alt=""></a>
                    <h2>Удалить данное слово?</h2>
                    <div class="edit_word_place">
                        <h3 id="original_place">

                        </h3>
                        <p class="text2_reg" id="translate_place">
                        </p>
                    </div>
                    <form method="post" id="delete_word_form" class="form_profile">
                        @csrf
                    </form>
                    <div class="form_actions">
                        <button form="delete_word_form" class="button text2 black_btn word_delete" id="delete_word_form">ДА, удалить</button>
                        <br>
                        <br>
                        <button onclick="hideModal()" class="button text2 black_btn">Нет, отмена</button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="word_modal" id="delete_lesson_modal">
        <div class="container">
            <div class="reg_content">
                <div class="modal">
                    <a class="close_krest" onclick="hideModal()" id="close_word_modal"><img src="{{asset('assets/img/icons/X_black.svg')}}" alt=""></a>
                    <h2>Удалить урок?</h2>
                    <div class="edit_word_place">
                        <p class="text2_reg" id="translate_place">
                        </p>
                    </div>
                    <form method="post" id="delete_lesson_form" class="form_profile">
                        @csrf
                    </form>
                    <div class="form_actions">
                        <button form="delete_lesson_form" class="button text2 black_btn word_delete" id="delete_lesson_form">ДА, удалить</button>
                        <br>
                        <br>
                        <button onclick="hideModal()" class="button text2 black_btn">Нет, отмена</button>
                    </div>

                </div>
            </div>
        </div>
    </div>



    @include('components.footer')


</body>