<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classe;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\User;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Matiere;
use App\Niveau;
use App\Resultat_qcm;
use App\Resultat_niveau;
class EtudiantController extends Controller
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
        $etudiants = User::where('role','3')->get();
        return view('etudiant.liste')->with('etudiants', $etudiants);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Classe::all();
        return view('etudiant.ajout')->with('classes', $classes);
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
            'classe' => ['required'],
            'nom' => ['required'],
            'prenom' => ['required'],
            'email' => ['email','unique:users','required'],
            'password' => ['required'],
            'image' => ['image','nullable','max:1999']
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->all());
        }
        // Handle File Upload
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

        } else {
            $fileNameToStore = 'avatar.jpg';
        }

        // Create Post
        $etudiant = new User;
        $etudiant->nom = $request->input('nom');
        $etudiant->prenom = $request->input('prenom');
        $etudiant->email = $request->input('email');
        $etudiant->password = Hash::make($request->input('password'));
        $etudiant->photo = $fileNameToStore;
        $etudiant->role = "3";
        $etudiant->classe_id = $request->input('classe');
        $etudiant->save();

        return redirect('/etudiant/create')->with('success', 'Etudiant crée avec succès');
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
        $etudiant = User::find($id);
        $classes = Classe::all();
        return view('etudiant.update', compact(['etudiant','classes']));
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
            'nom' => ['required'],
            'prenom' => ['required'],
            'email' => ['email','required',\Illuminate\Validation\Rule::unique('users')->ignore($id)],
            'new_password' => ['nullable'],
            'old_password' => ['nullable'],
            'image' => ['image','nullable','max:1999']
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->all());
        }
        $etudiant = User::find($id);
        if($request->input('old_password')!==null){
            if(!password_verify($request->input('old_password'), $etudiant->password)){
                return back()->withInput()->with('error', 'mot de passe incorrecte');
            }
        }
         // Handle File Upload
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
            Storage::delete('public/image/'.$etudiant->photo);
        }
        // Update etudiant
        $etudiant->nom = $request->input('nom');
        $etudiant->prenom = $request->input('prenom');
        $etudiant->email = $request->input('email');
        $etudiant->classe_id = $request->input('classe');
        if($request->input('new_password')!==null){
            $etudiant->password = Hash::make($request->input('new_password'));
        }
        if($request->hasFile('image')){
            $etudiant->photo = $fileNameToStore;
        }
        $etudiant->save();
        return back()->withInput()->with('success', 'Etudiant mis à jour avec succès');
    }

    public function update_profile(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nom' => ['required'],
            'prenom' => ['required'],
            'email' => ['email','required',\Illuminate\Validation\Rule::unique('users')->ignore($id)],
            'new_password' => ['nullable'],
            'old_password' => ['nullable'],
            'image' => ['image','nullable','max:1999']
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->all());
        }
        $etudiant = User::find($id);
        if($request->input('old_password')!==null){
            if(!password_verify($request->input('old_password'), $etudiant->password)){
                return back()->withInput()->with('error', 'mot de passe incorrecte');
            }
        }
         // Handle File Upload
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
            if($etudiant->photo!=="avatar.jpg"){
                Storage::delete('public/image/'.$etudiant->photo);
            }
        }
        // Update etudiant
        $etudiant->nom = $request->input('nom');
        $etudiant->prenom = $request->input('prenom');
        $etudiant->email = $request->input('email');
        $etudiant->classe_id = $request->input('classe');
        if($request->input('new_password')!==null){
            $etudiant->password = Hash::make($request->input('new_password'));
        }
        if($request->hasFile('image')){
            $etudiant->photo = $fileNameToStore;
        }
        $etudiant->save();
        return back()->withInput()->with('success', 'Votre profil mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $etudiant = User::find($id);
        if($etudiant->photo !== 'avatar.jpg'){
            // Delete Image
            Storage::delete('public/image/'.$etudiant->photo);
        }
        $etudiant->delete();
        return back()->with('success', 'Etudiant supprimé !');
    }

    public function profile(){
        $user = Auth::user();
        $etudiant_resultat= Resultat_qcm::where('etudiant_id','=',$user->id)->with('qcm','qcm.niveau','qcm.niveau.matiere')->orderBy('created_at', 'desc')->get();
        return view('partie_etudiant.profile')->with('etudiant_resultat',$etudiant_resultat);
    }

    public function resultat_matiere($id){
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
        $succeed = true ;
        foreach($matiere->niveaux as $niveau){
            $resultat_niveaux = Resultat_niveau::where('etudiant_id','=',$user->id)->where('niveau_id','=',$niveau->id)->first();
            if(isset($resultat_niveaux)){
                if($resultat_niveaux->is_succeed == '0'){
                    $succeed = false ;
                }
            }
            else {
                $succeed = false ;
            }
        }
        return view('partie_etudiant.resultat_matiere',compact(['matiere','etudiant_resultat','succeed']));
    }
}
