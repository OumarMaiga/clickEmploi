<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'telephone',
        'adresse',
        'email',
        'password',
        'nom', 
        'prenom', 
        'date_naissance',
        'type',
        'etat',
        'dernier_diplome',
        'annee_experience',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function activites() {
        return $this->belongsToMany('App\Models\Activite');
    }

    public function secteurs() {
        return $this->belongsToMany('App\Models\Secteur');
    }
    
    public function opportunites() 
    {
        return $this->hasMany('App\Models\Opportunite');
    }
    
    public function diplome() 
    {
        return $this->belongsTo('App\Models\Diplome');
    }

    public function abonnee()
    {
        return $this->hasOne('App\Models\Abonnee');
    }
    
}
