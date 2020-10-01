<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Matiere;
use App\Niveau;
use App\Qcm;
use App\Resultat_niveau;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class NiveauController extends Controller
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

    }

    public function choisir_matiere(){
        $enseignant_id = Auth::user()->id;
        $matieres = Matiere::where('enseignant_id',$enseignant_id)->get();
        return view('niveau.select_matiere')->with('matieres',$matieres);
    }

    public function afficher($id){
        $enseignant_id = Auth::user()->id;
        $niveaux = Niveau::where('matiere_id',$id)->with('matiere','qcms')->orderBy('numero', 'asc')->get();
        return view('niveau.liste')->with('niveaux', $niveaux);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $matieres = Matiere::where('enseignant_id','=',$user->id)->get();
        return view('niveau.ajout')->with('matieres', $matieres);
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
            'nom' => ['required'],
            'numero' => ['required'],
            'desciption' => ['nullable']
        ]);
        $existe = Niveau::where('matiere_id','=',$request->input('matiere'))->where('numero','=',$request->input('numero'))->get();
        if(isset($existe[0])){
            return back()->withInput()->with('error', 'Numéro existe déja');
        }
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->all());
        }
        $niveau = new Niveau;
        $niveau->nom = $request->input('nom');
        $niveau->numero = $request->input('numero');
        if($request->input('description')!==null){
            $niveau->Description = $request->input('description');
        }
        if($request->input('numero') === 1){
            $niveau->completed = '1' ;
        }
        $niveau->matiere_id = $request->input('matiere');
        $niveau->save();
        return redirect('/niveau/create')->with('success','Niveau ajouté avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $qcms = Qcm::where('niveau_id',$id)->with('niveau')->get();
        return view('qcm.liste')->with('qcms', $qcms);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $niveau = Niveau::find($id);
        $user = Auth::user();
        $matieres = Matiere::where('enseignant_id','=',$user->id)->get();
        return view('niveau.update', compact(['niveau','matieres']));
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
            'nom' => ['required'],
            'numero' => ['required'],
            'desciption' => ['nullable']
        ]);
        $niveau = Niveau::find($id);
        $existe = Niveau::where('matiere_id','=',$request->input('matiere'))->where('numero','=',$request->input('numero'))->get();
        $num = $request->input('numero') ;
        if(intval($num) != $niveau->numero)
        {
            if(isset($existe[0])){
                return back()->withInput()->with('error', 'Numéro existe déja');
            }
        }
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->all());
        }
        $niveau->nom = $request->input('nom');
        $niveau->numero = $request->input('numero');
        $niveau->matiere_id = $request->input('matiere');
        $niveau->save();
        return back()->withInput()->with('success','Niveau mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $niveau = Niveau::find($id);
        $niveau->delete();
        return back()->with('success','Matiére supprimé ainsi que tous les niveaux et les qcms qu\'il appartient');
    }

    // For student part
    public function get_niveau($id){
        $niveaux = Niveau::where('matiere_id','=',$id)->orderBy('numero', 'asc')->get() ;
        $matiere = Matiere::find($id);
        $user = Auth::user();
        $resultat_niveaux = Resultat_niveau::where('etudiant_id','=',$user->id)->get();
        return view('partie_etudiant.liste_niveau' , compact(['niveaux','matiere','resultat_niveaux']));
    }

}
