<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Abonnee extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'type',
        'user_id',
        'etat',
        'date_fin',
    ];

    public function user () {
        return $this->belongsTo('App\Models\User');
    }

}
