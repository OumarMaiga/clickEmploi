<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secteur extends Model
{
    use HasFactory;
    
    public function user() 
    {
        return $this->belongsTo('App\Models\User');
    }
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'libelle',
        'user_id',
        'categorie',
        'slug',
    ];

    public function users() {
        return $this->belongsToMany('App\Models\User');
    }
}
