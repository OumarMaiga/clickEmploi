<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Repositories\OpportuniteRepository;
use App\Repositories\EntrepriseRepository;
use Illuminate\Support\Facades\Auth;

class FormationController extends Controller
{
    protected $opportuniteRepository;
    protected $entrepriseRepository;

    public function __construct(OpportuniteRepository $opportuniteRepository, EntrepriseRepository $entrepriseRepository) {
        $this->opportuniteRepository = $opportuniteRepository;
        $this->entrepriseRepository = $entrepriseRepository;
    }

    public function index() {
        $formations = $this->opportuniteRepository->getByType('formation');
        return view('formations.index', compact('formations'));
    }
    
    public function create() {
        $user = Auth::user();
        $entreprises = $this->entrepriseRepository->getByForeignId('user_id', $user->id);
        return view('formations.create', compact('entreprises'));
    }

    public function store(Request $request) {

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'entreprise_id' => 'required',
        ]);

        $request->merge([
            'type' => 'formation',
            'slug' => Str::slug($request->get('title')),
            'user_id' => Auth::user()->id,
        ]);
        
        $opportunite = $this->opportuniteRepository->store($request->all());
       
        return redirect('/dashboard/formation')->withStatus("Nouveau formation publié");
    }

    public function edit($slug) {
        $formation = $this->opportuniteRepository->getBySlug($slug);
        $user = Auth::user();
        $entreprises = $this->entrepriseRepository->getByForeignId('user_id', $user->id);
        return view('formations.edit', compact('formation', 'entreprises'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'entreprise_id' => 'required',
        ]);
        $this->opportuniteRepository->update($id, $request->all());

        return redirect('/dashboard/formation')->withStatus("Formation a bien été mise à jour");
    }

    public function show($slug) {
        $opportunite = $this->opportuniteRepository->getBySlug($slug);
        $entreprise = $this->entrepriseRepository->getById($opportunite->entreprise_id);
        return view('formations.show', compact('opportunite'));
    }
    
    public function detail($slug) {
        $opportunite = $this->opportuniteRepository->getBySlug($slug);
        return view('pages.detail', compact('opportunite'));
    }

    public function destroy($id) {
		$this->opportuniteRepository->destroy($id);
        return redirect()->back();
    }
}
