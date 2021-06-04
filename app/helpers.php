<?php

use App\Models\Entreprise;
use App\Models\File;
use App\Models\User;
use App\Models\Postule;

    function photo_entreprise($id) {

        $entreprise = Entreprise::findOrFail($id);
        
        if($entreprise == null){
            return false;
        }
        $file = new File;
        $file = $file->where('entreprise_id', $entreprise->id)->where('type', 'photo_entreprise')->orderBy('id', 'desc')->first();

        if ($file == null) {
            $file = false;
        } else {
            $file = $file->file_path;
        }

        return $file;
    }


    function voir_cv_postulant($id) {

        $postulant = Postule::findOrFail($id);
        
        if($postulant == null){
            return false;
        }
        $file = new File;
        $file = $file->where('postule_id', $postulant->id)->where('type', 'cv_opportunite')->first();
        
        if ($file == null) {
            $file = false;
        } else {
            $file = $file->file_path;
        }

        return $file;
    }
    
    
    function voir_cv_profil($id) {
        
        $user = User::findOrFail($id);
        
        if($user == null){
            return false;
        }
        $file = new File;
        $file = $file->where('profil_id', $user->id)->where('type', 'cv_profil')->orderBy('id', 'desc')->first();
        
        if ($file == null) {
            $file = false;
        } else {
            $file = $file->file_path;
        }

        return $file;
    }