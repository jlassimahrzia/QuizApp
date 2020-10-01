@extends('layouts.etudiant')
@section('head')
<meta name="viewport" content="width=device-width" />
<link href="https://surveyjs.azureedge.net/1.7.26/modern.css" type="text/css" rel="stylesheet" />
<style>
    span#qcm.label {
        display: inline;
        padding: .2em .6em .3em;
        font-size: 89%;
        font-weight: 700;
        line-height: 1;
        color: #fff;
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: .25em;
    }

    span#qcm.label-info {
        background-color: #f47575;
    }
</style>
@endsection
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <br><br><br>
            <div class="title">
                <h4>QCM</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/matiere_etudiant">Matiéres</a></li>
                    <li class="breadcrumb-item"><a href="/get_niveau/{{$qcm->niveau->matiere->id}}">Niveaux</a></li>
                    <li class="breadcrumb-item active" aria-current="page">QCM</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-6 col-sm-12 text-right">
            <div>
                <a class="btn" data-bgcolor="#1da1f2" data-color="#ffffff"
                onclick="javascript:history.go(-1)">
                    <i class="icon-copy fa fa-angle-double-left" aria-hidden="true"></i>
                    Retour</a>
            </div>
        </div>
    </div>
</div>
{{--<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
    <div class="clearfix">
        <div class="pull-left">
            <h4>QCM : <span class="text-blue">{{ $qcm->nom }}</span></h4>
<p class="mb-30 font-14"> </p>
<div id="display">

</div>
</div>
</div>
</div> --}}
{{-- @if(count($qcm->questions) > 0)
@foreach($qcm->questions as $indice=>$question)
<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
    <div class="form-group">
        <label><b>Question {{++$indice}} :</b> {{ $question->question }} ______ ?</label>
&nbsp;&nbsp;<span Style="color:red;">{{ $question->note }} points</span> &nbsp;
</div>
<table>
    <input type="hidden" name="qcm_id" value="{{$qcm->id}}">
    <tr>
        <td>
            <label> <span id="qcm" class="label label-info">A</span>
                &nbsp;&nbsp; {{ $question->choix1 }} &nbsp;&nbsp;</label>
        </td>
        <td>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="reponse1_{{$question->id}}"
                    name="reponse1_{{$question->id}}">
                <label class="custom-control-label" for="reponse1_{{$question->id}}"></label>
            </div>
        </td>
        </td>
    </tr>
    <tr>
        <td>
            <label> <span id="qcm" class="label label-info">B</span>
                &nbsp;&nbsp; {{ $question->choix2 }} &nbsp;&nbsp;</label>
        </td>
        <td>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="reponse2_{{$question->id}}"
                    name="reponse2_{{$question->id}}">
                <label class="custom-control-label" for="reponse2_{{$question->id}}"></label>
            </div>
        </td>
        </td>
    </tr>
    <tr>
        <td>
            <label> <span id="qcm" class="label label-info">C</span>
                &nbsp;&nbsp; {{ $question->choix3 }} &nbsp;&nbsp;</label>
        </td>
        <td>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="reponse3_{{$question->id}}"
                    name="reponse3_{{$question->id}}">
                <label class="custom-control-label" for="reponse3_{{$question->id}}"></label>
            </div>
        </td>
        </td>
    </tr>
    @if($question->choix4 !== null)
    <tr>
        <td>
            <label> <span id="qcm" class="label label-info">D</span>
                &nbsp;&nbsp; {{ $question->choix4 }} &nbsp;&nbsp;</label>
        </td>
        <td>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="reponse4_{{$question->id}}"
                    name="reponse4_{{$question->id}}">
                <label class="custom-control-label" for="reponse4_{{$question->id}}"></label>
            </div>
        </td>
        </td>
    </tr>
    @endif
</table>
</div>
@endforeach
@endif --}}
<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
    <div id="surveyElement" style="display:inline-block;width:100%;"></div>
    <div id="surveyResult"></div>
</div>
@section('script')
{{-- <script>
    function CountDown(duration, display) {
      if (!isNaN(duration)) {
        var timer = duration, minutes, seconds;

        var interVal=  setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                $(display).html("<b>" + minutes + "m : " + seconds + "s" + "</b>");
                if (--timer < 0) {
                    timer = duration;
                SubmitFunction();
                $('#display').empty();
                clearInterval(interVal)
                }
        },1000);
        }
    }
    CountDown(600,$('#display'));
