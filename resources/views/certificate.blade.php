<?php

use App\Models\Word;
use App\Models\Lesson;
use App\Models\Kurs;
use App\Models\Study;
use Dompdf\Dompdf; ?>


<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">







    <style>
        * {
            padding: 0;
            margin: 0;
            list-style: none;
            text-decoration: none;
            box-sizing: border-box;
            border: none;
            size: A4 landscape;
            orientation: landscape;
            aspect-ratio: 1.414 / 1;
            overflow-y: hidden;
            /* height: auto; */
        }

        body {
            padding: 20px 20px;
            background-color: #2B59C9;
            overflow-y: hidden;
        }

        .ever {
            background-color: white;
            background: #fff;
            width: 100%;
            height: 100%;
            overflow-y: hidden;
        }


        ::-webkit-scrollbar {
            display: none;
        }

        .certificate {
            background: #2B59C9;
            aspect-ratio: 1.414 / 1;
            padding: 20px;
            width: 100%;
            height: 100%;
            /* height: 793px;
               
                overflow: hidden;

                size: A4 landscape;
                orientation: landscape; */

        }

        .certificate_inner {
            background: #fff;
            max-height: 100%;


            overflow-x: hidden;
            overflow-y: hidden;


        }



        #certificate_info_item1 {
            margin-bottom: 40px;
        }

        #certificate_info_item2 {
            margin-top: 40px;
        }

        .new_logo {
            max-width: 370px;
            width: 370px;
            max-height: 88px;
            height: 88px;
            object-fit: contain;
            margin-bottom: 35px;
        }

        .easy_pechat {
            max-width: 160px;
            max-height: 160px;
        }



        .company_info_left {
            margin-top: 20px;
            width: 100%;
            padding-right: 50px;
            display: inline-block;
            max-height: 160px;
            height: 160px;


        }

        .company_info_pechat {
            display: inline-block;
        }

        .company_info_left_down {

            gap: 20px;
        }

        h3 br {
            line-height: 50%;
        }

        .blue {
            color: #0E348F;
        }

        h2.blue {
            color: #0E348F;
            font-family: Onest;
            font-size: 30px;
            font-style: normal;
            font-weight: 600;
            line-height: 110%;
            /* 33px */
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        #ser1 {
            margin-bottom: 10px;
        }

        .grey {
            color: rgba(0, 0, 0, 0.50);
        }

        .kegl10 {
            font-family: Onest;
            font-size: 12px;
            font-style: normal;
            font-weight: 400;
            line-height: 125%;
            /* 12.5px */
        }

        .certificate_inner_left {
            max-height: 100%;
            height: 100%;
            min-height: 100%;



            max-width: 100%;


            position: relative;


        }


        .certificate_info {
            padding: 30px;
        }

        .company_info {

            position: absolute;

            left: 0;
            bottom: 0;
            /* top: 70%; */

            padding-bottom: 30px;
            padding-left: 30px;

        }

        .certificate_inner_right {

            background: var(--orange, #FF6131);
            position: relative;

            max-height: 100%;
            height: 100%;
            max-width: 101%;
            width: 101%;

            overflow: hidden;



        }

        .certificate_tower {
            position: absolute;

            bottom: 0;
            max-width: 100%;
            width: 100%;



            height: auto;
            z-index: 0;


        }

        #table {
            max-height: 100%;
            border-spacing: 0px;
            max-width: 100%;
            width: 100%;
            height: 100%;
            padding: 0;
        }

        tr {
            max-width: 100%;
            width: 100%;
            max-height: 100%;
        }

        #th1 {
            text-align: left;
            width: 74%;
            max-height: 100%;
            height: 100%;
            min-height: 100%;


        }

        #th2 {
            width: 27%;
            height: 100%;
            max-height: 100%;
            background: var(--orange, #FF6131);
            overflow: hidden;
            padding: 0;

        }
    </style>

    <title>Cer</title>
</head>

<body>
    <div class="ever">
        <div class="certificate_inner">
            <table id="table">
                <td id="th1">
                    <div class="certificate_inner_left">

                        <div class="certificate_info">
                            <div class="certificate_info_item" id="certificate_info_item1">
                                <h2 class="blue">Сертификат</h2>
                                <p class="error blue">Настоящим сертификатом подтверждается, что </p>
                            </div>

                            <h1>
                                @php
                                $user = Auth::user();
                                @endphp
                                {{$user->surname}} {{$user->name}} 
                            </h1>

                            @php
                            $kurs = Kurs::findOrFail($id);
                            @endphp

                            <div class="certificate_info_item" id="certificate_info_item2">
                                <p class="error grey" id="ser1">успешно прошeл(ла) обучение по онлайн-курсу </p>
                                <h3>Французский язык. <br> {{$kurs->name}} </h3>
                            </div>
                        </div>

                        <div class="company_info" id="company_tr">
                            <table>
                                <td>
                                    <div class="company_info_left">
                                        <?php
                                        $path = 'assets\img\new_logo.svg';
                                        $type = pathinfo($path, PATHINFO_EXTENSION);
                                        $data = file_get_contents($path);
                                        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

                                        ?>

                                        <img src="<?php echo $base64 ?>" alt="new-logo" class="new_logo" />

                                        <div class="company_info_left_down">
                                            <table>
                                                <tr>
                                                    <td>
                                                        <p class="kegl10 grey">№ сертификата: 12596689</p>
                                                    </td>

                                                    <td>
                                                        <p class="kegl10 grey">Дата выдачи: 01.06.2024</p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="company_info_pechat">
                                        <?php
                                        $path = 'assets/img/pechat.svg';
                                        $type = pathinfo($path, PATHINFO_EXTENSION);
                                        $data = file_get_contents($path);
                                        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

                                        ?>

                                        <img src="<?php echo $base64 ?>" alt="" class="easy_pechat">

                                    </div>

                                </td>
                            </table>

                        </div>

                    </div>

                </td>

                <td id="th2">
                    <div class="certificate_inner_right">
                        <?php
                        $path = 'assets/img/eifel_tower.svg';
                        $type = pathinfo($path, PATHINFO_EXTENSION);
                        $data = file_get_contents($path);
                        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

                        ?>
                        <img src="<?php echo $base64 ?>" alt="" class="certificate_tower">
                    </div>
                </td>
            </table>
        </div>
    </div>
    </div>


    <style>
        @font-face {
            font-family: "Onest";
            src: url("../font/Onest-VariableFont_wght.ttf") format("ttf");
            font-weight: normal;
            font-style: normal;
            font-display: swap;
            line-height: 100%;
        }



        body {
            font-family: "Onest";
            font-weight: normal;
            font-style: normal;
            font-display: swap;

        }

        /* общие стили - ТЕКСТ */
        h1 {
            font-family: "Onest";
            font-size: 70px;
            font-style: normal;
            font-weight: 600;
            line-height: 56px;
        }

        h2 {
            font-family: "Onest";
            font-size: 40px;
            font-style: normal;
            font-weight: 600;
            line-height: 32px;
        }

        h3 {
            font-family: "Onest";
            font-size: 30px;
            font-style: normal;
            font-weight: 600;
            line-height: 24px;
        }

        .error {
            font-family: "Onest";
            font-size: 18px;
            font-style: normal;
            font-weight: 500;
            line-height: 14px;
        }
    </style>
</body>

</html>