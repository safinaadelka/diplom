<?php

use App\Models\Kurs;
use App\Models\Lesson;
use App\Models\User;
use App\Models\Word;
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



    <script src="{{asset('assets/js/main.js')}}" defer></script>

    <script src="{{asset('assets/js/scroll.js')}}" defer></script>
    <script src="{{asset('assets/js/translation.js')}}" defer></script>
    <script src="{{asset('assets/js/header.js')}}" defer></script>
    <script src="{{asset('assets/js/test.js')}}" defer></script>
</head>

<body>


    @include('components.header')

    <br><br><br> <br> <br><br><br> <br>



    <div class="container">
        <div class="do_test">
            <div class="test-container" style="display: none;">
                <div>
                    <div class="question-number text3">Вопрос <span id="current-question">1</span> из 10</div><br>
                    <h2 class="question-text" id="question-text"></h2>
                </div>

                <div class="answers">
                    <button class="answer-button text2_reg" data-answer-id="1" id="answer-1"><span class="checkbox"></span>
                        <p></p>
                    </button>

                    <button class="answer-button text2_reg" data-answer-id="2" id="answer-2"><span class="checkbox"></span>
                        <p></p>
                    </button>

                    <button class="answer-button text2_reg" data-answer-id="3" id="answer-3"><span class="checkbox"></span>
                        <p></p>
                    </button>

                    <button class="answer-button text2_reg" data-answer-id="4" id="answer-4"><span class="checkbox"></span>
                        <p></p>
                    </button>
                </div>

                <div class="test_controls">
                    <button class="text3 small_button" id="prev-question" disabled>Предыдущий вопрос</button>
                    <button class="text3 small_button" id="next-question" disabled>Следующий вопрос</button>
                    <button class="text3 small_button " id="results-button" disabled style="display:none">Узнать результаты</button>
                </div>


            </div>

            <div class="welcome">

                <h1>Тест на определение уровня французского языка</h1>
                <p class="text2_reg">Ответь на 10 вопросов и узнай свой результат</p>
                <button id="start-test-button" class="button text2 orange_btn">Начать тест <img src="{{asset('assets/img/arrow_white.svg')}}" alt="" class="white_arrow"></button>

            </div>

            <div class="results" id="results" style="display: none;">
                <div>
                    <p class="text3">Ваш уровень владения языка</p>
                    <h1 id="user_level"></h1>
                </div>
                <div>
                    <p class="text3">Рекомендуем пройти курс:</p>
                    <a href="" class="text1" id="level_kurs"></a>
                </div>
                <div class="test_actions">
                    <a href="/#kurses" class="button text2 orange_btn">Перейти к курсам <img src="{{asset('assets/img/arrow_white.svg')}}" alt="" class="white_arrow"></a>
                    <button id="start-test-button-again" class="small_button text2 black_btn">Повторить <img src="{{asset('assets/img/icons/ArrowClockwise.svg')}}" alt="" class="white_arrow"></button>
                </div>
                <div>
                    <h3>Результаты теста</h3>
                    <br>
                    <ul id="results-list"></ul>
                </div>







            </div>
        </div>
    </div>


    <br><br><br> <br> <br><br><br> <br>

    @include('components.footer')


    <style>
        body {
            background: #2B59C9
        }

        .test_actions {
            display: flex;
            gap: 20px;
            flex-direction: column;
        }

        .correct-answer {
            /* Стилизация для правильного ответа (зеленый цвет) */
            color: green;
        }

        .wrong-answer {
            /* Стилизация для неправильного ответа (красный цвет) */
            color: red;
        }

        h1 {
            text-align: center;

        }

        .do_test {
            padding: 80px 40px;
            background-color: white;
            border-radius: 20px;
            border: 1px solid #DADADA;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .welcome {
            display: flex;
            width: 100%;
            align-items: center;
            flex-direction: column;

            gap: 40px;
        }

        .welcome .text2_reg {
            text-align: center;
        }


        .small_button:disabled:hover {
            transition: none;


            transform: none;


        }

        .small_button:disabled {
            background-color: #DADADA;
        }


        .test_controls {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        #results-button {
            background: var(--green, #16CA48);
        }

        .test-container {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 40px;
        }

        .answers {
            display: flex;
            flex-direction: column;
            gap: 0px;
            align-items: start;
            justify-content: start;
        }


        .selected_lesson {
            background: #A2EAB6;
            cursor: grab;
        }

        .checkbox {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 30px;
            height: 30px;
            min-width: 30px;
            min-height: 30px;
            border: 2px solid var(--grey, #DADADA);
            text-align: center;
            line-height: 25px;
            margin-right: 10px;
            border-radius: 100px;
            color: #fff;
        }

        .checkbox_active {
            background-color: #2B59C9;
            border: 2px solid #2B59C9;
        }

        .answer-button {
            display: flex;
            align-items: start;
            gap: 10px;
            background: none;
            border-top: 1px solid var(--grey, #DADADA);
            padding: 10px 0;
            width: 100%;
            justify-content: start;
        }

        .answer-button {
            text-align: left;
        }

        .results {
            display: flex;
            flex-direction: column;
            gap: 40px;
            align-items: center;
            justify-content: center;
        }

        .results p.text3 {
            text-align: center;
        }

        .results p.text1 {
            text-align: center;
        }

        ul#results-list p.text3 {
            text-align: left;
        }

        ul#results-list li {
            list-style-type: none;
            text-align: left;
        }

        ul#results-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        #level_kurs {
            text-align: center;
            color: #2B59C9;
        }

        @media screen and (width < 1140px) {
            .do_test {
                padding: 0px;
                border-radius: 0px;
                border: none;
            }

            body {
                background: #fff;
            }

            .test_controls {
                display: flex;
                flex-direction: column-reverse;
                justify-content: center;
                flex-wrap: wrap;
                gap: 20px;
                align-items: center;
                width: 100%;
            }
        }
    </style>










</body>

</html>