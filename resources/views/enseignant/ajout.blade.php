@extends('layouts.app')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">

            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/enseignant">Enseignant</a></li>
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
            <h4 class="text-blue"> Ajouter Enseignant</h4>
        </div>
        <br>
        <br>
    </div>
    <form method="post" action="{{ route('enseignant.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group row ">
            <label class="col-sm-12 col-md-2 col-form-label"><i class="icon-copy fa fa-user-circle"
                    aria-hidden="true"></i>&nbsp;Nom de famille</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control @error('nom') is-invalid @enderror"
                    placeholder="Entrer votre nom de famille" type="nom" name="nom"
                    value="{{ old('nom') }}" >
            </div>
            @error('nom')
            <div class="form-control-feedback col-sm-12 col-md-10 has-danger" style="padding-left: 18%">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label"><i class="icon-copy fa fa-user-circle-o"
                    aria-hidden="true"></i>&nbsp;Prénom</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control @error('prenom') is-invalid @enderror"
                    placeholder="Entrer votre prénom" type="nom" name="prenom" value="{{ old('prenom') }}">
            </div>
            @error('prenom')
            <div class="form-control-feedback col-sm-12 col-md-10 has-danger" style="padding-left: 18%">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label"><i class="icon-copy fa fa-envelope"
                    aria-hidden="true"></i>&nbsp;Email</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control  @error('email') is-invalid @enderror" placeholder="nom@example.com"
                    type="email" name="email" value="{{ old('email') }}">
            </div>
            @error('email')
            <div class="form-control-feedback col-sm-12 col-md-10 has-danger" style="padding-left: 18%">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label"><i class="icon-copy fa fa-lock"
                    aria-hidden="true"></i>&nbsp;Mot de passe</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control @error('password') is-invalid @enderror" type="password"
                    placeholder="*******" name="password" value="{{ old('password') }}">
            </div>
            @error('password')
            <div class="form-control-feedback col-sm-12 col-md-10 has-danger" style="padding-left: 18%">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">
                <i class="icon-copy fa fa-image" aria-hidden="true"></i>&nbsp;Photo</label>
            <div class="col-sm-12 col-md-10 form-group">
                <input class="form-control-file form-control height-auto @error('image') is-invalid @enderror" value="" name="image" type="file">
            </div>
            @error('image')
            <div class="form-control-feedback col-sm-12 col-md-10 has-danger" style="padding-left: 18%">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary" style="margin-left:89%;"><i class="icon-copy fa fa-user-plus"
                aria-hidden="true"></i>&nbsp;Ajouter</button>

    </form>

</div>
@endsection
