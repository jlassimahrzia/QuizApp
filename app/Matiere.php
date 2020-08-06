<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    protected $table = 'matieres';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function enseignant()
    {
        return $this->belongsTo('App\User');
    }

    public function classes()
    {
        return $this->belongsToMany(Classe::class, 'classe_matiere');
    }

    public function niveaux()
    {
        return $this->hasMany('App\Niveau');
    }

}
