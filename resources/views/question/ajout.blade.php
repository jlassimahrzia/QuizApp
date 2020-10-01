@extends('layouts.app')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
            <h4>QCM : <span class="text-blue"> {{$qcm->nom}}</span></h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/qcm">Question</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ajouter</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-6 col-sm-12 text-right">
            <div>
                <a class="btn" data-bgcolor="#1da1f2" data-color="#ffffff"
                onclick="javascript:history.go(-2)">
                    <i class="icon-copy fa fa-angle-double-left" aria-hidden="true"></i>
                    Retour</a>
            </div>
        </div>
    </div>
</div>
<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
    <div class="clearfix">
        <div class="pull-left">
            <h4 class="text-blue">Entrer une Question </h4>
            <br>
            <p class="mb-30 font-14">La question doit être composée obligatoirement par 3 ou 4 choix </p>
        </div>

    </div>
    <form method="post" action="{{ route('question.store') }}">
        @csrf
        <input type="hidden" value="{{ $qcm->id }}" name="id_qcm">
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label"><i class="icon-copy ion-help"></i>&nbsp;Question</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control @error('question') is-invalid @enderror" placeholder="Entrer votre question"
                 type="text" name="question" value="{{ old('question') }}">
            </div>
            @error('question')
            <div class="form-control-feedback col-sm-12 col-md-10 has-danger">{{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label"><i class="icon-copy ion-compose"></i>&nbsp;Point</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control @error('note') is-invalid @enderror" placeholder="Point" type="number" name="note"
                value="{{ old('note') }}">
            </div>
            @error('note')
            <div class="form-control-feedback col-sm-12 col-md-10 has-danger">{{ $message }}
            </div>
            @enderror
        </div>
        <br>
        <p class="mb-30 font-14">Cocher un ou plusieur choix (le choix correct) :</p>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label"><i class="icon-copy fa fa-check-square-o"
                    aria-hidden="true"></i>&nbsp;Choix 1</label>
            <div class="col-sm-12 col-md-8">
                <input class="form-control @error('choix1') is-invalid @enderror" placeholder="choix 1" type="text"
                 name="choix1"  value="{{ old('choix1') }}">
            </div>
            <div class="custom-control custom-checkbox mb-5 col-sm-12 col-md-2" style="margin-top: 4px;">
                <input type="checkbox" class="custom-control-input" id="reponse1" name="reponse1" value="{{ old('reponse1') }}">
                <label class="custom-control-label" for="reponse1">Choix Correct?!!</label>
            </div>
            @error('choix1')
            <div class="form-control-feedback col-sm-12 col-md-10 has-danger">{{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label"><i class="icon-copy fa fa-check-square-o"
                    aria-hidden="true"></i>&nbsp;Choix 2</label>
            <div class="col-sm-12 col-md-8">
                <input class="form-control @error('choix2') is-invalid @enderror" placeholder="choix 2" type="text"
                name="choix2"  value="{{ old('choix2') }}">
            </div>
            <div class="custom-control custom-checkbox mb-5 col-sm-12 col-md-2" style="margin-top: 4px;">
                <input type="checkbox" class="custom-control-input" id="reponse2" name="reponse2" value="{{ old('reponse2') }}">
                <label class="custom-control-label" for="reponse2">Choix Correct?!!</label>
            </div>
            @error('choix2')
            <div class="form-control-feedback col-sm-12 col-md-10 has-danger">{{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label"><i class="icon-copy fa fa-check-square-o"
                    aria-hidden="true"></i>&nbsp;Choix 3</label>
            <div class="col-sm-12 col-md-8">
                <input class="form-control @error('choix3') is-invalid @enderror" placeholder="choix 3"
                type="text" name="choix3"  value="{{ old('choix3') }}">
            </div>
            <div class="custom-control custom-checkbox mb-5 col-sm-12 col-md-2" style="margin-top: 4px;">
                <input type="checkbox" class="custom-control-input" id="reponse3" name="reponse3" value="{{ old('reponse3') }}" >
                <label class="custom-control-label" for="reponse3">Choix Correct?!!</label>
            </div>
            @error('choix3')
            <div class="form-control-feedback col-sm-12 col-md-10 has-danger">{{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label"><i class="icon-copy fa fa-check-square-o"
                    aria-hidden="true"></i>&nbsp;Choix 4</label>
            <div class="col-sm-12 col-md-8">
                <input class="form-control" placeholder="choix 4" type="text" name="choix4"
                value="{{ old('choix4') }}">
            </div>
            <div class="custom-control custom-checkbox mb-5 col-sm-12 col-md-2" style="margin-top: 4px;">
                <input type="checkbox" class="custom-control-input" id="reponse4" name="reponse4"
                value="{{ old('reponse4') }}">
                <label class="custom-control-label" for="reponse4">Choix Correct?!!</label>
            </div>
        </div>
        <button type="submit" class="btn btn-warning" name="action" value="question" style="margin-left:70%;"
        data-toggle="tooltip" title="Si c'est la derniére question appuyer sur ajouter question avant puis sur finir">
            <i class="icon-copy fa fa-mail-forward"aria-hidden="true"></i>
            &nbsp;Ajouter Question
        </button>
        <button type="submit" class="btn btn-success" name="action" value="fin"
        data-toggle="tooltip" title="Appuyer finir si vous n'avez pas remplir une question à ajouter">
            <i class="icon-copy fi-power"></i>
            &nbsp;finir
        </button>
    </form>
</div>
@endsection
