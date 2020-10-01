<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qcm extends Model
{
    protected $table = 'qcms';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function niveau()
    {
        return $this->belongsTo('App\Niveau');
    }

    public function questions()
    {
        return $this->hasMany('App\Question');
    }

    public function resultat()
    {
        return $this->hasMany('App\Resultat_qcm');
    }

    public function classes()
    {
        return $this->belongsToMany(Classe::class);
    }
}
