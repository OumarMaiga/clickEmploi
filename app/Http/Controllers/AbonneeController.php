<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AbonneeRepository;

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
