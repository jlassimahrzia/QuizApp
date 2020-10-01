<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Niveau extends Model
{
    protected $table = 'niveaux';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function matiere()
    {
        return $this->belongsTo('App\Matiere');
    }


    public function qcms()
    {
        return $this->hasMany('App\Qcm');
    }

    public function resultat()
    {
        return $this->hasMany('App\Resultat_niveau');
    }
}

