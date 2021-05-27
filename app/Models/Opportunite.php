<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opportunite extends Model
{

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'poste',
        'slug',
        'content',
        'structure',
        'lieu',
        'duree',
        'niveau',
        'montant',
        'type_contrat',
        'annee_experience',
        'prerequis',
        'user_id',
        'type',
    ];

    public function user() 
    {
        return $this->belongsTo('App\Models\User');
    }
    
    public function users() 
    {
        return $this->hasMany('App\Models\User');
    }
    
}
