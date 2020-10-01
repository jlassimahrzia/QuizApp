@extends('layouts.app')
@section('head')
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

    #a {
        display: none;
    }

    #a2 {
        display: none;
    }
</style>
@endsection
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>QCM</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ URL::previous() }}">QCM</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Afficher</li>
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
<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
    <div class="clearfix">

            <h4>QCM : <span class="text-blue">{{ $qcm->nom }}</span></h4>
            <p class="mb-30 font-14"> </p>
            <div class="alert alert-primary alert-dismissible fade show ">
                <i class="icon-copy fi-clock"></i>&nbsp;<strong>{{ $qcm->duree }} min !</strong>
            </div>

    </div>
</div>
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if(count($questions) > 0)
@foreach($questions as $indice=>$question)
<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
    <div class="form-group">
        <label><b>Question {{++$indice}} :</b> {{ $question->question }} ______ ?</label>
        &nbsp;&nbsp;<span Style="color:red;">{{ $question->note }} points</span> &nbsp;
    </div>
    <table>
        <tr>
            <td>
                <div class="form-group">
                    <label> <span id="qcm" class="label label-info">A</span>
                        {{ $question->choix1 }}</label>
                    &nbsp;&nbsp;
                    @if($question->reponse1 == 'vrai')
                    <i class="icon-copy fa fa-check-square-o" aria-hidden="true"></i>
                    @elseif($question->reponse1 == "faux")
                    <i class="icon-copy fa fa-window-close" aria-hidden="true"></i>
                    @endif
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="form-group">
                    <label> <span id="qcm" class="label label-info">B</span>
                        {{ $question->choix2 }}</label>
                    &nbsp;&nbsp;
                    @if($question->reponse2 === "vrai")
                    <i class="icon-copy fa fa-check-square-o" aria-hidden="true"></i>
                    @elseif($question->reponse2 === "faux")
                    <i class="icon-copy fa fa-window-close" aria-hidden="true"></i>
                    @endif
                </div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="form-group">
                    <label> <span id="qcm" class="label label-info">C</span>
                        {{ $question->choix3 }}</label>
                    &nbsp;&nbsp;
                    @if($question->reponse3 === "vrai")
                    <i class="icon-copy fa fa-check-square-o" aria-hidden="true"></i>
                    @elseif($question->reponse3 === "faux")
                    <i class="icon-copy fa fa-window-close" aria-hidden="true"></i>
                    @endif
                </div>
            </td>
        </tr>
        @if($question->choix4 !== null)
        <tr>
            <td>
                <div class="form-group">
                    <label> <span id="qcm" class="label label-info">A</span>
                        {{ $question->choix4 }}</label>
                    &nbsp;&nbsp;
                    @if($question->reponse4 === "vrai")
                    <i class="icon-copy fa fa-check-square-o" aria-hidden="true"></i>
                    @elseif($question->reponse4 === "faux")
                    <i class="icon-copy fa fa-window-close" aria-hidden="true"></i>
                    @endif
                </div>
            </td>
        </tr>
        @endif
    </table>
    <table>
        <tr>
            <td>
                <a class="btn btn-primary" data-bgcolor="#28a745" data-color="#ffffff"
                    href="{{ route('question.edit',$question->id)}}">
                    <i class="fa fa-pencil"></i>&nbsp;&nbsp;Modifier</a>

                <form action="{{ route('question.destroy', $question->id)}}" id="myform" method="post">
                    @csrf
                    @method('DELETE')
                </form>
            </td>
            <td width="10%">
            </td>
            <td>
                <button class="btn btn-danger" id="delete">
                    <i class="fi-x"></i> Supprimer
                </button>
            </td>
        </tr>
    </table>
</div>
@endforeach
@endif


@section('script')
<script>
    let togg1 = document.getElementsByClassName("togg1");
    let togg2 = document.getElementsByClassName("togg2");

    let a = document.getElementsByClassName("a");
    let a2 = document.getElementsByClassName("a2");

    togg1.addEventListener("click", () => {
    if(getComputedStyle(a).display != "none"){
        a.style.display = "none";
    } else {
        a.style.display = "block";
    }
    })
    togg2.addEventListener("click", () => {
    if(getComputedStyle(a2).display != "none"){
        a2.style.display = "none";
    } else {
        a2.style.display = "block";
    }
    }) ;
</script>
<script src="{{asset('src/plugins/sweetalert2/sweetalert2.all.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('src/plugins/sweetalert2/sweetalert2.css')}}">
{{-- <script src="{{asset('src/plugins/sweetalert2/sweet-alert.init.js')}}"></script> --}}
<script>
    $('button#delete').on('click', function(){
                swal({
                title: 'Vous êtes sûr ?',
                text: "Question sera supprimé d'une façon permanente !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Supprimer'
                }).then((result) => {
                    if (result.value) {
                        $("#myform").submit();
                    }
                });
            });
</script>
@endsection
@endsection
