@extends('layouts.app')
@section('head')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
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
                    <li class="breadcrumb-item"><a href="/qcm">QCM</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Modifier</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-6 col-sm-12 text-right">
            <div>
                <a class="btn" data-bgcolor="#1da1f2" data-color="#ffffff" onclick="javascript:history.go(-2)">
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
            <h4 class="text-blue">Modifier QCM </h4>
            <p class="mb-30 font-14"></p>
        </div>
    </div>
    <form method="post" action="{{ route('qcm.update',$qcm->id) }}">
        @method('PATCH')
        @csrf
        <div class="form-group">
            <label>Choisissez une matiére</label>
            <select class="custom-select2 form-control  @error('matiere') is-invalid @enderror" name="matiere" id="matiere" style="width: 100%; height: 38px;">
                <option value="{{$qcm->niveau->matiere_id}}" selected>{{$qcm->niveau->matiere->nom}}</option>
                @foreach ($matieres as $matiere)
                @if($matiere->id != $qcm->niveau->matiere_id)
                <option value="{{$matiere->id}}">{{$matiere->nom}}</option>
                @endif
                @endforeach
            </select>
            @error('matiere')
            <div class="form-control-feedback col-sm-12 col-md-10 has-danger">{{ $message }}
            </div>
            @enderror
            @if (session('error'))
            <div class="form-control-feedback col-sm-12 col-md-10 has-danger">
                {{ session('error') }}
            </div>
            @endif
        </div>
        <div class="form-group">
            <label>Choisissez un niveau</label>
            <select class="custom-select2 form-control @error('niveau') is-invalid @enderror" name="niveau" id="niveau" style="width: 100%; height: 38px;">
            <option value="{{$qcm->niveau_id}}" selected>{{$qcm->niveau->nom}}</option>
            @foreach ($qcm->niveau->matiere->niveaux as $niveau)
            @if($niveau->id != $qcm->niveau_id)
            <option value="{{$niveau->id}}">{{$niveau->nom}}</option>
            @endif
            @endforeach
            </select>
            @error('niveau')
            <div class="form-control-feedback col-sm-12 col-md-10 has-danger">{{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Choisissez la ou les classes</label>
            <select class="custom-select2 form-control @error('classes') is-invalid @enderror" multiple="multiple"
            name="classes[]" id="classes" style="width: 100%; height: 38px;">
            @foreach ($qcm->classes as $classe)
            <option value="{{$classe->id}}" selected>{{$classe->nom}}</option>
            @endforeach
            @foreach ($qcm->niveau->matiere->classes as $classe)
            @foreach ($qcm->classes as $c)
            @if($classe->id != $c->id)
            <option value="{{$classe->id}}">{{$classe->nom}}</option>
            @endif
            @endforeach
            @endforeach
            </select>
            @error('classes')
            <div class="form-control-feedback col-sm-12 col-md-10 has-danger">{{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Nom du QCM</label>
            <input class="form-control @error('nom') is-invalid @enderror" type="text" placeholder="Entrer le nom du QCM" name="nom"
            value="{{$qcm->nom}}">
            @error('nom')
            <div class="form-control-feedback col-sm-12 col-md-10 has-danger">{{ $message }}
            </div>
            @enderror
        </div>
        <div class="form-group">
            <label>Durée</label>
            <input class="form-control @error('duree') is-invalid @enderror" placeholder="Durée" type="number"
                    name="duree" value="{{$qcm->duree}}">
            @error('duree')
            <div class="form-control-feedback col-sm-12 col-md-10 has-danger">{{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-info" style="margin-left:89%;"><i
            class="icon-copy ion-ios-plus"></i> Modifier</button>
    </form>
</div>
@section('script')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {

        $('#matiere').on('change',function(e) {

         var matiere_id = e.target.value;

         $.ajax({

               url:"{{ route('classe_niveau') }}",
               type:"POST",
               data: {
                matiere_id: matiere_id
               },

               success:function (data) {

                $('#niveau').empty();
                $('#classes').empty();

                $.each(data.matiere[0].niveaux,function(index,niveau){

                    $('#niveau').append('<option value="'+niveau.id+'">'+niveau.nom+'</option>');
                });
                $.each(data.matiere[0].classes,function(index,classe){

                    $('#classes').append('<option value="'+classe.id+'">'+classe.nom+'</option>');
                });

               }
           });
        });

    });
</script>
@endsection
@endsection
