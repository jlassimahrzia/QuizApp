@extends('layouts.app')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Mettre à jour la matière</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/matiere">Matière</a></li>
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
            <h4 class="text-blue">Mettre à jour la matière : {{ $matiere->nom }}</h4>
            <p class="mb-30 font-14"></p>
        </div>
    </div>
    <form method="post" action="{{ route('matiere.update', $matiere->id) }}" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label>Choisir la ou les classes</label>
            <select class="custom-select2 form-control  @error('classes') is-invalid @enderror" multiple="multiple"
                style="width: 100%;" placeholder="Choisir la ou les classes" name="classes[]">
                @if(count($classes) > 0)
                @foreach( $classes as $classe)
                    @if (!($matiere->classes->contains($classe)))
                        <option value="{{ $classe->id }}">{{ $classe->nom }}</option>
                    @endif
                    @if ($matiere->classes->contains($classe))
                        <option {{ 'selected' }} value="{{ $classe->id }}">{{ $classe->nom }}</option>
                    @endif
                @endforeach
                @endif
            </select>
            @error('classes')
            <div class="form-control-feedback col-sm-12 col-md-10 has-danger">{{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Nom de la matière</label>
            <input class="form-control  @error('nom') is-invalid @enderror" type="text" placeholder="Entrer une matière"
                name="nom" value="{{ $matiere->nom }}">
            @error('nom')
            <div class="form-control-feedback col-sm-12 col-md-10 has-danger">{{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" name="description"
                placeholder="Vous pouvez écrire une description et des notes pour vos étudiants"
                value="{{ $matiere->description }}">
                {{ $matiere->description }}
            </textarea>
            @error('description')
            <div class="form-control-feedback col-sm-12 col-md-10 has-danger" >{{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Photo</label>
            <input class="form-control-file form-control height-auto @error('image') is-invalid @enderror" value=""
                    name="image" type="file">
            @error('image')
            <div class="form-control-feedback col-sm-12 col-md-10 has-danger" style="padding-left: 18%">{{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-info" style="margin-left:89%;">
            <i class="icon-copy fa fa-edit" aria-hidden="true"></i>&nbsp;Modifier</button>
    </form>
</div>
@endsection
