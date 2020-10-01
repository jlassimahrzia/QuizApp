<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resultat_niveau extends Model
{
    protected $table = 'Resultat_niveau';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function etudiant()
    {
        return $this->belongsTo('App\User');
    }
    public function niveau()
    {
        return $this->belongsTo('App\Niveau');
    }
}
