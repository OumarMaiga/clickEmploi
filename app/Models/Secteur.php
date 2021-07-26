<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secteur extends Model
{
    use HasFactory;
    
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
    
    public function user() 
    {
        return $this->belongsTo('App\Models\User');
    }

    public function opportunites() {
        return $this->belongsToMany('App\Models\Opportunite');
    }


    public function users() {
        return $this->belongsToMany('App\Models\User');
    }

    public function activites() {
        return $this->belongsToMany('App\Models\Activite');
    }
}
