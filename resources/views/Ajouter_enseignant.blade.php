@extends('layouts.app')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">

            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Ajouter</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Enseignant</li>
                </ol>
            </nav>
        </div>

    </div>
</div>
<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
    <div class="clearfix">
        <div class="pull-left">
            <h4 class="text-blue"> Ajouter Enseignant</h4>
        </div>
        <br>
        <br>
    </div>
    <form>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label"><i class="icon-copy fa fa-user-circle"
                    aria-hidden="true"></i>&nbsp;Nom de famille</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" placeholder="s'li vous plais entrer votre nom de famille" type="nom">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label"><i class="icon-copy fa fa-user-circle-o"
                    aria-hidden="true"></i>&nbsp;Prénom</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" placeholder="s'li vous plais entrer votre prénom de famille" type="nom">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label"><i class="icon-copy fa fa-envelope"
                    aria-hidden="true"></i>&nbsp;Email</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" value="nom@example.com" type="email">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label"><i class="icon-copy fa fa-lock"
                    aria-hidden="true"></i>&nbsp;Mot de passe</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" value="" type="password" placeholder="*******">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label"><i class="icon-copy fa fa-address-book"
                    aria-hidden="true"></i>&nbsp;Photo</label>
            <div class="col-sm-12 col-md-10 form-group">
                <input class="form-control-file form-control height-auto" value="" name="image" type="file">
            </div>
        </div>

        <button type="button" class="btn btn-primary" style="margin-left:89%;"><i class="icon-copy fa fa-user-plus"
                aria-hidden="true"></i>&nbsp;Ajouter</button>

    </form>

</div>
@endsection
