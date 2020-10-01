@extends('layouts.app')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <div class="title">
                <h4>Matière</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/matiere">Matière</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ajouter</li>
                </ol>
            </nav>
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
            <h4 class="text-blue">Entrer une matière</h4>
            <p class="mb-30 font-14"></p>
        </div>
    </div>
    <form method="post" action="{{ route('matiere.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Choisir la ou les classes</label>
            <select class="custom-select2 form-control  @error('classes') is-invalid @enderror" multiple="multiple" style="width: 100%;"
            placeholder="Choisir la ou les classes" name="classes[]">
                @if(count($classes) > 0)
                @foreach($classes as $classe)
                <option value="{{ $classe->id }}">{{ $classe->nom }}</option>
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
            <input class="form-control  @error('nom') is-invalid @enderror" type="text" placeholder="Entrer une matière" name="nom">
            @error('nom')
            <div class="form-control-feedback col-sm-12 col-md-10 has-danger">{{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" name="description"
                placeholder="Vous pouvez écrire une description et des notes pour vos étudiants">
            </textarea>
            @error('description')
            <div class="form-control-feedback col-sm-12 col-md-10 has-danger" >{{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">
                <i class="icon-copy fa fa-image" aria-hidden="true"></i>&nbsp;Photo</label>
            <div class="col-sm-12 col-md-10 form-group">
                <input class="form-control-file form-control height-auto @error('image') is-invalid @enderror" value=""
                    name="image" type="file">
            </div>
            @error('image')
            <div class="form-control-feedback col-sm-12 col-md-10 has-danger" style="padding-left: 18%">{{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-info" style="margin-left:90%;"><i class="icon-copy fa fa-plus-square"
                aria-hidden="true"></i>&nbsp;Ajouter</button>
    </form>
</div>
@endsection
