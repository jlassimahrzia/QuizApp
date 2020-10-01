@extends('layouts.app')
@section('head')
<style>
    #for {
        margin-right: 100px;
        margin-left: -150px;
    }
</style>
@endsection
@section('content')
<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
    <div class="clearfix mb-20">
        <div class="pull-left">
        <h4 class="text-blue">Resultat {{ $etudiant->nom }} {{ $etudiant->prenom}}</h4>
            <p> Qcm :<code> {{$qcm->nom}}</code> </p>
        </div>
        <div class="pull-right">
            <div>
                <a class="btn" data-bgcolor="#1da1f2" data-color="#ffffff"
                onclick="javascript:history.go(-1)"
                {{-- href="{{  URL::previous() }}" --}}>
                    <i class="icon-copy fa fa-angle-double-left" aria-hidden="true"></i>
                    Retour</a>
            </div>
        </div>
    </div>
</div>
<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
    <div class="table-responsive">
        <table class="table">
            <tbody>
                @if($resultat_qcm[0]->is_succeeded === '1')
                <tr class="table-success">
                    <th scope="row">Succès</th>
                    <td>{{$resultat_qcm[0]->pourcentage}}% toutes nos félicitations</td>
                </tr>
                @elseif($resultat_qcm[0]->is_succeeded === '0')
                <tr class="table-danger">
                    <th scope="row">Échouer</th>
                    <td>{{$resultat_qcm[0]->pourcentage}}% Il faut avoir minimum 70%</td>
                </tr>
                @endif
                <tr class="table-info">
                    <th scope="row">Date</th>
                    <td>{{$resultat_qcm[0]->created_at}}</td>
                </tr>
                <tr class="table-warning">
                    <th scope="row">Note</th>
                    <td><span class="badge badge-info">{{$resultat_qcm[0]->score}}</span></td>
                </tr>
                {{-- <tr class="table-info">
                    <th scope="row">Durée</th>
                    <td>0:40 min</td>
                </tr> --}}
            </tbody>
        </table>
    </div>
    <hr>
    <br>
    <h5 style="color:#CD5C5C;"><b>Les questions et les réponses</b></h5>
    <br>
    @if(count($qcm->questions) > 0)
    @foreach($qcm->questions as $indice=>$question)
    <div class="table-responsive">
        <table class="table">
            <tbody>
                @if($resultat_questions[$indice]->is_correct === '0')
                <tr class="table-danger">
                    <th scope="row" width="20%">Question
                        @php $i = $indice + 1 ; echo $i ; @endphp:</th>
                    <td width="80%">{{$question->question}}?</td>
                </tr>
                @elseif($resultat_questions[$indice]->is_correct == "1")
                <tr class="table-success">
                    <th scope="row" width="20%">Question @php $i = $indice + 1 ; echo $i ; @endphp :</th>
                    <td width="80%">{{$question->question}}?</td>
                </tr>
                @endif
                <tr class="table-warning">
                    <th scope="row">Note</th>
                    <td><span class="badge badge-info">{{$resultat_questions[$indice]->score}}</span></td>
                </tr>
                <tr class="table-primary">
                    <th scope="row" width="20%">Options :</th>
                    <td width="80%">
                        <ul>
                            <li><span class="badge badge-info">A </span>
                                {{$question->choix1}}</li>
                            <li><span class="badge badge-info">B </span>
                                {{$question->choix2}}</li>
                            <li> <span class="badge badge-info">C </span>
                                {{$question->choix3}}</li>
                            @if($question->choix4 !== null)
                            <li> <span class="badge badge-info">D </span>
                                {{$question->choix3}}</li>
                            @endif
                        </ul>
                    </td>
                </tr>
                <tr class="table-info">
                    <th scope="row" width="20%"> Ta réponse :</th>
                    <td width="80%">
                        @if($resultat_questions[$indice]->reponse1 === "vrai")
                        <span class="badge badge-danger">A</span>
                        @endif
                        @if($resultat_questions[$indice]->reponse2 === "vrai")
                        <span class="badge badge-danger">B</span>
                        @endif
                        @if($resultat_questions[$indice]->reponse3 === "vrai")
                        <span class="badge badge-danger">C</span>
                        @endif
                        @if($question->choix4 !== null)
                        @if($resultat_questions[$indice]->reponse4 === "vrai")
                        <span class="badge badge-danger">D</span>
                        @endif
                        @endif
                    </td>
                </tr id="bleu">
                <tr class="table-primary">
                    <th scope="row" width="20%"> La réponse correcte :</th>
                    <td width="80%">
                        @if($question->reponse1 === "vrai")
                        <span class="badge badge-success">A</span>
                        @endif
                        @if($question->reponse2 === "vrai")
                        <span class="badge badge-success">B</span>
                        @endif
                        @if($question->reponse3 === "vrai")
                        <span class="badge badge-success">C</span>
                        @endif
                        @if($question->choix4 !== null)
                        @if($question->reponse4 === "vrai")
                        <span class="badge badge-success">D</span>
                        @endif
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <br><br>
    @endforeach
    @endif
</div>
<!-- Contextual classes End -->
</div>
@endsection