</script> --}}

<script src="https://unpkg.com/jquery"></script>
<script src="https://surveyjs.azureedge.net/1.7.26/survey.jquery.js"></script>
<script>
    Survey
    .StylesManager
    .applyTheme("modern");

    @php
       $x = json_encode($qcm->questions);
       $nom = json_encode($qcm->nom) ;
       $duree = json_encode($qcm->duree) ;
       $id = json_encode($qcm->id) ;
       $id_etudiant = json_encode($user->id) ;
       echo "var myquestions = $x ;";
       echo "var nom = $nom ;";
       echo "var id = $id ;";
       echo "var duree = $duree ;";
       echo "var id_etudiant = $id_etudiant ;";
    @endphp

    console.log(myquestions);

    let mypages = [];
    myquestions.forEach(q => {
        mypages.push(
        {
            questions: [
               {
                    type: "checkbox",
                    name: ""+q.id,
                    title: q.question+" ( "+q.note+" points )",
                    isRequired: false,
                    hasNone: false,
                    colCount: 1,
                    choices: [
                        q.choix1,
                        q.choix2,
                        q.choix3,
                        q.choix4
                    ]
               }
            ],
        }
        );
    });

var json = {
    completedHtml: "<a href=\"/resultat_etudiant/"+id+"/"+id_etudiant+"\" class=\"btn btn-secondary\">Voir Resultat</button> ",
    title: nom,
    firstPageIsStarted: true,
    startSurveyText: "Démarrer le quiz",
    showTimerPanel: "top",
    maxTimeToFinish: duree*60,
    pages: [
        {
            questions: [
                {
                    type: "html",
                    html: "Vous êtes sur le point de commencer le quiz.<br>Vous disposez de "+duree+" mn .<br>Veuillez cliquer sur le bouton «Démarrer le quiz» lorsque vous êtes prêt."
                }
            ]
        },
        ...mypages
    ],
    showQuestionNumbers: "on"
};


window.survey = new Survey.Model(json);

survey
    .onComplete
    .add(function (result) {
        /* document
            .querySelector('#surveyResult')
            .textContent = "Result JSON:\n" + JSON.stringify(result, null, 3); */
            submitData(result.data);
    });
survey.showPreviewBeforeComplete = 'showAnsweredQuestions';

var storageName = "SurveyJS_LoadState";
var timerId = 0;

function loadState(survey) {
    //Here should be the code to load the data from your database
    var storageSt = window
        .localStorage
        .getItem(storageName) || "";

    var res = {};
    if (storageSt)
        res = JSON.parse(storageSt); //Create the survey state for the demo. This line should be deleted in the real app.
    else
        res = {
            currentPageNo: 1,
            data: {
                "satisfaction": "4",
                "Quality": {
                    "does what it claims": "1"
                },
                "recommend friends": "3",
                "price to competitors": "More expensive",
                "price": "correct",
                "pricelimit": {
                    "mostamount": ""
                }
            }
        };

    //Set the loaded data into the survey.
    if (res.currentPageNo)
        survey.currentPageNo = res.currentPageNo;
    if (res.data)
        survey.data = res.data;
    }

function saveState(survey) {
    var res = {
        currentPageNo: survey.currentPageNo,
        data: survey.data
    };
    //Here should be the code to save the data into your database
    window
        .localStorage
        .setItem(storageName, JSON.stringify(res));
}

function submitData(data) {
    $.post('/store_question/'+id, {
        "_token": "{{ csrf_token() }}",
        data: data}, (res) => {
        console.log({'res' : data});
        console.log({'id' : id});
    });
}
survey
    .onCurrentPageChanged
    .add(function (survey, options) {
        saveState(survey);
    });
survey
    .onComplete
    .add(function (survey, options) {
        //kill the timer
        clearInterval(timerId);
        //save the data on survey complete. You may call another function to store the final results
        saveState(survey);

    });

//Load the initial state
//loadState(survey);

//save the data every 10 seconds, it is a good idea to change it to 30-60 seconds or more.
timerId = window.setInterval(function () {
    saveState(survey);
}, 10000);
survey.showPreviewBeforeComplete = 'showAnsweredQuestions';

$("#surveyElement").Survey({model: survey});
</script>
@endsection
@endsection
