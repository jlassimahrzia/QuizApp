<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resultat_question extends Model
{
    protected $table = 'resultat_questions';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function etudiant()
    {
        return $this->belongsTo('App\User');
    }
    public function question()
    {
        return $this->belongsTo('App\Question');
    }
}
