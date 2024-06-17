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

    <title>EasyFrench</title>

    <meta property="og:site_name" content="EasyFrench">
    <meta property="og:type" content="website">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:title" content="EasyFrench - французский по онлайн-урокам ">
    <meta property="og:description" content="Сайт для самостоятельного изучения французского языка">
    <meta property="og:image" content="http://x223.pautinaweb.ru/try_diplom/assets/img/og_image.jpg">
    <meta property="og:url" content="http://x223.pautinaweb.ru/try_diplom/">


    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css'>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="shortcut icon" href="{{asset('assets/img/favicon.svg')}}" type="image/x-icon">


    <style>
        @import url('https://fonts.googleapis.com/css2?family=Onest:wght@100..900&display=swap');
    </style>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.min.js'></script>
    <script src="./script.js"></script>

    <script src="{{asset('assets/js/main.js')}}" defer></script>
    <script src="{{asset('assets/js/accordion.js')}}" defer></script>
    <script src="{{asset('assets/js/slider.js')}}" defer></script>
    <script src="{{asset('assets/js/tabs.js')}}" defer></script>
    <script src="{{asset('assets/js/scroll.js')}}" defer></script>
    <script src="{{asset('assets/js/translation.js')}}" defer></script>
    <script src="{{asset('assets/js/header.js')}}" defer></script>
    <script src="{{asset('assets/js/playSound.js')}}" defer></script>
</head>

