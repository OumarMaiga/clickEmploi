<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Repositories\OpportuniteRepository;
use App\Models\Opportunite;

class OpportuniteController extends Controller
{
    protected $opportuniteRepository;

    public function __construct(OpportuniteRepository $opportuniteRepository) {
        $this->opportuniteRepository = $opportuniteRepository;
    }

    public function adresse($adresse) {
        $opportunites = Opportunite::where('lieu', 'like', "%$adresse%")->get()->sortByDesc('created_at');
        $nbre_offres = $opportunites->count();
        
        if (Auth::check()) {
            $domaine_par_profil = Auth::user()->secteurs()->pluck('id')->toArray();

            $dernier_diplome_user = Auth::user()->diplome()->associate(Auth::user()->dernier_diplome)->diplome;
            if($dernier_diplome_user) {
                $annee_etude = $dernier_diplome_user->annee_etude;         
            } else {
                $annee_etude = 0;
            }
            $offre_par_profil = Opportunite::where('lieu', $adresse)->whereHas('secteurs', function($q) use ($domaine_par_profil) {
                $q->whereIn('secteurs.id', $domaine_par_profil);
            })->join('diplomes', 'opportunites.niveau', 'diplomes.id')
                ->where('annee_etude', '<=', $annee_etude)
                
                ->get([
                    'opportunites.id as id',
                    'title',
                    'echeance',
                    'entreprise_id',
                    'lieu',
                    'type',
                    "opportunites.slug as slug",
                    "opportunites.annee_experience as annee_experience",
                    "opportunites.created_at as created_at",
                ])->sortByDesc('created_at');
        }else{
            $offre_par_profil = Opportunite::where('id', '0')->get();
        }

        if(Auth::check()) {
            $domaine_par_profil = Auth::user()->secteurs()->get();
        } else {
            $domaine_par_profil = null;
        }
        return view('pages.opportunites.opportunites', compact('opportunites', 'nbre_offres', 'adresse', 'offre_par_profil', 'domaine_par_profil'));
    }

    public function domaine($domaine) {
        $opportunites = Opportunite::whereHas('secteurs', function($q) use ($domaine) {
            $q->where('libelle', 'like', "%$domaine%");
        })->get()->sortByDesc('created_at');
        $nbre_offres = $opportunites->count();
        if (Auth::check()) {
            $domaine_par_profil = Auth::user()->secteurs()->pluck('id')->toArray();

            $dernier_diplome_user = Auth::user()->diplome()->associate(Auth::user()->dernier_diplome)->diplome;
            if($dernier_diplome_user) {
                $annee_etude = $dernier_diplome_user->annee_etude;         
            } else {
                $annee_etude = 0;
            }
            $offre_par_profil = Opportunite::whereHas('secteurs', function($q) use ($domaine_par_profil) {
                $q->whereIn('secteurs.id', $domaine_par_profil);
            })->join('diplomes', 'opportunites.niveau', 'diplomes.id')
                ->where('annee_etude', '<=', $annee_etude)
                ->get([
                    'opportunites.id as id',
                    'title',
                    'echeance',
                    'entreprise_id',
                    'lieu',
                    'type',
                    "opportunites.slug as slug",
                    "opportunites.annee_experience as annee_experience",
                    "opportunites.created_at as created_at",
                ])->sortByDesc('created_at');
        }else{
            $offre_par_profil = Opportunite::where('id', '0')->get();
        }
        if(Auth::check()) {
            $domaine_par_profil = Auth::user()->secteurs()->get();
        } else {
            $domaine_par_profil = null;
        }
        return view('pages.opportunites.opportunites', compact('opportunites', 'nbre_offres', 'domaine', 'offre_par_profil', 'domaine_par_profil'));
    }

    public function poste($poste) {
        $opportunites = Opportunite::where('title', 'like', "%$poste%")->get()->sortByDesc('created_at');
        $nbre_offres = $opportunites->count();
        if (Auth::check()) {
            $domaine_par_profil = Auth::user()->secteurs()->pluck('id')->toArray();

            $dernier_diplome_user = Auth::user()->diplome()->associate(Auth::user()->dernier_diplome)->diplome;
            if($dernier_diplome_user) {
                $annee_etude = $dernier_diplome_user->annee_etude;         
            } else {
                $annee_etude = 0;
            }
            $offre_par_profil = Opportunite::where('title', $poste)->whereHas('secteurs', function($q) use ($domaine_par_profil) {
                $q->whereIn('secteurs.id', $domaine_par_profil);
            })->join('diplomes', 'opportunites.niveau', 'diplomes.id')
                ->where('annee_etude', '<=', $annee_etude)
                ->get([
                    'opportunites.id as id',
                    'title',
                    'echeance',
                    'entreprise_id',
                    'lieu',
                    'type',
                    "opportunites.slug as slug",
                    "opportunites.annee_experience as annee_experience",
                    "opportunites.created_at as created_at",
                ])->sortByDesc('created_at');
        }else{
            $offre_par_profil = Opportunite::where('id', '0')->get();
        }
        
        if(Auth::check()) {
            $domaine_par_profil = Auth::user()->secteurs()->get();
        } else {
            $domaine_par_profil = null;
        }
        return view('pages.opportunites.opportunites', compact('opportunites', 'nbre_offres', 'poste', 'offre_par_profil', 'domaine_par_profil'));
    }

}
