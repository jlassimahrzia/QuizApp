@extends('layouts.app')
@section('content')
<div class="min-height-200px">
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>Classe</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/classe">Classe</a></li>
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
                <h4 class="text-blue">Entrer un Classe </h4>
                <p class="mb-30 font-14"></p>
            </div>
        </div>
        <form method="post" action="{{ route('classe.store') }}">
            @csrf
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Nom de Classe</label>
                <div class="col-sm-12 col-md-10">
                    <input class="form-control @error('nom') is-invalid @enderror" type="text"
                        placeholder="Entrer nom Classe" value="{{ old('nom') }}" name="nom">
                </div>
                @error('nom')
                <div class="form-control-feedback col-sm-12 col-md-10 has-danger" style="padding-left: 18%">
                    {{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-info" style="margin-left:89%;"><i class="icon-copy fa fa-plus-square"
                    aria-hidden="true"></i>&nbsp;Ajouter</button>

        </form>
    </div>
</div>
@endsection
