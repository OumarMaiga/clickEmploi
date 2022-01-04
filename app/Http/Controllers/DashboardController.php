<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Opportunite;
use App\Models\Postule;
use App\Models\Abonnee;
use App\Models\Diplome;
use App\Models\Secteur;
use App\Models\Activite;

class DashboardController extends Controller
{
    public function __construct() {
        $this->middleware('adminAndPartenaireOnly', ['only' => ['index']]);
    }
    public function index()
    {
        switch (Auth::user()->type) {
            case 'admin':
                $nbre_users = User::where('type', 'user')->where('etat', true)->get()->count();
                $nbre_partenaires = User::where('type', 'partenaire')->where('etat', true)->get()->count();
                $nbre_abonnees = Abonnee::where('date_fin', '>=', NOW())->where('etat', true)->get()->count();
                $nbre_offres_en_cours = Opportunite::where('echeance', '>=', NOW())->get()->count();
                $mes_offres = Opportunite::where('user_id', Auth::user()->id)->get();
                return view('dashboards.index', compact('nbre_users', 'nbre_offres_en_cours', 'nbre_abonnees', 'nbre_partenaires', 'mes_offres'));
                break;
            
            case 'partenaire':
                $nbre_mes_offres = Opportunite::where('user_id', Auth::user()->id)->get()->count();
                $nbre_postulants = Postule::join('opportunites', 'opportunites.id', 'postules.opportunite_id')
                                            ->where('postules.opportunite_id', 'opportunites.id')->where('opportunites.user_id', Auth::user()->id)->get()->count();
                $nbre_mes_offres_en_cours = Opportunite::where('echeance', '>=', NOW())->get()->count();
                $mes_offres = Opportunite::where('user_id', Auth::user()->id)->get();
                return view('dashboards.index', compact('nbre_mes_offres', 'nbre_mes_offres_en_cours', 'nbre_postulants', 'mes_offres'));
                break;
            
            default:
                # code...
                break;
        }
    }

    public function config() {
        $nbre_diplome = Diplome::all()->count();
        $nbre_secteur = Secteur::all()->count();
        $nbre_activite = Activite::all()->count();
        return view('dashboards.config', compact('nbre_diplome', 'nbre_secteur', 'nbre_activite'));
    }
}
