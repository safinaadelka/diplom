<?php

use App\Models\Kurs;
use App\Models\Lesson;
use App\Models\Study; ?>

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
    <link rel="stylesheet" href="{{ asset('assets/css/kurs.css') }}">
    <link rel="shortcut icon" href="{{asset('assets/img/favicon.svg')}}" type="image/x-icon">


    <style>
        @import url('https://fonts.googleapis.com/css2?family=Onest:wght@100..900&display=swap');
    </style>


    <script src="{{asset('assets/js/tabs.js')}}" defer></script>
    <script src="{{asset('assets/js/scroll.js')}}" defer></script>

    <script src="{{asset('assets/js/header.js')}}" defer></script>
    <title>Начальный курс</title>







</head>

<body>
    @include('components.header')
    @php
    $id = $kurs->id;

    $user = Auth::user();
    @endphp
    <div class="kurs">
        <div class="container">
            <div class="kurs_content">
                <div class="kurs_main">
                    <div class="kurs_main_up">
                        <!-- <a href="#" class="text4 status"># с_полного_нуля</a> -->
                        <h1>{{$kurs->name}}</h1>
                    </div>
                    <ul class="kurs_card_info">
                        <p class="text2_reg">{{$kurs->descript}}</p>
                    </ul>
                    <div class="kurs_statistics">
                        <div class="kurs_statistic">
                            <img src="{{asset('assets/img/icons/ChatTeardropDots_white.svg')}}" alt="" class="kurs_statistic_icon">
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
                            <img src="{{asset('assets/img/icons/Exam_white.svg')}}" alt="" class="kurs_statistic_icon">
                            <div class="kurs_statistic_text">
                                <p class="text1">3</p>
                                <p class="text4">теста</p>
                            </div>
                        </div>

                        <div class="kurs_statistic">
                            <img src="{{asset('assets/img/icons/GraduationCap_white.svg')}}" alt="" class="kurs_statistic_icon">
                            <div class="kurs_statistic_text">
                                <p class="text1">100+</p>
                                <p class="text4">слов</p>
                            </div>

                        </div>
                    </div>
                    <div class="kurs_card_about">

                        <!-- если Пользователь авторизован -->
                        @if ($user)
                        @php
                        
                        $studies = Study::where('modul', $kurs->id)->where('id_user', $user->id)->get();
                        $lessons = json_decode(json_decode(($kurs->lessons)));

                        $done_studies = Study::where('modul', $kurs->id)->where('id_user', $user->id)->latest('updated_at')->first();

                        @endphp


                        <!-- если Пользователь УЖЕ начал курс -->
                        @if ($studies->count() >= 1)
                        <a href="/modul/{{$kurs->id}}/lesson/{{$done_studies->id_lesson}}" class="button text2 green_btn" id="go_study">
                            <p>Продолжить</p>
                            <img src="{{asset('assets/img/icons/Play.svg')}}" alt="" class="white_arrow">
                        </a>

                        <form action="/delete_study/{{$kurs->id}}" method="post" id="delete_study_form">
                            @csrf
                            <button type="submit" form="delete_study_form" id="delete_study" class="button text2 red_btn">
                                <p>Отписаться</p> <img src="{{asset('assets/img/icons/x_white.svg')}}" alt="" class="white_arrow">
                            </button>
                        </form>


                        <!-- еще не записан на курс -->
                        @elseif ($studies->count() == 0)

                        <form action="/create_study/{{$kurs->id}}"  method="post" >
                        @csrf
                            <button type="submit" href="/modul/{{$kurs->id}}/lesson/{{$lessons[0]}}" class="button text2 orange_btn">Начать обучение
                                <img src="{{asset('assets/img/arrow_white.svg')}}" alt="" class="white_arrow"></button>
                        </form>

                      
                        @endif



                        <!-- если Пользователь гость -->
                        @elseif (!$user)
                        <a href="/login" class="button text2 orange_btn">Начать обучение
                            <img src="{{asset('assets/img/arrow_white.svg')}}" alt="" class="white_arrow"></a>
                        @endif

                    </div>

                </div>
                <img src="{{asset('assets/img/kurs_image.svg')}}" alt="" class="kurs_image">
            </div>
        </div>
    </div>


    <div class="program">
        <div class="container">
            <div class="program_content">
                <h1>Программа курса</h1>
                <div class="program_cards">

                    @php
                    $LessonNumber = 1;
                    if($kurs->lessons){
                    $lessons = json_decode(json_decode(($kurs->lessons)));
                    $kurs_lessons = Lesson::whereIn('id', $lessons)->get()->sortBy(function ($item) use ($lessons) {
                    return array_search($item->id, $lessons);
                    });

                    $lessonsCount = count($lessons);
                    }

                    @endphp
                    @foreach ($kurs_lessons as $lesson)
                    <a href="/modul/{{$kurs->id}}/lesson/{{$lesson->id}}" class="program_card">
                        <div class="program_card_main">
                            <div class="program_card_number">
                                <p class="text2">
                                    {{ $LessonNumber }}
                                </p>
                            </div>
                            <p class="text2">
                                {{$lesson->name}}
                            </p>
                        </div>
                        <button href="/modul/{{$kurs->id}}/lesson/{{$lesson->id}}" class="black_arrow_btn"><img src="{{asset('assets/img/arrow_white.svg')}}" alt="" class="black_arrow"></button>
                    </a>
                    @php
                    $LessonNumber ++; ;
                    @endphp
                    @endforeach


                </div>
            </div>
        </div>
    </div>



    <div class="review" id="review">
        <div class="container">
            <div class="review_content">
                <div class="review_up_mobile">
                    <img src="{{asset('assets/img/icons/kav.svg')}}" alt="" class="quote_icon" id="quote_icon_1_mobile">
                    <img src="{{asset('assets/img/icons/kav.svg')}}" alt="" class="quote_icon" id="quote_icon_2_mobile">
                </div>
                <div class="review_up">
                    <img src="{{asset('assets/img/icons/kav.svg')}}" alt="" class="quote_icon" id="quote_icon_1">
                    <h1 class="citate ">Простой и понятный интерфейс</h1>
                    <h1 class="citate">Отличное решение для тех, кто учиться самостоятельно</h1>
                    <h1 class="citate citate_active">Лучшая платформа для изучения французского языка</h1>
                    <h1 class="citate">Много полезных материалов для самостоятельного обучения</h1>
                    <h1 class="citate">Материал доступно и понятно изложен</h1>
                    <img src="{{asset('assets/img/icons/kav.svg')}}" alt="" class="quote_icon" id="quote_icon_2">
                </div>
                <div class="review_middle">
                    <p class="text2_reg review_text ">
                        Сайт имеет очень удобный интерфейс, который делает процесс изучения французского языка приятным и легким. Мне понравилась структура уроков и возможность повторять материалы в любое время.
                    </p>
                    <p class="text2_reg review_text">
                        Я использовал этот сайт для изучения французского языка и остался очень доволен. Здесь представлены разнообразные уроки, задания и тесты, которые помогли мне улучшить свои навыки. Особенно полезными были разговорные практики, которые помогли мне увереннее говорить на французском.
                    </p>
                    <p class="text2_reg review_text review_text_active">
                        "Я просто в восторге от этого сайта для изучения французского языка! Благодаря его удобному
                        интерфейсу и качественным урокам, я смог значительно улучшить свои навыки в изучении
                        французского. Мне особенно понравилась возможность общаться с носителями языка через онлайн-чаты
                        и участвовать в интересных заданиях. Спасибо за такой замечательный ресурс, который сделал
                        процесс изучения французского языка увлекательным и эффективным!"
                    </p>
                    <p class="text2_reg review_text">
                        На сайте представлено множество полезных материалов, таких как статьи, видеоуроки, словари и тесты, которые помогают расширить словарный запас и улучшить грамматику. Я часто пользуюсь этими ресурсами для самостоятельного обучения и всегда нахожу что-то новое и интересное.
                    </p>
                    <p class="text2_reg review_text">
                        Уроки написаны понятно, без лишней воды, все по фактам. Радует, что есть возможность формировать свой личный словарь, затем повторять их в течении дня
                    </p>



                </div>
                <div class="review_down">
                    <div class="reviewer">
                        <p class="text1 reviewer_name ">Прекрасный юзер</p>
                        <a href="" class="text4 review_link ">Начальный модуль</a>
                        <p class="text1 reviewer_name">Александр дю Монреаль</p>
                        <a href="" class="text4 review_link ">Н3 модуль</a>
                        <p class="text1 reviewer_name reviewer_name_active">Аделя Сафина</p>
                        <a href="" class="text4 review_link review_link_active">A1 модуль</a>
                        <p class="text1 reviewer_name">Эльмирочка Вахитова</p>
                        <a href="" class="text4 review_link ">B1 модуль</a>
                        <p class="text1 reviewer_name">Алия Сафина</p>
                        <a href="" class="text4 review_link ">A2 модуль</a>
                    </div>
                    <div class="review_avas_container">
                        <div class="reviewer_avas">
                            <button class="reviewer_btn ">
                                <img src="{{asset('assets/img/reviewer_foto_1.jpg')}}" alt="" class="reviewer_foto">
                            </button>
                            <button class="reviewer_btn">
                                <img src="{{asset('assets/img/reviewer_foto_2.jpg')}}" alt="" class="reviewer_foto">
                            </button>
                            <button class="reviewer_btn reviewer_btn_active">
                                <img src="{{asset('assets/img/reviewer_foto_3.jpg')}}" alt="" class="reviewer_foto">
                            </button>
                            <button class="reviewer_btn">
                                <img src="{{ asset('assets/img/reviewer_foto_4.jpg') }}" alt="" class="reviewer_foto">
                            </button>
                            <button class="reviewer_btn">
                                <img src="{{asset('assets/img/reviewer_foto_5.jpg')}}" alt="" class="reviewer_foto">
                            </button>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>


    <section class="test" id="test">
        <div class="container">
            <div class="test_content">
                <div class="test_left">
                    <h1>
                        Не знаешь свой уровень языка?
                    </h1>
                    <p class="text2_reg">
                        Ответь на 10 вопросов и получи свой результат
                    </p>
                    <div class="btn_arrow">
                        <a href="" class="button text2 black_btn">Пройти тест</a>
                        <div class="black_decor_arrow_test_caveat">
                            <img src="{{asset('assets/img/arrow_decor_black.svg')}}" alt="" class="black_decor_arrow">
                            <p class="caveat test_caveat">Займет 5 минут </p>
                        </div>
                    </div>
                </div>
                <div class="test_right">
                    <img src="{{asset('assets/img/test_telefon.svg')}}" alt="" class="test_phone">
                </div>
            </div>
        </div>
    </section>


    @include('components.footer')



</body>

</html>