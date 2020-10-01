<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function qcm()
    {
        return $this->belongsTo('App\Qcm');
    }

    public function resultat(){
        return $this->hasMany('App\Resultat_question');
    }

}
