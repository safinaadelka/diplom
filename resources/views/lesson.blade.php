<?php


use App\Models\Word;
use App\Models\Lesson;
use App\Models\Kurs;
use App\Models\Dictionary;
use App\Models\Study;
use Dompdf\Dompdf;

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


    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/lesson.css')}}">
    <link rel="shortcut icon" href="{{asset('assets/img/favicon.svg')}}" type="image/x-icon">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Onest:wght@100..900&display=swap');
    </style>


    <script src="{{asset('assets/js/tabs.js')}}" defer></script>
    <script src="{{asset('assets/js/scroll.js')}}" defer></script>
    <script src="{{asset('assets/js/header.js')}}" defer></script>

    <script src="{{asset('assets/js/sound.js')}}" defer></script>

    <script src="{{asset('assets/js/dictionary.js')}}" defer></script>



    <title>Document</title>
</head>

<body>
    @include('components.header')

    @php

    $id = $kurs->id;

    $id_lesson = $lesson->id;

    $id_user = Auth::user()->id;
    echo $id_user;
    var_dump($id_user);





    $user = Auth::user();
    $done_lesson = Study::where('id_user', $user->id)->where('id_lesson', $lesson->id)->where('modul', $kurs->id)->first();


    @endphp
    @csrf
    <div class="lesson">
        <div class="lesson_img_mobile">
            <img src="{{ asset('/storage/lessons/'. $lesson->foto) }}" alt="" class="lesson_img_inside">
        </div>
        <div class="container">
            <div class="lesson_content">
                <div class="kurs_lessons">
                    <div class="kurs_lessons_main">
                        <a href="#" class="text4 kurs_progress"># с_полного_нуля</a>
                        <h3>{{$kurs->name}}</h3>
                    </div>

                    <div class="kurs_lessons_scroll">
                        @php
                        $LessonNumber = 1;
                        if($kurs->lessons){
                        $lessons = json_decode(json_decode(($kurs->lessons)));
                        $kurs_lessons = Lesson::whereIn('id', $lessons)->get()->sortBy(function ($item) use ($lessons) {
                        return array_search($item->id, $lessons);
                        });
                        }

                        @endphp
                        @foreach ($kurs_lessons as $link)
                        <a href="/modul/{{$kurs->id}}/lesson/{{$link->id}}" class="lesson_link
                        @php
                        $lesson_status = Study::where('id_user', $user->id)->where('id_lesson', $link->id)->where('modul', $kurs->id)->first();
                        @endphp
                        @if ($lesson_status)
                        @if ($lesson_status->status == 3)
                        {{'done_lesson'}}
                        @elseif ($lesson_status->status == 2)
                        {{'pause_lesson'}}
                        @endif
                        @endif
                        
