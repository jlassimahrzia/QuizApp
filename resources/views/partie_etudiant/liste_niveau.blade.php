@extends('layouts.etudiant')
@section('content')
<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <br><br><br>
            <div class="title">
                <h4>Niveau</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/matiere_etudiant">Matiere</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Niveaux</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="faq-wrap">
    <h4 class="mb-20">Matiere : {{ $matiere->nom }}</h4>
    <div id="accordion">
        @if(count($niveaux ) > 0)
        <div class="card">
            <div class="card-header">
                <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#faq0">
                    Niveau : {{$niveaux[0]->nom }}
                </button>
            </div>
            <div id="faq0" class="collapse" data-parent="#accordion">
                <div class="card-body">
                    <strong>
                        <table>
                            @if(count($niveaux[0]->qcms ) > 0)
                            @foreach($niveaux[0]->qcms as $indice=>$qcm)
                            <tr>
                                <td>QCM {{++$indice}} :</td>
                                <td>&nbsp;&nbsp;</td>
                                <td>
                                    <a href="{{ route('qcm' ,$qcm->id )}}"
                                        style="text-decoration: none;color: #e83e8c;">
                                        {{ $qcm->nom }}
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </table>
                    </strong>
                </div>
            </div>
        </div>
        @endif
        @if(count($niveaux ) > 1)
        @for($i=1; $i<count($niveaux) ; $i++)
        <div class="card">
            <div class="card-header">
                <button class="btn btn-block collapsed" data-toggle="collapse" data-target="#faq{{$i}}">
                    Niveau : {{$niveaux[$i]->nom }}
                </button>
            </div>

            @php
                $is_succeed = false ;
                foreach($resultat_niveaux as $resultat){
                    if($niveaux[$i-1]->id == $resultat->niveau_id){
                        if($resultat->is_succeed == '1'){
                            $is_succeed = true ;
                        }
                    }
                }
                if(!$is_succeed)
                    {echo '<div id="faq'.$i.'" class="collapse" data-parent="#accordion" style="pointer-events: none;opacity: 0.4;"> </div>';}
                else
                   {
                    echo '<div id="faq'.$i.'" class="collapse" data-parent="#accordion">';
                        echo '<div class="card-body"><strong><table>';
                                if(count($niveaux[$i]->qcms ) > 0){
                                    foreach($niveaux[$i]->qcms as $indice=>$qcm){
                                        echo '
                                        <tr>
                                            <td>QCM '.++$indice.' :</td>
                                            <td>&nbsp;&nbsp;</td>
                                            <td>
                                                <a href="/get_qcm/'.$qcm->id.'" style="text-decoration: none;color: #e83e8c;">
                                                    '.$qcm->nom.'
                                                </a>
                                            </td>
                                        </tr>';
                                    }
                                }
                    echo'</table></strong></div></div>';}
                @endphp
            </div>
            @endfor
            @endif
    </div>
</div>
<div class="pd-20 bg-white border-radius-4 box-shadow mb-30" style="text-align: center">
    <div class="dropzone">
        <div class="fallback">
            <span>
                <a href="/resultat_matiere/{{ $matiere->id }}">
                    <i class="icon-copy fa fa-external-link" aria-hidden="true"></i> Voir Resultat
                </a>
            </span>
        </div>
    </div>
</div>

<br><br>
<a onclick="javascript:history.go(-1)" class="btn btn-warning"><i class="icon-copy fa fa-mail-reply"
        aria-hidden="true"></i>&nbsp;Retour</a>
@endsection
