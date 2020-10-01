<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\User;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\Types\Null_;
use Illuminate\Support\Facades\Validator;

class EnseignantController extends Controller
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
        $enseignants = User::where('role','2')->get();
        return view('enseignant.liste')->with('enseignants', $enseignants);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('enseignant.ajout');
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
        $enseignant = new User;
        $enseignant->nom = $request->input('nom');
        $enseignant->prenom = $request->input('prenom');
        $enseignant->email = $request->input('email');
        $enseignant->password = Hash::make($request->input('password'));
        $enseignant->photo = $fileNameToStore;
        $enseignant->role = "2";
        $enseignant->save();

        return redirect('/enseignant/create')->with('success', 'Enseignant crée avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $enseignant = User::find($id);
        return view('enseignant.update', compact('enseignant'));
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
        $enseignant = User::find($id);
        if($request->input('old_password')!==null){
            if(!password_verify($request->input('old_password'), $enseignant->password)){
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
            if($enseignant->photo!=='avatar.jpg'){
                Storage::delete('public/image/'.$enseignant->photo);
            }
        }
        // Update enseignant
        $enseignant->nom = $request->input('nom');
        $enseignant->prenom = $request->input('prenom');
        $enseignant->email = $request->input('email');
        if($request->input('new_password')!==null){
            $enseignant->password = Hash::make($request->input('new_password'));
        }
        if($request->hasFile('image')){
            $enseignant->photo = $fileNameToStore;
        }
        $enseignant->save();
        return back()->withInput()->with('success', 'Enseignant mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $enseignant = User::find($id);
        if($enseignant->photo !== 'avatar.jpg'){
            // Delete Image
            Storage::delete('public/image/'.$enseignant->photo);
        }
        $enseignant->delete();
        return back()->with('success', 'Enseignant supprimé !');
    }
}
