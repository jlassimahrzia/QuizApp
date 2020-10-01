<?php

use App\Http\Controllers\EtudiantController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Matiere;
use Symfony\Component\HttpKernel\Profiler\Profile;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/* Route::get('/welcome', function () {
    return view('welcome');
});
 */
/**
 * login page
 */
Route::get('/', function () {
    return view('auth.login');
});
Route::get('/home', function () {
    return view('home');
});
/**
 * Authentification
 */
Auth::routes();

/**
 * Enseignant
 */
Route::resource('enseignant', 'EnseignantController');

/**
 * Classe
 */
Route::resource('classe', 'ClasseController');

/**
 * Etudiant
 */
Route::resource('etudiant', 'EtudiantController');

/**
 * Matiére
 */
Route::resource('matiere', 'MatiereController');
Route::get('liste_etudiant/{id}','MatiereController@liste_etudiant');
/**
 * Niveau
 */
Route::resource('niveau', 'NiveauController');
Route::get('choisir_matiere','NiveauController@choisir_matiere');
Route::get('afficher_niveaux/{id}','NiveauController@afficher');
Route::get('get_niveau/{id}','NiveauController@get_niveau');
/**
 * QCM
 */
Route::resource('qcm', 'QcmController');
Route::post('/classe_niveau', function (Request $request) {

    $id = $request->matiere_id;

    $matiere = Matiere::where('id',$id)->with('niveaux','classes')->get();

    return response()->json([
        'matiere' => $matiere
    ]);

})->name('classe_niveau');
Route::post('/matiere_niveau', function (Request $request) {

    $id = $request->matiere_id;

    $matiere = Matiere::where('id',$id)->with('niveaux')->get();

    return response()->json([
        'matiere' => $matiere
    ]);

})->name('matiere_niveau');
Route::get('choisir_matiere_niveau','QcmController@choisir_matiere_niveau');
Route::get('afficher_qcm/{id}','QcmController@afficher');
Route::get('get_qcm/{id}','QcmController@get_qcm')->name('qcm');
// Resultat
Route::get('classe_resultat/{id}/{qcm_id}','QcmController@resultat_classe');
Route::get('resultat_etudiant/{id_qcm}/{id_etudiant}','QcmController@resultat_etudiant');
/**
 * Question
 */
Route::resource('question', 'QuestionController');
Route::get('/ajout_question/{id}', 'QuestionController@ajout_question')->name('ajout_question');
Route::get('/matiere_etudiant', 'MatiereController@matiere_by_class')->name('matiere_etudiant');

Route::post('store_question/{id}', 'QuestionController@store_question');
Route::get('/resultat/{id_qcm}/{id_etudiant}', 'QcmController@resultat');

/**
 * Profile
 */
Route::get('/profile_etudiant','EtudiantController@profile');
Route::get('/profile', function () {
    return view('profile');
});
Route::post('/update_profile/{id}', 'EtudiantController@update_profile')->name('update_profile');

/**
 * resultat matiére
 */

Route::get('/resultat_matiere/{id}', 'EtudiantController@resultat_matiere');
Route::get('/certificat/{id}', 'pdfController@printPDF');
