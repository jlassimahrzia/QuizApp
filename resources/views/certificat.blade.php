<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Domine&family=Dancing+Script:wght@700&family=Merriweather:ital@1&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


    <style>
        @page {
            margin: 0cm 0cm;
            size: 700pt 500pt;
        }
        body {
            margin-top: 3.5cm;
            margin-bottom: 1cm;
            margin-left: 1cm;
            margin-right: 1cm;
        }

        /**
            * Define the width, height, margins and position of the watermark.
            **/
        #watermark {
            position: fixed;
            bottom: 0px;
            left: 0px;
            /** The width and height may change
                    according to the dimensions of your letterhead
                **/
            width: 21.8cm;
            height: 28cm;

            /** Your watermark should be behind every content**/
            z-index: -1000;
        }

        .content {
            padding-top: 18vh;
        }

        .title1 {
            font-family: 'Merriweather', serif;
            font-size: 2.5rem;
            font-weight: bold
        }

        .username {
            font-family: 'Dancing Script', cursive;
            font-size: 3rem;
        }

        .course {
            font-family: 'Merriweather', serif;
            font-weight: bold
        }

        .subtext {
            font-size: 1.1rem;
        }
    </style>
</head>

<body>
    <div id="watermark">
        <img src="{{ public_path('vendors/images/bg.png') }}" height="100%" width="100%" />
    </div>

    <main style="text-align: center">
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <img width="150px" src="{{ public_path('vendors/images/quiz.png') }}" alt="" srcset="">
                        <br><br>
                        <span class="title1">Certificat d'achèvement</span>
                        <br>
                        <span><i>Ce certificat a été décerné à</i></span>
                        <br><br>
                        <span class="username">{{ Auth::user()->nom }} {{ Auth::user()->prenom }}</span>
                        <br><br>
                        <span class="subtext">
                            <i>Pour avoir terminé avec succès le cours </i><span class="course">“ {{$matiere->nom}} ”</span>
                        </span>
                        <br><br>
                        <span class="subtext"><i>Date d'attribution :</i><i>{{$date->format('d/m/Y')}}</i></span>
                        <br><br><br>
                        <div class="row">
                            <div class="col-3"></div>
                            <div class="col-3 text-left"  style='float:left;'>
                                {{-- <span><i>Date d'attribution :</i></span>
                                <br>
                            <span><i>{{$date->format('d/m/Y')}}</i></span> --}}
                            </div>
                            <div class="col-3">
                            </div>
                            <div class="col-3 text-right"  style='float:right;'>
                                <span><i>{{$matiere->enseignant->nom}} {{$matiere->enseignant->prenom}}</i></span><br>_____________<br>Enseignant
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

</body>

</html>
