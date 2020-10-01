<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom' , 'prenom' , 'email', 'password', 'photo' , 'role' , 'classe_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function classe()
    {
        return $this->belongsTo('App\Classe');
    }

    public function matiere(){
        return $this->hasMany('App\Matiere');
    }

    public function resultat_qcm()
    {
        return $this->hasMany('App\Resultat_qcm','etudiant_id');
    }

    public function resultat_niveau()
    {
        return $this->hasMany('App\Resultat_niveau','etudiant_id');
    }

    public function resultat_question(){
        return $this->hasOne('App\Resultat_question');
    }
}

