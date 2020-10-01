<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF ;
use App\Matiere;
use App\Resultat_qcm;
use Illuminate\Support\Facades\Auth;
class pdfController extends Controller
{
    public function printPDF($id)
    {
       // This  $data array will be passed to our PDF blade
        $matiere = Matiere::find($id);
        $user = Auth::user();
        $etudiant_resultat = array();
        foreach($matiere->niveaux as $niveau){
            foreach($niveau->qcms as $qcm){
                $resultat= Resultat_qcm::where('etudiant_id','=',$user->id)->where('qcm_id','=',$qcm->id)->with('qcm','qcm.niveau')->get();
                if(isset($resultat[0])){
                    array_push($etudiant_resultat, $resultat[0]);
                }
            }
        }
        $data = [
          'matiere' => $matiere,
          'date' => $etudiant_resultat[count($etudiant_resultat)-1]->created_at
        ];
        $pdf = PDF::loadView('certificat', $data);
        return $pdf->download('certificat.pdf');
    }
}
