<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\AbonneeRepository;

use Illuminate\Support\Facades\Auth;

class AbonneeController extends Controller
{
    protected $abonneeRepository;

    public function __construct(AbonneeRepository $abonneeRepository) {
        $this->middleware('adminOnly', ['only' => ['index', 'show', 'destroy']]);
        $this->abonneeRepository = $abonneeRepository;
    }

    public function index() {
        $abonnees = $this->abonneeRepository->get();
        return view('abonnees.index', compact('abonnees'));
    }

    public function store(Request $request) {

        $request->validate([
            'type' => 'required'
        ]);
        
        if ($request->type === "jour") 
        {
            // Calcul de 1 jour apres aujourd'hui
            $date = date('Y-m-d', strtotime("+ 1 day"));
        } 
        else if ($request->type === "semaine")
        {
            // Calcul de 1 semaine apres aujourd'hui
            $date = date('Y-m-d', strtotime("+ 1 week"));
        } 
        else if($request->type === "mois") 
        {
            // Calcul de 1 mois apres aujourd'hui
            $date = date('Y-m-d', strtotime("+ 1 month"));
        }
        
        $request->merge([
            'user_id' => Auth::user()->id,
            'etat' => 'encours',
            'date_fin' => $date,
        ]);

        $abonnee = $this->abonneeRepository->store($request->all());

        return redirect()->back()->withStatus("Abonnement effectué avec succès");
    
    }

    public function show($id) {
        $abonnee = $this->abonneeRepository->getById($id);
        $user = $abonnee->user()->associate($abonnee->user_id)->user;
        return view('abonnees.show', compact('abonnee', 'user'));
    }

    public function destroy($id) {
		$this->abonneeRepository->destroy($id);
        return redirect()->back()->withError("Abonnée a bien été supprimé");
    } 
}
