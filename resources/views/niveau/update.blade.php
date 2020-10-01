@extends('layouts.app')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Niveau</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/afficher_niveaux/{{$niveau->matiere->id}}">Niveau</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Modifier</li>
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
@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
    <div class="clearfix">
        <div class="pull-left">
            <h4 class="text-blue">Mise à jour un niveau</h4>
            <p class="mb-30 font-14"></p>
        </div>
    </div>
    <form method="post" action="{{ route('niveau.update', $niveau->id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label>Matiére</label>
            <select class="custom-select form-control" name="matiere" placeholder="Sélectionnez la matière">
                @if(count($matieres) > 0)
                @foreach($matieres as $matiere)
                <option {{$niveau->matiere->id==$matiere->id ? 'selected' : ''}} value="{{ $matiere->id }}">{{ $matiere->nom }}</option>
                @endforeach
                @endif
            </select>
            @error('matiere')
            <div class="form-control-feedback col-sm-12 col-md-10 has-danger" >{{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Numéro du niveau</label>
            <input class="form-control" type="number" placeholder="Entrer le numéro du niveau" name="numero"
            value="{{ $niveau->numero }}">
            @error('numero')
            <div class="form-control-feedback col-sm-12 col-md-10 has-danger" >{{ $message }}
            </div>
            @enderror
            @if (session('error'))
            <div class="form-control-feedback col-sm-12 col-md-10 has-danger" > {{ session('error') }}
            </div>
            @endif
        </div>
        <div class="form-group">
            <label>Nom du niveau</label>
            <input class="form-control" type="text" placeholder="Entrer le nom du niveau" name="nom"
        value="{{ $niveau->nom }}">
            @error('nom')
            <div class="form-control-feedback col-sm-12 col-md-10 has-danger" >{{ $message }}
            </div>
            @enderror
        </div>
        {{-- <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" name="description"
                placeholder="Vous pouvez écrire une description et des notes pour vos étudiants"
                value="{{ $niveau->description }}">
            </textarea>
            @error('description')
            <div class="form-control-feedback col-sm-12 col-md-10 has-danger" >{{ $message }}
            </div>
            @enderror
        </div> --}}
        <button type="submit" class="btn btn-info" style="margin-left:88%;">
            <i class="icon-copy fa fa-edit" aria-hidden="true"></i> Modifier</button>
    </form>
</div>
@endsection
