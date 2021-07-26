<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\OpportuniteRepository;
use App\Models\Opportunite;

class OpportuniteController extends Controller
{
    protected $opportuniteRepository;

    public function __construct(OpportuniteRepository $opportuniteRepository) {
        $this->opportuniteRepository = $opportuniteRepository;
    }

    public function adresse($adresse) {
        $opportunites = Opportunite::where('lieu', $adresse)->get();
        $nbre_offres = $opportunites->count();
        return view('pages.opportunites', compact('opportunites', 'nbre_offres', 'adresse'));
    }
}