">
                            <p class="text3">Урок {{ $LessonNumber }}. {{$link->name}}</p>
                            @if ($link->id == $lesson->id) <img src="{{asset('assets/img/arrow_black.svg')}}" alt="" class="lesson_link_arrow">
                            @endif

                        </a>
                        @php
                        $LessonNumber ++;
                        @endphp
                        @endforeach
                    </div>
                </div>

                <div class="lesson_main">

                    <div class="lesson_plus_number">
                        @php
                        $LessonNumber = 1;
                        @endphp

                        @foreach ($kurs_lessons as $link)

                        @if ($link->id == $lesson->id)<a href="#" class="text4 status">Урок № {{$LessonNumber}}</a>
                        @endif
                        @php
                        $LessonNumber ++;
                        @endphp
                        @endforeach


                        <h1>{{$lesson->name}}</h1>
                    </div>
                    <div class="lesson_img">
                        <img src="{{ asset('/storage/lessons/'. $lesson->foto) }}" alt="{{$lesson->name}}" class="lesson_img_inside">
                    </div>

                    <div class="all" id="all">
                        {!! $lesson->text !!}
                    </div>


                    <div class="lesson_word_content">
                        <h2>Лексика</h2>
                        <div class="lesson_word_cards">


                            @php
                            $fucks = json_decode(($lesson->words));
                            $words = json_decode($fucks);
                            @endphp

                            @foreach ($words as $word)
                            @php
                            $lesson_word = Word::find($word);
                            @endphp
                            @if($lesson_word)
                            <div class="word_card">
                                <div class="word_card_up">
                                    <div class="word_card_left">
                                        <h3>{{$lesson_word->original}}</h3>
                                        <p class="text2_reg">{{$lesson_word->translate}}</p>
                                    </div>
                                    @php
                                    $word = Word::find($lesson_word->id);
                                    $userId = Auth::user()->id;
                                    @endphp


                                    <div class="word_card_actions">
                                        <button class="sound" onclick="speakWord('{{rawurlencode($lesson_word->original) }}')"><img src="{{asset('assets/img/icons/SpeakerSimpleHigh.svg')}}" alt="" class="icon_sound"></button>
                                        <button class="save" onclick="dictionary('{{$lesson_word->id}}')">
                                            <svg class="save_svg @if ($word) @php $dictionary = Dictionary::where('id_word', $word->id)->where('id_user', $userId)->first(); @endphp @if($dictionary) save_svg_active @endif @endif" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                                                <path d="M16.55 23.8375L22.85 27.8375C23.6625 28.35 24.6625 27.5875 24.425 26.65L22.6 19.475C22.5506 19.2762 22.5585 19.0674 22.6226 18.8728C22.6868 18.6781 22.8046 18.5056 22.9625 18.375L28.6125 13.6625C29.35 13.05 28.975 11.8125 28.0125 11.75L20.6375 11.275C20.4363 11.2633 20.2428 11.1933 20.0808 11.0734C19.9187 10.9535 19.7951 10.789 19.725 10.6L16.975 3.67503C16.9022 3.47491 16.7696 3.30204 16.5952 3.17988C16.4207 3.05772 16.2129 2.99219 16 2.99219C15.787 2.99219 15.5793 3.05772 15.4048 3.17988C15.2304 3.30204 15.0978 3.47491 15.025 3.67503L12.275 10.6C12.2049 10.789 12.0813 10.9535 11.9192 11.0734C11.7572 11.1933 11.5637 11.2633 11.3625 11.275L3.98749 11.75C3.02499 11.8125 2.64999 13.05 3.38749 13.6625L9.0375 18.375C9.19541 18.5056 9.31323 18.6781 9.37736 18.8728C9.4415 19.0674 9.44934 19.2762 9.39999 19.475L7.71249 26.125C7.42499 27.25 8.62499 28.1625 9.58749 27.55L15.45 23.8375C15.6144 23.733 15.8052 23.6775 16 23.6775C16.1948 23.6775 16.3856 23.733 16.55 23.8375Z" stroke="#FF6131" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    </div>
                                    <script>
                                        function speakWord(word) {
                                            let sound = new SpeechSynthesisUtterance(decodeURIComponent(word));
                                            sound.lang = 'fr-FR';
                                            sound.rate = 0.9;
                                            sound.pitch = 0.9;
                                            speechSynthesis.speak(sound);
                                        }
                                    </script>

                                </div>
                            </div>
                            @endif

                            @endforeach
                        </div>
                    </div>


                    @php

                    if($kurs->lessons){
                    $lessons = json_decode(json_decode(($kurs->lessons)));
                    }
                    $studies = Study::whereIn('id_lesson', $lessons)->where('status', 3)->where('id_user', $user->id)->where('modul', $kurs->id)->get();
                    $currentIndex = array_search($lesson->id, $lessons);

                    @endphp

                    <div class="lesson_actions">


                        @if ($currentIndex > 0)
                        <a href="/modul/{{$kurs->id}}/lesson/{{$lessons[$currentIndex-1]}}" display="none" class="button text2 black_btn"><img src="{{asset('assets/img/arrow_white.svg')}}" alt="" class="white_arrow">
                            <p class="text2">Пред. урок</p>
                        </a>

                        @else
                        <a href="#" class="button text2 black_btn black_btn_hidden" display="none"><img src="{{asset('assets/img/arrow_white.svg')}}" alt="" class="white_arrow">
                            <p class="text2">Пред. урок</p>
                        </a>
                        <style>
                            .black_btn_hidden {
                                pointer-events: none;
                                visibility: hidden;
                            }
                        </style>
                        @endif


                        <div class="lesson_stop_done">

                            @if ($done_lesson)
                            @if ($done_lesson->status == 3)
                            <a href="/modul/{{$kurs->id}}/lesson/{{$lesson->id}}/stop" class="pause"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                                    <path d="M25 5H20.5C19.9477 5 19.5 5.44772 19.5 6V26C19.5 26.5523 19.9477 27 20.5 27H25C25.5523 27 26 26.5523 26 26V6C26 5.44772 25.5523 5 25 5Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M11.5 5H7C6.44772 5 6 5.44772 6 6V26C6 26.5523 6.44772 27 7 27H11.5C12.0523 27 12.5 26.5523 12.5 26V6C12.5 5.44772 12.0523 5 11.5 5Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg></a>
                            @elseif($done_lesson->status == 2)
                            <a href="/modul/{{$kurs->id}}/lesson/{{$lesson->id}}/done" class="done"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                                    <path d="M27 9L13 23L6 16" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg></a>
                            @endif
                            @endif

                            @if (!$done_lesson || $done_lesson->status == 1)
                            <a href="/modul/{{$kurs->id}}/lesson/{{$lesson->id}}/stop" class="pause"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                                    <path d="M25 5H20.5C19.9477 5 19.5 5.44772 19.5 6V26C19.5 26.5523 19.9477 27 20.5 27H25C25.5523 27 26 26.5523 26 26V6C26 5.44772 25.5523 5 25 5Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M11.5 5H7C6.44772 5 6 5.44772 6 6V26C6 26.5523 6.44772 27 7 27H11.5C12.0523 27 12.5 26.5523 12.5 26V6C12.5 5.44772 12.0523 5 11.5 5Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg></a>
                            <a href="/modul/{{$kurs->id}}/lesson/{{$lesson->id}}/done" class="done"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                                    <path d="M27 9L13 23L6 16" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg></a>
                            @endif

                        </div>





                        @if ($currentIndex < (count($lessons)-1) ) <a href="/modul/{{$kurs->id}}/lesson/{{$lessons[$currentIndex+1]}}" class="button text2 black_btn">
                            <p class="text2"> След. урок</p><img src="{{asset('assets/img/arrow_white.svg')}}" alt="" class="white_arrow">
                            </a>
                            @else
                            @if ($currentIndex == (count($lessons)-1))
                           

                            @if (($studies->count() == $LessonNumber-1))

                            <a href="/generate-certificate/{{$kurs->id}}" class="button text2 orange_btn">
                                <p class="text2">Скачать сертификат</p><img src="{{asset('assets/img/icons/Exam_white.svg')}}" alt="" class="white_arrow">
                            </a>
                            @endif


                            @endif
                            <a class="button text2 black_btn black_btn_hidden" display="none">
                                <p class="text2"> След. урок</p><img src="{{asset('assets/img/arrow_white.svg')}}" alt="" class="white_arrow">
                            </a>
                            <style>
                                .black_btn_hidden {
                                    pointer-events: none;
                                    visibility: hidden;
                                    display: none;
                                }
                            </style>
                            @endif

                    </div>
                </div>
            </div>
        </div>
    </div>



    @include ("components.footer")


</body>

</html>