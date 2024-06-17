<?php

use App\Models\Lesson; ?>

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


    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{asset('assets/css/profile.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/kurs.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/reg.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/lesson.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/add.css')}}">
    <link rel="shortcut icon" href="assets/img/favicon.svg" type="image/x-icon">


    <style>
        @import url('https://fonts.googleapis.com/css2?family=Onest:wght@100..900&display=swap');
    </style>


    <script src="{{asset('assets/js/tabs.js')}}" defer></script>
    <script src="{{asset('assets/js/scroll.js')}}" defer></script>
    <script src="{{asset('assets/js/header.js')}}" defer></script>
    <script src="{{asset('assets/js/profile_tabs.js')}}" defer></script>
    <script src="{{asset('assets/js/cropper.js')}}" defer></script>
    <script src="{{asset('assets/js/server.js')}}" defer></script>
    <script src="{{asset('assets/js/words.js')}}" defer></script>
    <script src="{{asset('assets/js/add_kurs.js')}}" defer></script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>






    <title>Добавление курса</title>
</head>


<body>

    @include('components.header')
    @csrf




    <div class="add_lesson">
        <div class="container">
            <div class="add_content">
                <div class="add_content_up">
                    <h1>Добавить новый курс</h1>
                </div>
                <div class="modal">
                    <form action="add_kurs" method="post" id="add_kurs">
                        <div class="modal_add_inner">
                            <div class="modal_add_left">
                                <div>
                                    <h3>Название курса</h3>

                                    @csrf

                                    <div class="animate_input">
                                        <div class="form">
                                            <input type="text" name="name" id="name" placeholder="" value="{{old('name')}}">
                                            <label for="name">название курса</label>
                                        </div>
                                        @error('name')
                                        <p class="error red">{{$message}}</p>
                                        @enderror
                                    </div>

                                </div>

                                <div>
                                    <h3>Описание курса</h3>
                                    <div class="form_textarea">
                                        <textarea name="descript" id="textarea" rows="3" placeholder="описание курса">{{old('descript')}}</textarea>
                                        @error('descript')
                                        <p class="error red">{{$message}}</p>
                                        @enderror
                                    </div>

                                </div>
                            </div>

                            <input type="text" form="add_kurs" name="lessons" id="lessons_input" value="{{old('lessons')}}" required style="display:none; position:static">



                            <div></div>
                            <div></div>
                            <div class="modal_add_right">
                                <h3>Выберите уроки и расположите их в нужном порядке:</h3>

                                <p class="text4" id="choose_lesson_count"></p>
                                @php
                                $lessons = Lesson::where('modul', 0)->get();
                                @endphp
                                <br>


                                <div id="choose_lessons">
                                    @foreach ( $lessons as $lesson)
                                    <div class="lesson" data-id="{{$lesson->id}}"><span class="checkbox"></span>
                                        <p class="text3">{{$lesson->name}}</p>
                                    </div>
                                    @endforeach
                                    @error('lessons')
                                    <p class="error red">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="add_content_down">
                    <button type="submit" form="add_kurs" class="text2 button black_btn" disabled id="third_add_step">Добавить курс</button>
                </div>

            </div>
        </div>
    </div>

    <style>
        .modal_add_right {
            padding: 10px 0;
            padding-left: 30px;
            border-left: 2px solid #ccc;
        }

        .lesson {
            padding: 10px;
            margin: 0;
            border-radius: 10px;
            border: 1px solid var(--grey, #DADADA);
            background: #FFF;
            color: black;

            display: flex;
            align-items: center;
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
            background-color: var(--green, #16CA48);
            border: 2px solid var(--green, #16CA48);
        }

        #choose_lessons {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
    </style>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
        let selectedLessons = [];

        function updateSelectedLessons() {
            selectedLessons = [];
            $(".lesson.selected_lesson").each(function() {
                selectedLessons.push($(this).data("id"));
            });
            console.log(selectedLessons);
            document.querySelector("#choose_lesson_count").innerHTML = "Выбрано уроков: " + selectedLessons.length;
            let formDate = new FormData();


            selectedLessons.forEach(lesson => {
                formDate.append('id', lesson);
            });
            for (let [name, value] of formDate) {
                console.log(`${name} = ${value}`);
                let string = JSON.stringify(value);
            }
            document.querySelector("#lessons_input").value = JSON.stringify(formDate.getAll('id').map(id => parseInt(id)));
        }

        $(".checkbox").click(function(e) {
            e.stopPropagation();
            const checkbox = $(this);
            const lesson = checkbox.parent();
            if (lesson.hasClass("selected_lesson") || lesson.attr("style")) {
                checkbox.text("");
                checkbox.removeClass("checkbox_active")
                lesson.removeClass("selected_lesson");

                const selectedLessons = $(".selected_lesson");
                const lastSelectedLesson = selectedLessons.last();
                // const nextSelectedLesson = lastSelectedLesson.nextAll(".selected").first();
                // console.log("nextSelectedLesson", nextSelectedLesson); 
                if (lastSelectedLesson.length) {
                    lesson.insertAfter(lastSelectedLesson);
                    console.log("gjckcck");
                }
                lesson.removeAttr("draggable");

            } else {
                checkbox.text("✔");
                checkbox.addClass("checkbox_active")
                lesson.addClass("selected_lesson");

                lesson.attr("draggable", "true");
                const selectedLessons = $(".selected_lesson");
                const lastSelectedLesson = selectedLessons.eq(selectedLessons.length - 2);
                console.log("lastSelectedLesson", lastSelectedLesson);
                // const nextSelectedLesson = lastSelectedLesson.nextAll(".selected").first();
                // console.log("nextSelectedLesson", nextSelectedLesson); 
                if (selectedLessons.length > 1) {
                    lesson.insertAfter(lastSelectedLesson);
                    console.log("gjckcck");
                } else {
                    lesson.prependTo("#choose_lessons");
                }

                // Перемещение выбранного урока в начало списка
            }
            updateSelectedLessons();
        });


        $("#choose_lessons").sortable({
            items: ".selected_lesson",
            update: function(event, ui) {
                updateSelectedLessons();
            },
            start: function(event, ui) {
                ui.item.data('start-index', ui.item.index());
            },
            stop: function(event, ui) {
                updateSelectedLessons();
                const startIndex = ui.item.data('start-index');
                const endIndex = ui.item.index();
                if (startIndex !== endIndex) {
                    const lessonId = ui.item.data('id');
                    // selectedLessons.splice(endIndex, 0, selectedLessons.splice(startIndex, 1)[0]);
                    // console.log(selectedLessons);
                }
            }
        });
    </script>



    @include ("components.footer")

</body>



</html>