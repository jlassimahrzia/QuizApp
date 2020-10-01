<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class classe extends Model
{
    protected $table = 'classes';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function etudiants()
    {
        return $this->hasMany('App\User');
    }

    public function matiéres()
    {
        return $this->belongsToMany(Matiere::class);
    }

    public function qcms()
    {
        return $this->belongsToMany(Qcm::class);
    }
}
