<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Question;
use App\Qcm;
use App\Resultat_qcm;
use App\Resultat_question;
use App\Resultat_niveau;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('question.ajout');
    }

    public function ajout_question($id)
    {
        $qcm = QCM::find($id);
        return view('question.ajout')->with('qcm', $qcm);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        switch ($request->input('action')) {
            case 'question':
                $validator = Validator::make($request->all(), [
                    'question' => ['required'],
                    'note' => ['required'],
                    'choix1' => ['required'],
                    'choix2' => ['required'],
                    'choix3' => ['required'],
                    'choix4' => ['nullable'],
                ]);
                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput($request->all());
                }

                $question = new Question;
                $question->question = $request->input('question');
                $question->note = $request->input('note');
                $question->choix1 = $request->input('choix1');
                $question->choix2 = $request->input('choix2');
                $question->choix3 = $request->input('choix3');
                if ($request->input('choix4') !== null) {
                    $question->choix4 = $request->input('choix4');
                    if ($request->has('reponse4')) {
                        $question->reponse4 = "vrai";
                    } else {
                        $question->reponse4 = "faux";
                    }
                }
                if ($request->has('reponse1')) {
                    $question->reponse1 = "vrai";
                } else {
                    $question->reponse1 = "faux";
                }
                if ($request->has('reponse2')) {
                    $question->reponse2 = "vrai";
                } else {
                    $question->reponse2 = "faux";
                }
                if ($request->has('reponse3')) {
                    $question->reponse3 = "vrai";
                } else {
                    $question->reponse3 = "faux";
                }
                $question->qcm_id = $request->input('id_qcm');
                $question->save();
                return Back();
                break;

            case 'fin':
                $questions = Question::where('qcm_id', $request->input('id_qcm'))->with('qcm')->get();
                $qcm = QCM::find($request->input('id_qcm'));
                return view('qcm.qcm', compact(['questions', 'qcm']));
                break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $qcm = QCM::find($id);
        return view('question.ajout')->with('qcm', $qcm);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::find($id);
        return view('question.update')->with('question', $question);
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
            'question' => ['required'],
            'note' => ['required'],
            'choix1' => ['required'],
            'choix2' => ['required'],
            'choix3' => ['required'],
            'choix4' => ['nullable'],
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput($request->all());
        }

        $question = Question::find($id);
        $question->question = $request->input('question');
        $question->note = $request->input('note');
        $question->choix1 = $request->input('choix1');
        $question->choix2 = $request->input('choix2');
        $question->choix3 = $request->input('choix3');
        if ($request->input('choix4') !== null) {
            $question->choix4 = $request->input('choix4');
            if ($request->has('reponse4')) {
                $question->reponse4 = "vrai";
            } else {
                $question->reponse4 = "faux";
            }
        }
        if ($request->has('reponse1')) {
            $question->reponse1 = "vrai";
        } else {
            $question->reponse1 = "faux";
        }
        if ($request->has('reponse2')) {
            $question->reponse2 = "vrai";
        } else {
            $question->reponse2 = "faux";
        }
        if ($request->has('reponse3')) {
            $question->reponse3 = "vrai";
        } else {
            $question->reponse3 = "faux";
        }
        $question->qcm_id = $request->input('id_qcm');
        $question->save();
        return Back()->with('success', 'Question mis à jour avec succés');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::find($id);
        $question->delete();
        return Back()->with('success', 'Question supprimée!');
    }

    public function store_question(Request $request, $id)
    {
        $answers = $request->data;
        $user = Auth::user();
        $qcm = Qcm::find($id);

        if (!empty($answers)) {
            foreach ($answers as $key => $answer) {
                $id_question = intval($key);
                $question = Question::find($id_question);
                $resultat = new Resultat_question();
                foreach ($answer as $a) {
                    if ($a === $question->choix1) {
                        $resultat->reponse1 = "vrai";
                    }
                    if ($a === $question->choix2) {
                        $resultat->reponse2 = "vrai";
                    }
                    if ($a === $question->choix3) {
                        $resultat->reponse3 = "vrai";
                    }
                    if ($question->choix4 !== null) {
                        if ($a === $question->choix4) {
                            $resultat->reponse4 = "vrai";
                        }
                    }
                }
                $resultat->question_id =  $question->id;
                $resultat->etudiant_id = $user->id;
                $resultat->save();
                $res = Resultat_question::find($resultat->id);
                $score = 0;
                if (($res->reponse1 === $question->reponse1)
                    && ($res->reponse2 === $question->reponse2)
                    && ($res->reponse3 === $question->reponse3)
                ) {
                    if ($question->choix4 !== null) {
                        if ($res->reponse4 === $question->reponse4) {
                            $score = $question->note;
                        }
                    } else {
                        $score = $question->note;
                    }
                }
                if ($score === $question->note) {
                    $res->is_correct = '1';
                }
                $res->score = $score;
                $res->save();
            }
        }
        foreach ($qcm->questions as $question) {
            $resultat_question = Resultat_question::where('question_id', '=', $question->id)->get();
            if (!isset($resultat_question[0])) {
                $resultat = new Resultat_question();
                $resultat->question_id =  $question->id;
                $resultat->etudiant_id = $user->id;
                $resultat->score = 0;
                $resultat->save();
            }
        }

        $resultat_qcm = new Resultat_qcm;
        $resultat_qcm->qcm_id = $id;
        $resultat_qcm->etudiant_id = Auth::user()->id;
        $score = 0;
        $note = 0;

        foreach ($qcm->questions as $question) {
            $resultat_questions = Resultat_question::where('etudiant_id', Auth::user()->id)->where('question_id', '=', $question->id)->first();
            $score += $resultat_questions->score;
        }
        foreach ($qcm->questions as $question) {
            $note += $question->note;
        }
        $resultat_qcm->score = $score;
        $resultat_qcm->is_done = '1';
        $pourcentage = $score * 100 / $note;
        if ($pourcentage > 70) {
            $resultat_qcm->is_succeeded = '1';
        }
        $resultat_qcm->pourcentage = $pourcentage;
        $resultat_qcm->save();

        $qcm = Qcm::find($id);
        $qcms = Qcm::where('niveau_id', '=', $qcm->niveau_id)->get();
        $ok = true;

        foreach ($qcms as $q) {
            $res = Resultat_qcm::where('qcm_id', '=', $q->id)->where('etudiant_id','=', Auth::user()->id)->first();
            if ($res->is_succeeded === '0') {
                $ok = false;
            }
        }

        $resultat_niveau = new Resultat_niveau;
        $resultat_niveau->niveau_id = $qcm->niveau_id;
        $resultat_niveau->etudiant_id = $user->id;
        if($ok) {
            $resultat_niveau->is_succeed = '1';
        } else if(!$ok) {
            $resultat_niveau->is_succeed = '0';
        }
        $resultat_niveau->save();
    }
}
