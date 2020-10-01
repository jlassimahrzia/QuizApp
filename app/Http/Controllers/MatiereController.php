<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classe;
use App\Matiere;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Resultat_niveau ;
class MatiereController extends Controller
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
        $enseignant_id = Auth::user()->id;
        $matieres = Matiere::where('enseignant_id', $enseignant_id)->with('enseignant', 'classes', 'niveaux')->get();
        return view('matiere.liste')->with('matieres', $matieres);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Classe::all();
        return view('matiere.ajout')->with('classes', $classes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'nom' => ['required'],
            'classes' => ['required'],
            'description' => ['required'],
            'image' => ['image', 'nullable', 'max:1999']
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->all());
        }
        // Handle File Upload
        if ($request->hasFile('image')) {
            // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('image')->storeAs('public/image', $fileNameToStore);
        } else {
            $fileNameToStore = 'quiz.jpg';
        }
        $matiere = new Matiere;
        $matiere->nom = $request->input('nom');
        $matiere->enseignant_id = $user->id;
        $matiere->photo = $fileNameToStore;
        $matiere->description = $request->input('description');
        $matiere->save();
        $classes = Classe::find($request->get('classes'));
        $matiere->classes()->attach($classes);
        return redirect('/matiere/create')->with('success', 'Matière crée avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $matiere = Matiere::find($id);
        $classes = Classe::all();
        return view('matiere.update', compact('matiere', 'classes'));
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
        $user = Auth::user();
        $matiere = Matiere::find($id);
        $validator = Validator::make($request->all(), [
            'nom' => ['required'],
            'classes' => ['required'],
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->all());
        }
        if($request->hasFile('image')){
            // Get filename with the extension
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('image')->storeAs('public/image', $fileNameToStore);
            // Delete file if exists
            if($matiere->photo !=="quiz.jpg"){
                Storage::delete('public/image/'.$matiere->photo);
            }
        }

        $matiere->nom = $request->input('nom');
        $matiere->enseignant_id = $user->id;
        $matiere->description = $request->input('description');
        if($request->hasFile('image')){
            $matiere->photo = $fileNameToStore;
        }
        $matiere->save();
        $classes = Classe::find($request->get('classes'));
        $matiere->classes()->sync($classes);
        return back()->withInput()->with('success', 'Matière mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $matiere = Matiere::find($id);
        foreach ($matiere->classes as $classe) {
            $matiere->classes()->detach($classe);
        }
        $matiere->delete();
        return back()->with('success', 'Matiére supprimé ainsi que tous les niveaux et les qcms qu\'il appartient');
    }

    public function liste_etudiant($id)
    {
        $classe = Classe::find($id);
        return view('matiere.liste_etudiant')->with('classe', $classe);
    }

    public function matiere_by_class(){
        $user = Auth::user();
        $classe_user = $user->classe_id;
        $matieres = Matiere::with('niveaux','niveaux.resultat')->get();
        $etudiant_matiere = array();
        //array_push($etudiant_matiere, 13);
        foreach($matieres as $matiere) {
            foreach($matiere->classes as $classe) {
                if($classe->id==$classe_user){
                    array_push($etudiant_matiere, $matiere);
                }
            }
        }
        $resultat_niveaux = Resultat_niveau::where('etudiant_id','=',$user->id)->get();
        //return $etudiant_matiere ;
        return view('partie_etudiant.liste_matiere', compact ('etudiant_matiere','user','resultat_niveaux'));
    }
}
