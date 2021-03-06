<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
        'domaine',
        'telephone',
        'slug',
        'email',
        'description',
        'date_creation',
        'adresse',
        'user_id',
    ];
    
    public function opportunites()
    {
        return $this->hasMany('App\Models\Opportunite');
    }

    public function files()
    {
        return $this->hasMany('App\Models\File');
    }
}
