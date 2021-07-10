<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
        'secteur_id',
        'user_id',
        'slug',
    ];

    public function secteur() {
        return $this->belongsTo('App\Models\Secteur');
    }

    public function users() {
        return $this->belongsToMany('App\Models\User');
    }
}
