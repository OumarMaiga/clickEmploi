<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'libelle',
        'file_path',
        'opportunite_id',
        'user_id',
        'entreprise_id',
        'postule_id',
        'profil_id',
    ];
}
