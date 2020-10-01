<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Classe;
class ClasseController extends Controller
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
        $classes = Classe::all();
        return view('classe.liste')->with('classes', $classes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('classe.ajout');
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
            'nom' => ['required','unique:classes']
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->all());
        }
        $classe = new Classe;
        $classe->nom = $request->input('nom');
        $classe->save();

        return redirect('/classe/create')->with('success', 'Classe crée avec succès');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $classe = Classe::find($id);
        return view('classe.liste_etudiant')->with('classe', $classe);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $classe = Classe::find($id);
        return view('classe.update', compact('classe'));
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
            'nom' => ['required','unique:classes',\Illuminate\Validation\Rule::unique('classes')->ignore($id)]
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->all());
        }
        $classe = Classe::find($id);
        $classe->nom = $request->input('nom');
        $classe->save();
        return back()->withInput()->with('success', 'Classe mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $classe = Classe::find($id);
        $classe->delete();
        return back()->with('success', 'Classe supprimé !');
    }
}