<body>


    @include('components.header')

    <section class="banner">
        <div class="container">
            <div class="b_content">
                <div class="banner_upper">
                    <p class="b_text_1">Изучай бесплатно</p>
                    <p class="b_text_2">Французский
                        язык</p>
                    <p class="b_text_3">с онлайн-уроками</p>
                </div>

                <div class="banner_down">
                    <div class="banner_down_left">
                        <a href="#test" class="button text2 white_btn">Пройти тест</a>
                        <div class="white_decor_arrow_banner_caveat">
                            <img src="{{asset('assets/img/arrow_decor_white.svg')}}" alt="" class="white_decor_arrow">
                            <p class="caveat banner_caveat">Для тех, кто не знает свой уровень языка </p>
                        </div>

                    </div>
                    <div class="banner_down_right">
                        <a href="/#kurses" class="button text2 orange_btn">Начать обучение <img src="{{asset('assets/img/arrow_white.svg')}}" alt="" class="white_arrow"></a>
                    </div>
                </div>
                <img src="{{asset('assets/img/banner_foto.svg')}}" alt="" class="banner_img">
            </div>
        </div>
        <div class="banner_img_div">
            <img src="{{asset('assets/img/banner_foto.svg')}}" alt="" class="banner_img_mobile">
        </div>
    </section>

    <section class="benefits" id="benefits">
        <div class="container">
            <div class="benefits_content">
                <h1>Об обучении</h1>
                <div class="benefit_cards">
                    <div class="benefit_card">
                        <div class="benefit_card_main">
                            <h2 class="benefit_card_name">Удобный <br>
                                онлайн формат</h2>
                            <p class="text2_reg benefit_card_text">
                                Изучай язык из любой точки мира в свободное время
                            </p>
                        </div>
                        <div class="benefit_card_image">
                            <img src="{{asset('assets/img/benefit_education.svg')}}" alt="" class="benefit_education">
                        </div>
                    </div>
                    <div class="benefit_card">
                        <div class="benefit_card_main">
                            <h2 class="benefit_card_name">Подробное объяснение темы</h2>
                            <p class="text2_reg benefit_card_text">
                                Вся информация разложена по полочкам и состоит из основных модулей
                            </p>
                        </div>
                        <div class="benefit_card_image">
                            <div class="lesson_components">
                                <div class="lesson_component_right">
                                    <a href="#moduls" class="text2 small_button yellow_btn">Лексика</a>
                                </div>
                                <div class="lesson_component_left">
                                    <a href="#moduls" class="text2 small_button coral_btn">Грамматика</a>
                                </div>
                                <div class="lesson_component_right">
                                    <a href="#moduls" class="text2 small_button sky_btn">Аудирование</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="benefit_card_column">
                        <div class="benefit_card_small">
                            <div class="benefit_card_main">
                                <h2 class="benefit_card_name">0 руб. за обучение</h2>
                                <p class="text2_reg benefit_card_text">
                                    Абсолютно бесплатно
                                </p>
                            </div>
                            <div class="benefit_card_image">
                                <img src="{{asset('assets/img/free_lesson.svg')}}" alt="" class="free_lesson">
                            </div>
                        </div>

                        <div class="benefit_card_small">
                            <div class="benefit_card_main">
                                <h2 class="benefit_card_name">Регулярные тесты
                                    в каждом модуле</h2>
                            </div>
                            <div class="benefit_card_image">
                                <img src="{{asset('assets/img/regular_test.svg')}}" alt="" class="regular_test">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="france" id="france">
        <div class="container">
            <main>
                <div>
                    <h1>Французский для любых твоих целей</h1>
                    <div class="btn_arrow" id="france_btn">
                        <a href="/#kurses" class="button text2 black_btn">Вперед к цели</a>
                        <div class="black_decor_arrow_test_caveat">
                            <img src="{{asset('assets/img/arrow_decor_black.svg')}}" alt="" class="black_decor_arrow">
                            <p class="caveat test_caveat">Сделай первый шаг на пути к своей цели </p>
                        </div>
                    </div>
                </div>
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide swiper-slide--one">
                            <div>
                                <h3>Путешействуй</h3>

                            </div>
                        </div>
                        <div class="swiper-slide swiper-slide--two">
                            <div>
                                <h3>Обучайся</h3>

                            </div>
                        </div>

                        <div class="swiper-slide swiper-slide--three">

                            <div>
                                <h3>Заводи знакомства</h3>

                            </div>
                        </div>

                        <div class="swiper-slide swiper-slide--four">

                            <div>
                                <h3>Пробуй новое</h3>

                            </div>
                        </div>

                        <div class="swiper-slide swiper-slide--five">

                            <div>
                                <h3>Строй карьеру</h3>

                            </div>
                        </div>
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>
                </div>
                <div id="mobile_france_btn">
                    <div class="btn_arrow">
                        <a href="/#kurses" class="button text2 black_btn">Вперед к цели</a>
                        <div class="black_decor_arrow_test_caveat">
                            <img src="{{asset('assets/img/arrow_decor_black.svg')}}" alt="" class="black_decor_arrow">
                            <p class="caveat test_caveat">Сделай первый шаг на пути к своей цели </p>
                        </div>
                    </div>
                </div>


            </main>
        </div>
    </section>


    <section class="kurses" id="kurses">
        <div class="kurses container">
            <div class="kurses_content">
                <h1>Начни с подходящего курса</h1>
                <div class="kurs_cards">
                    @php
                    $kurses = Kurs::where('status', 1)->get();
                    @endphp

                    @foreach ($kurses as $kurs)
                    <div class="kurs_card" id="kurs_card_1">
                        <!-- @if ($kurs == reset($kurses))
                        <a href="#" class="text4 status" id="kurs_status"># с_полного_нуля</a>
                        @endif -->

                        <h2 class="kurs_card_name">{{$kurs->name}}</h2>
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
                            <a href="/modul/{{$kurs->id}}" class="button text2 orange_btn kurs_btn">Подробнее о курсе<img src="{{asset('assets/img/arrow_white.svg')}}" alt="" class="white_arrow"></a>
                        </div>

                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>


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
                        <a href="/test" class="button text2 black_btn">Пройти тест</a>
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


    <section class="us" id="us">
        <div class="container">
            <div class="us_content">
                <div class="us_left">
                    <img src="{{asset('assets/img/header_logo.svg')}}" alt="" class="us_logo">
                    <div class="us_info">
                        <p class="text1">Лучшая платформа для тех, кто хочет: </p>
                        <ul class="us_need">
                            <li class="text3">Говорить на французском языке свободно и без стеснения</li>
                            <li class="text3">Систематизировать процесс обучения</li>
                            <li class="text3">Преодолеть языковой барьер в общении</li>
                            <li class="text3">Улучшить навыки чтения, аудирования, перевода</li>
                            <li class="text3">Пополнить свой словарный запас</li>
                        </ul>
                    </div>
                </div>
                <div class="us_right">
                    <div class="diagram">
                        <div class="pie animate" style="--p:95;--c:#16CA48;;--b:22px">
                            <div class="users_statistic">
                                <h1>95%</h1>
                                <p class="text4">
                                    студентов успешно заканчивают обучение
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="us_review" id="us_review_1">
                        <h2>№ 1</h2>
                        <p class="text4">платформа для изучения французского</p>
                    </div>

                    <div class="us_review" id="us_review_2">
                        <h2>4.96</h2>
                        <p class="text4">средний балл по отзывам обучающихся</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="principe">
        <div class="container">
            <div class="principe_content">
                <div class="princip_foto">
                    <img src="{{asset('assets/img/adele_foto.png')}}" alt="" class="adele_foto">
                    <div class="adele_info">
                        <p class="text1">Аделя Сафина </p>
                        <p class="text3">основатель онлайн-школы EasyFrench</p>
                    </div>
                </div>
                <div class="principe_main">
                    <h1>Качество. <br>
                        Доступность. <br>
                        Гибкость. </h1>
                    <div>
                        <p class="text3">3 основных принципа, которых мы придерживаемся в основе обучения.</p>
                        <br>
                        <p class="text3">Теперь каждый, кто мечтает заговорить на французском, может сделать это в любое
                            время и место, используя только интернет.</p>
                    </div>

                </div>
                <div class="quote">
                    <img src="{{asset('assets/img/icons/kav.svg')}}" alt="" class="quote_icon">
                </div>
            </div>
        </div>
    </section>



    <div class="moduls" id="moduls">
        <div class="container moduls_container">
            <div class="moduls_content">
                <h1>Каждый урок состоит из модулей</h1>
                <div class="modul_cards">
                    <div class="modul_card">
                        <div class="modul_card_left">
                            <h2>Подробно изучай всю грамматику</h2>
                            <p class="text3">Познакомиться с важными аспектами и тонкостями языка, необходимыми для
                                уверенного владения речью. </p>
                        </div>
                        <div class="grammar_card">
                            <div class="grammar_card_top">
                                <p class="text2">Грамматика</p>
                            </div>
                            <div class="grammar_card_down">
                                <p class="text3">Перед существительным женского рода добавляем артикль “Une”</p>
                                <p class="text3">Une + tour = une tour
                                    <br>
                                    Une + dame = une dame <br>
                                    Une + étudiante = une étudiante
                                </p>
                            </div>
                        </div>
                    </div>
                    <hr class="line">
                    <div class="modul_card" id="modul_card_reverse">
                        <div class="modul_card_left">
                            <h2>Разбирай реальные
                                примеры предложений</h2>
                            <p class="text3">Примеры помогут понять, какие слова и выражения используются в различных
                                ситуациях и контекстах.</p>
                        </div>
                        <div class="example_card">
                            <div class="example_card_top">
                                <p class="text2">Примеры</p>
                            </div>
                            <div class="example_card_down">
                                <p class="text3">Перед существительным женского рода добавляем артикль “Une”</p>
                                <p class="text3">Une + tour = une tour
                                    <br>
                                    Une + dame = une dame <br>
                                    Une + étudiante = une étudiante
                                </p>
                            </div>
                        </div>
                    </div>
                    <hr class="line">
                    <div class="modul_card" id="modul_card_word">
                        <div class="modul_card_left" id="modul_card_left_word">
                            <h2>Пополняй словарный запас
                                + улучши произношение</h2>
                            <p class="text3">Прокачивай навыки аудирования, создавай личный словарь, учи новые слова.
                            </p>
                        </div>
                        <div class="word_card_container">
                            <div class="word_cards">
                                @php
                                $words = Word::latest()->take(6)->get();
                                @endphp
                                @foreach ($words as $word)
                                <div class="word_card">
                                    <div class="word_card_up">
                                        <div class="word_card_left">
                                            <h3>{{$word->original}}</h3>
                                            <p class="text2_reg">{{$word->translate}}</p>
                                        </div>
                                        <div class="word_card_actions">
                                            <button class="sound" onclick="speakWord('{{rawurlencode($word->original)}}')"><img src="{{asset('assets/img/icons/SpeakerSimpleHigh.svg')}}" alt="" class="icon_sound"></button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach



                            </div>
                        </div>

                    </div>
                </div>
                <a href="/#kurses" class="button text2 black_btn">Начать обучение <img src="{{asset('assets/img/arrow_white.svg')}}" alt="" class="white_arrow"></a>
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
    <div class="blog" id="blog">
        <div class="container">
            <div class="blog_content">
                <h1>Блог, посвященный изучению французского языка

                </h1>
                <div class="slides_plus_buttons">
                    <div class="slides_container">
                        <div class="news_card" id="news_card">
                            <div class="new">
                                <div class="new_up">
                                    <img src="{{asset('assets/img/new_foto.jpg')}}" alt="" class="new_foto">
                                </div>
                                <div class="new_down">
                                    <div class="new_down_main">
                                        <p class="text4">
                                            25.03.2024
                                        </p>
                                        <p class="text2">
                                            Определенный и неопредленный артикль. Случаи употребления в разговорной
                                            речи
                                        </p>
                                    </div>
                                    <a href="" class="new_link">
                                        <p class="text3">Читать полностью</p><img src="{{asset('assets/img/arrow_orange.svg')}}" alt="" class="orange_arr">
                                    </a>
                                </div>
                            </div>

                            <div class="new">
                                <div class="new_up">
                                    <img src="assets/img/new_foto2.jpg" alt="" class="new_foto">
                                </div>
                                <div class="new_down">
                                    <div class="new_down_main">
                                        <p class="text4">
                                            16.06.2024
                                        </p>
                                        <p class="text2">
                                            Топ-10 мест, которые нужно посетить во Франции
                                        </p>
                                    </div>
                                    <a href="" class="new_link">
                                        <p class="text3">Читать полностью</p><img src="{{asset('assets/img/arrow_orange.svg')}}" alt="" class="orange_arr">
                                    </a>
                                </div>
                            </div>

                            <div class="new">
                                <div class="new_up">
                                    <img src="assets/img/new_foto3.jpg" alt="" class="new_foto">
                                </div>
                                <div class="new_down">
                                    <div class="new_down_main">
                                        <p class="text4">
                                            25.04.2024
                                        </p>
                                        <p class="text2">
                                            Как сказать «спасибо», «пожалуйста» в ответ на французском?
                                        </p>
                                    </div>
                                    <a href="" class="new_link">
                                        <p class="text3">Читать полностью</p><img src="{{asset('assets/img/arrow_orange.svg')}}" alt="" class="orange_arr">
                                    </a>
                                </div>
                            </div>
                            <div class="new">
                                <div class="new_up">
                                    <img src="assets/img/new_foto4.jpg" alt="" class="new_foto">
                                </div>
                                <div class="new_down">
                                    <div class="new_down_main">
                                        <p class="text4">
                                            25.03.2024
                                        </p>
                                        <p class="text2">
                                            История французской моды: временной разбор
                                        </p>
                                    </div>
                                    <a href="" class="new_link">
                                        <p class="text3">Читать полностью</p><img src="{{asset('assets/img/arrow_orange.svg')}}" alt="" class="orange_arr">
                                    </a>
                                </div>
                            </div>
                            <div class="new">
                                <div class="new_up">
                                    <img src="assets/img/new_foto.jpg" alt="" class="new_foto">
                                </div>
                                <div class="new_down">
                                    <div class="new_down_main">
                                        <p class="text4">
                                            25.03.2024
                                        </p>
                                        <p class="text2">
                                            5 Определенный и неопредленный артикль. Случаи употребления
                                        </p>
                                    </div>
                                    <a href="" class="new_link">
                                        <p class="text3">Читать полностью</p><img src="{{asset('assets/img/arrow_orange.svg')}}" alt="" class="orange_arr">
                                    </a>
                                </div>
                            </div>
                            <div class="new">
                                <div class="new_up">
                                    <img src="assets/img/new_foto2.jpg" alt="" class="new_foto">
                                </div>
                                <div class="new_down">
                                    <div class="new_down_main">
                                        <p class="text4">
                                            16.06.2024
                                        </p>
                                        <p class="text2">
                                            Топ-10 мест, которые нужно посетить во Франции
                                        </p>
                                    </div>
                                    <a href="" class="new_link">
                                        <p class="text3">Читать полностью</p><img src="{{asset('assets/img/arrow_orange.svg')}}" alt="" class="orange_arr">
                                    </a>
                                </div>
                            </div>

                        </div>

                    </div>

                    <button class="prev" id="prev"><img src="{{asset('assets/img/arrow_black.svg')}}" alt="" class="prev_black_arrow"></button>
                    <button class="next" id="next"><img src="{{asset('assets/img/arrow_black.svg')}}" alt="" class="next_black_arrow"></button>
                </div>

                <a id="all_news" href="" class="button text2 black_btn">Все статьи</a>

            </div>
        </div>
    </div>


    <div id="faq" class="faq">
        <div class="container">
            <div class="faq_content">
                <h1>Ответы на часто задаваемые вопросы</h1>
                <div class="accordion">
                    <div class="accordion_line">
                        <div class="question">
                            <p class="text1">
                                Как зарегистрироваться на бесплатные онлайн-уроки французского языка?
                            </p>
                            <button class="answer_button">
                                <img src="{{asset('assets/img/arrow_black.svg')}}" alt="" class="black_arrow">
                            </button>
                        </div>
                        <div class="answer">
                            <p class="text3">Для регистрации на бесплатные онлайн-уроки французского языка просто
                                заполните форму на нашем сайте
                                и получите доступ к урокам</p>
                        </div>
                    </div>
                    <div class="accordion_line">
                        <div class="question">
                            <p class="text1">
                                Как часто нужно практиковать французский язык?
                            </p>
                            <button class="answer_button">
                                <img src="{{asset('assets/img/arrow_black.svg')}}" alt="" class="black_arrow">
                            </button>
                        </div>
                        <div class="answer">
                            <p class="text3">Для эффективного изучения языка рекомендуется практиковать французский ежедневно хотя бы в течение 30-60 минут.</p>
                        </div>
                    </div>
                    <div class="accordion_line">
                        <div class="question">
                            <p class="text1">
                                Какие методики изучения французского языка эффективны?
                            </p>
                            <button class="answer_button">
                                <img src="{{asset('assets/img/arrow_black.svg')}}" alt="" class="black_arrow">
                            </button>
                        </div>
                        <div class="answer">
                            <p class="text3">Эффективными методиками изучения французского языка являются общение с носителями, изучение слов в контексте, повторение и активное использование языка.</p>
                        </div>
                    </div>
                    <div class="accordion_line">
                        <div class="question">
                            <p class="text1">
                                Как оценить свой уровень владения французским языком?
                            </p>
                            <button class="answer_button">
                                <img src="{{asset('assets/img/arrow_black.svg')}}" alt="" class="black_arrow">
                            </button>
                        </div>
                        <div class="answer">
                            <p class="text3"> Для оценки своего уровня владения французским языком можно использовать тесты онлайн, общение с носителями и участие в мероприятиях на французском языке.</p>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>


    @include('components.footer')










</body>

</html>