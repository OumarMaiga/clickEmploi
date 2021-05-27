<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diplome extends Model
{
    use HasFactory;

    
    public function user() 
    {
        return $this->belongsTo('App\Models\User');
    }

    public function users() 
    {
        return $this->hasMany('App\Models\User');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'libelle',
        'user_id',
        'slug',
    ];
}
