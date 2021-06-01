<?php

use App\Models\Entreprise;
use App\Models\File;
    
    function photo_entreprise($id) {

        $entreprise = Entreprise::findOrFail($id);
        
        if($entreprise == null){
            return false;
        }
        $file = new File;
        $file = $file->where('entreprise_id', $entreprise->id)->orderBy('id', 'desc')->first();

        if ($file == null) {
            $file = false;
        } else {
            $file = $file->file_path;
        }

        return $file;
    }

