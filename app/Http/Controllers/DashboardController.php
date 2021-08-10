<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Opportunite;

class DashboardController extends Controller
{
    public function __construct() {
        $this->middleware('adminAndPartenaireOnly', ['only' => ['index']]);
    }
    public function index()
    {
        $nbre_users = User::where('type', 'user')->where('etat', true)->get()->count();
        $nbre_partenaires = User::where('type', 'partenaire')->where('etat', true)->get()->count();
        //$nbre_abonnees = Abonne::where('type', 'user')->where('etat', true)->get()->count();
        $nbre_offres_en_cours = Opportunite::where('echeance', '>', NOW())->get()->count();
        $mes_offres = Opportunite::where('user_id', Auth::user()->id)->get();
        return view('dashboards.index', compact('nbre_users', 'nbre_offres_en_cours', 'nbre_partenaires', 'mes_offres'));
    }
}
