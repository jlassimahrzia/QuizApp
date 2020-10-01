@extends('layouts.etudiant')
@section('head')
<style>
    #box:hover {
        box-shadow: #d2edfd 0 0 5px 5px;
    }

    #box {
        box-shadow: #87CEFA 0 0 5px 5px;
    }

    .link {
        background: #40E0D0;
    }


    #par {
        padding-left: 200px;
    }
</style>
@endsection
@section('content')

<div class="page-header">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <br><br><br>
            <div class="title">
                <h4>Liste Des Matiéres</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/matiere">Matiére</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Afficher</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="product-wrap">
    <div class="blog-list">
        <ul>
            @php
            if(count($etudiant_matiere) > 0){
            foreach($etudiant_matiere as $matiere)
            { echo '<li>
                <div class="row no-gutters">
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="blog-img">
                            <img src="/storage/image/'.$matiere->photo.'" alt="" class="bg_img">
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12 col-sm-12">
                        <div class="blog-caption">
                            <h4><a href="#">Matiére : <span class="text-blue"> '.$matiere->nom.'</span></a></h4>';

                            $nbr1 = 0 ;
                            for($i=0 ; $i<count($matiere->niveaux) ;$i++){
                                foreach ($resultat_niveaux as $res) {
                                    if($res->niveau_id == $matiere->niveaux[$i]->id){
                                        $nbr1++;
                                    }
                                }
                            }

                            $nbr2 = count($matiere->niveaux) ;
                            $porcentage = $nbr1*100/$nbr2;

                            echo '<div class="progress">';
                                echo '<div class="progress-bar bg-info" role="progressbar"
                                    style="width:'.$porcentage.'%" aria-valuenow="25" aria-valuemin="0"
                                    aria-valuemax="100">'.number_format($porcentage, 2, '.', '').'%</div>';
                                echo '</div>';

                            echo '<div class="blog-by">
                                <p>'.$matiere->description.'</p>
                                <p> <span class="text-success"> <i class="ion-android-person"></i> Enseignant</span>
                                    '.$matiere->enseignant->nom.' '.$matiere->enseignant->prenom.'</p>
                                <p>Les classes : <code>';
                                foreach($matiere->classes as $classe)
                                {
                                    echo '<span class="badge badge-primary">'.$classe->nom.'</span>  ' ;
                                }
                                echo '</code></p>
                                <div class="pt-10">
                                    <a href="get_niveau/'.$matiere->id.'" class="btn btn-outline-primary">Voir
                                        Niveaux</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>';
            }}
            @endphp
        </ul>
    </div>
</div>
@section('script')
<script>
    calcul_pourcentage(matiere){

        return porcentage ;
    }
</script>
@endsection
@endsection
