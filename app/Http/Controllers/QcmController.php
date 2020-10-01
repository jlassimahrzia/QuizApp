<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Matiere;
use App\Niveau;
use App\Qcm;
use App\Classe;
use App\Question;
use App\Resultat_qcm;
use App\Resultat_question;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class QcmController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function choisir_matiere_niveau()
    {
        $enseignant_id = Auth::user()->id;
        $matieres = Matiere::where('enseignant_id', $enseignant_id)->get();
        return view('qcm.choisir_matiere_niveau')->with('matieres', $matieres);
    }
    public function afficher($id)
    {
        $enseignant_id = Auth::user()->id;
        $qcms = Qcm::where('niveau_id', $id)->with('niveau')->get();
        return view('qcm.liste')->with('qcms', $qcms);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $matieres = Matiere::where('enseignant_id', '=', $user->id)->get();
        return view('qcm.ajout')->with('matieres', $matieres);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'matiere' => ['required'],
            'niveau' => ['required'],
            'classes' => ['required'],
            'nom' => ['required'],
            'duree' => ['required']
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->all());
        }
        if ($request->input('matiere') === "null") {
            return back()->withInput()->with('error', 'Sélectionnez matiére');
        }
        $qcm = new Qcm;
        $qcm->nom = $request->input('nom');
        $qcm->duree = $request->input('duree');
        $qcm->niveau_id = $request->input('niveau');
        $qcm->save();
        $classes = Classe::find($request->get('classes'));
        $qcm->classes()->attach($classes);
        return redirect()->route('ajout_question', ['id' => $qcm->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $questions = Question::where('qcm_id', $id)->with('qcm')->get();
        $qcm = Qcm::find($id);
        return view('qcm.qcm', compact(['questions', 'qcm']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $qcm = Qcm::find($id);
        $matieres = Matiere::where('enseignant_id', '=', $user->id)->get();
        return view('qcm.update', compact(['matieres', 'qcm']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'matiere' => ['required'],
            'niveau' => ['required'],
            'classes' => ['required'],
            'nom' => ['required'],
            'duree' => ['required']
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->all());
        }
        if ($request->input('matiere') === "null") {
            return back()->withInput()->with('error', 'Sélectionnez matiére');
        }
        $qcm = Qcm::find($id);
        $qcm->nom = $request->input('nom');
        $qcm->duree = $request->input('duree');
        $qcm->niveau_id = $request->input('niveau');
        $qcm->save();
        $classes = Classe::find($request->get('classes'));
        $qcm->classes()->sync($classes);
        return back()->withInput()->with('success', 'QCM mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $qcm = Qcm::find($id);
        $qcm->delete();
        return Back()->with('success', 'QCM supprimée!');
    }

    // For student part
    public function get_qcm($id)
    {
        $qcm = Qcm::find($id);
        $user = Auth::user();
        $is_done = Resultat_qcm::where('qcm_id', '=', $id)->where('etudiant_id', '=', $user->id)->get();
        if (isset($is_done[0])) {
            return redirect("resultat_etudiant/$id/$user->id");
        }
        return view('partie_etudiant.test' , compact('qcm','user'));
    }

    /** faux */
    public function resultat($id_qcm,$id_etudiant)
    {
        $qcm = Qcm::find($id_qcm);
        $etudiant = User::find($id_etudiant);
        $resultat_qcm = Resultat_qcm::where('qcm_id', '=', $id_qcm)->where('etudiant_id', '=', $id_etudiant)->get();
        $questions = Question::where('qcm_id', '=', $id_qcm)->get();
        $resultat_questions = array();
        foreach($questions as $question){
            $resultat_question = Resultat_question::where('etudiant_id',$id_etudiant)->where('question_id','=',$question->id)->first();
            array_push($resultat_questions, $resultat_question);
        }
        return view('qcm.resultat_etudiant', compact('etudiant','qcm', 'question', 'resultat_qcm','resultat_questions'));
    }
    /** faux */

    public function resultat_classe($id,$qcm_id)
    {
        $classe = Classe::find($id);
        return view('qcm.liste_etudiant' , compact(['qcm_id' , 'classe']) );
    }

    public function resultat_etudiant($id_qcm,$id_etudiant){
        $qcm = Qcm::find($id_qcm);
        $etudiant = User::find($id_etudiant);
        $resultat_qcm = Resultat_qcm::where('qcm_id', '=', $id_qcm)->where('etudiant_id', '=', $id_etudiant)->get();
        $questions = Question::where('qcm_id', '=', $id_qcm)->get();
        $resultat_questions = array();
        foreach($questions as $question){
            $resultat_question = Resultat_question::where('etudiant_id',$id_etudiant)->where('question_id','=',$question->id)->first();
            array_push($resultat_questions, $resultat_question);
        }
        //return  $resultat_questions ;
        return view('partie_etudiant.resultat', compact('etudiant','qcm', 'question', 'resultat_qcm','resultat_questions'));
    }
}
