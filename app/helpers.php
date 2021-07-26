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
            $file = $file;
        }

        return $file;
    }
    
    //Personnalisation du format de la date
    function custom_date($date) {
        $today = date('Y-m-d');
        $this_year = date('Y');
        $this_month = date('m');
        $hier = date('d') - 1;
        $aujoudhui = date('d');
        $demain = date('d') + 1;
        $mois = ['', 'Jan', 'Fev', 'Mars', 'Avr', 'Mai', 'Juin', 'Juillet', 'Août', 'Sept', 'Oct', 'Nov', 'Dec'];

        if ($today == $date->format('Y-m-d')) {
            $result = "Aujourd'hui ".$date->format('H:i');
        } elseif($this_year == $date->format('Y')) {
            if ($date->format('d') == $hier && $date->format('m') == $this_month) {
                $result = "Hier";
            }elseif($date->format('d') == $demain && $date->format('m') == $this_month){
                $result = "Demain";
            }else{
                $result = $date->format('d')." ".$mois[$date->format('n')];
            }
        }else {
            $result = $date->format('d')." ".$mois[$date->format('n')]." ".$date->format('Y');
        }
        return $result;
        
    }

    function photo_profil($email) {
        
        $user = User::where('email', $email)->first();
        
        if($user == null){
            return false;
        }
        $file = new File;
        $file = $file->where('user_id', $user->id)->where('type', 'photo_profil')->orderBy('id', 'desc')->first();
        
        if ($file == null) {
            $file = false;
        } else {
            $file = $file->file_path;
        }

        return $file;
    }