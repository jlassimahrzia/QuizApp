<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resultat_qcm extends Model
{
    protected $table = 'Resultat_qcms';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function etudiant()
    {
        return $this->belongsTo('App\User');
    }
    public function qcm()
    {
        return $this->belongsTo('App\Qcm');
    }
}
