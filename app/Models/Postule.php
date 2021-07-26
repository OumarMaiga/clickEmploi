<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postule extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'motivation',
        'user_id',
        'opportunite_id',
    ];
}
