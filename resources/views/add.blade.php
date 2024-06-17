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



    <link rel="stylesheet" href="{{asset('assets/css/profile.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{asset('assets/css/kurs.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/reg.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/lesson.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/add.css')}}">
    <link rel="shortcut icon" href="{{asset('assets/img/favicon.svg')}}" type="image/x-icon">


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
    <script src="{{asset('assets/js/open_modal.js')}}" defer></script>
    <script src="{{asset('assets/js/add_validation.js')}}" defer></script>
    <script src="{{asset('assets/js/add_slides.js')}}" defer></script>
    <script src="{{asset('assets/js/status.js')}}" defer></script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="js/tinymce/tinymce.min.js"></script>
    <script src="{{asset('assets/js/tiny.js')}}" defer></script>










    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.11/cropper.min.js"></script>


    <title>Добавление</title>
</head>


<body>

    @include('components.header')
    @csrf

    <div class="word_modal" id="add_word_modal">
        <div class="container">
            <div class="reg_content">
                <div class="modal">
                    <a class="close_krest" id="close_word_modal"><img src="{{asset('assets/img/icons/X_black.svg')}}" alt=""></a>
                    <h2>Новое слово</h2>
                    <div class="form_profile">
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
                    </div>

                    <button class="button text2 black_btn" id="add_word_btn" disabled>Добавить в словарь</button>
                </div>
            </div>
        </div>
    </div>


    <div class="add_lesson">
        <div class="container">
            <div class="add_content">
                <div class="add_content_up">
                    <h1>Создание урока</h1>



                    <div class="add_steps">
                        <div id="add_step_1" class="add_step">
                            <p class="text2">1</p>
                        </div>
                        <div id="add_step_2" class="add_step">
                            <p class="text2">2</p>
                        </div>
                        <div id="add_step_3" class="add_step">
                            <p class="text2">3</p>
                        </div>
                        <hr class="line" id="process_line">
                    </div>
                </div>
                <div class="add_slides_container">
                    <div class="add_slides" id="add_slides">
                        <div class="add_slide">
                            <div class="modal">
                                <div class="modal_add_inner">
                                    <div class="modal_add_left">
                                        <div>
                                            <h3>Название урока</h3>
                                            <div class="form_textarea">
                                                <textarea name="name" id="textarea" rows="3" placeholder="описание курса"></textarea>
                                                @error('name')
                                                <p class="error red">{{$message}}</p>
                                                @enderror

                                            </div>
                                        </div>
                                        <div>
                                            <h3>Обложка урока</h3>
                                            <div class="form">
                                                <form enctype="multipart/form-data">
                                                    <input type="file" onchange="checkFileUpload()" name="" id="fileInput" accept=".jpg , .png , .jpeg">
                                                </form>

                                            </div>

                                        </div>
                                    </div>

                                    <div class="modal_add_right">
                                        <div id="cropper_image_place">
                                            <img id="image" src="">
                                        </div>
                                        <br>
                                        <button id="cropButton" class="text3">Сохранить изображение</button>
                                    </div>
                                </div>
                            </div>
                            <br> <br>
                            <div class="add_content_down">
                                <button onclick="goToSlide(0)" class="button black_btn" id="prev_add" disabled><img src="assets/img/arrow_white.svg" alt="" class="white_arrow white_arrow_reverse">
                                    <p class="text2">Предыдущий шаг</p>
                                </button>

                                <button onclick="goToSlide(1)" class="button black_btn" id="first_add_step" disabled>
                                    <p class="text2">Следующий шаг</p> <img src="assets/img/arrow_white.svg" alt="" class="white_arrow">
                                </button>

                            </div>
                        </div>

                        <div class="add_slide">
                            <div class="redaktor">

                            </div>

                            <br> <br>
                            <div class="add_content_down">
                                <button onclick="goToSlide(0)" class="button black_btn" id="prev_add"><img src="assets/img/arrow_white.svg" alt="" class="white_arrow white_arrow_reverse">
                                    <p class="text2">Предыдущий шаг</p>
                                </button>

                                <button onclick="goToSlide(2)" class="button black_btn" id="second_add_step" disabled>
                                    <p class="text2">Следующий шаг</p> <img src="assets/img/arrow_white.svg" alt="" class="white_arrow">
                                </button>
                            </div>
                        </div>

                        <div class="add_slide">
                            <div class="modal">
                                <div class="words_add_inner">
                                    <div class="words_add_inner_up">
                                        <div class="search_div">
                                            <input type="search" name="" id="searchInput" class="text3" placeholder="Слово в оригинале или перевод">
                                            <br> <br>
                                            <p class="text4" id="search_count"></p>
                                        </div>
                                        <a id="open_word_modal" class="button green_btn">
                                            <p class="text2">Новое слово</p><img src="{{asset('assets/img/icons/Plus.svg')}}" alt="" class="btn_icon">
                                        </a>
                                    </div>


                                    <div class="chose_words" id="chose_words">
                                        @foreach ($words->reverse() as $word)
                                        <div class="word_card" data-card="{{$word->id}}">
                                            <div class="word_card_up">
                                                <div class="word_card_left">
                                                    <h3 data-original="{{$word->original}}">{{$word->original}}</h3>
                                                    <p data-translate="{{$word->translate}}" class="text2_reg">{{$word->translate}}</p>
                                                </div>
                                                <div class="word_card_actions">
                                                    <div class="circle"></div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <br> <br>
                            <div class="add_content_down">
                                <button onclick="goToSlide(1)" class="button black_btn" id="prev_add"><img src="assets/img/arrow_white.svg" alt="" class="white_arrow white_arrow_reverse">
                                    <p class="text2">Предыдущий шаг</p>
                                </button>

                                <button>
                                    <input type="submit" name="fuck" value="Добавить урок" disabled class="text2 button black_btn" id="third_add_step">
                                    </input>
                                </button>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="assets/js/redaktor.js" defer></script>


    @include ("components.footer")

</body>



</html>