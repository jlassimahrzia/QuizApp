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
                    <li class="breadcrumb-item"><a href="">Niveau</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Afficher</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
    <div class="clearfix">
        <div class="pull-left">
            <h4 class="text-blue">Niveau</h4>
            <p class="mb-30 font-14"></p>
        </div>
    </div>
    <div class="form-group">
        <label>Choisissez une Matière</label>
        <a class="btn btn-outline-primary dropdown-toggle" role="button" data-toggle="dropdown" style="width: 100%;">
            Liste Matières
        </a>
        <div class="dropdown-menu dropdown-menu-right" style="width: 75.5%;">
            @if(count($matieres) > 0)
            @foreach($matieres as $matiere)
            <a class="dropdown-item" href="/afficher_niveaux/{{$matiere->id}}" data-toggle="tooltip" title="Voir Niveaux">
                {{ $matiere->nom }}
            </a>
            @endforeach
            @endif
        </div>
    </div>
</div>

@endsection
