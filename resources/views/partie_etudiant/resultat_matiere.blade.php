@extends('layouts.etudiant')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <br><br><br>
            <div class="title">
                <h4>QCM</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/matiere_etudiant">Matiéres</a></li>
                    <li class="breadcrumb-item"><a href="/get_niveau/{{$matiere->id}}">Niveaux</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Resultat</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">

        {{-- <div class="invoice-header">
            <div class="logo text-center">
                <img src="{{ asset('vendors/images/quiz.png') }}" alt="">
            </div>
        </div> --}}
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <h4 class="mb-30 weight-600">Resultat matiére {{ $matiere->nom }}</h4>
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

        <div class="row pb-30">
            <div class="col-md-6">
                <h5 class="mb-15">Nom & Prenom</h5>
            <p class="font-14 mb-5">Date: <strong class="weight-600">
                {{$etudiant_resultat[count($etudiant_resultat)-1]->created_at->format('d/m/Y')}}
            </strong></p>{{--
                <p class="font-14 mb-5">Note: <strong class="weight-600">4556</strong></p> --}}
            </div>
            <div class="col-md-6">
                <div class="text-right">
                    <p class="font-14 mb-5">{{Auth::user()->nom}} {{Auth::user()->prenom}}</strong></p>
                    <p class="font-14 mb-5">{{Auth::user()->classe->nom}}</p>
                </div>
            </div>
        </div>
        <div class="invoice-desc pb-30">
            <div class="invoice-desc-footer">
                <div class="invoice-desc-head clearfix">
                    <div class="invoice-sub">Matiére</div>
                    <div class="invoice-rate">Enseignant</div>{{--
                    <div class="invoice-subtotal">Totale</div> --}}
                </div>
                <div class="invoice-desc-body">
                    <ul>
                        <li class="clearfix">
                            <div class="invoice-sub">
                                <p class="font-14 mb-5">Nombres Niveaux: <strong
                                        class="weight-600">{{ count($matiere->niveaux) }}</strong></p>
                            </div>
                            <div class="invoice-sub">{{ $matiere->enseignant->nom }} {{ $matiere->enseignant->prenom }}
                            </div>
                            {{-- <div class="invoice-subtotal">8000</div> --}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="invoice-desc pb-30">
            <div class="invoice-desc-head clearfix">
                <div class="invoice-sub">Niveau</div>
                <div class="invoice-rate">QCM</div>
                <div class="invoice-hours">Resultat</div>
                <div class="invoice-subtotal">Date</div>
            </div>
            @foreach ($etudiant_resultat as $resultat)
            <div class="invoice-desc-body">
                <ul>
                    <li class="clearfix">
                        <div class="invoice-sub">{{$resultat->qcm->niveau->nom}}</div>
                        <div class="invoice-rate">{{$resultat->qcm->nom}}</div>
                        <div class="invoice-hours">{{$resultat->pourcentage}}%</div>
                        <div class="invoice-subtotal"><span class="weight-600">{{$resultat->created_at->format('d/m/Y')}}</span></div>
                    </li>
                </ul>
            </div>
            @endforeach
        </div>
        <div class="pd-20 bg-white border-radius-4 box-shadow mb-30" style="text-align: center">
            <div class="dropzone">
                <div class="fallback">
                    @if($succeed==true)
                    <span>
                        <a href="/certificat/{{$matiere->id }}">
                            <i class="icon-copy fa fa-download" aria-hidden="true"></i> télécharger certificat
                        </a>
                    </span>
                    @else
                    <span data-toggle="tooltip"
                    title="Vous n'avez pas encore terminé la matiére ou bien vous n'avez pas la réussi">
                        <a style="pointer-events: none;">
                            <i class="icon-copy fa fa-download" aria-hidden="true"></i> télécharger certificat
                        </a>
                    </span>
                    @endif

                </div>
            </div>
        </div>
</div>
@endsection
