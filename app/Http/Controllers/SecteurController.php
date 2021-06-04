<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SecteurRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SecteurController extends Controller
{
    protected $secteurRepository;

    public function __construct(SecteurRepository $secteurRepository) {
        $this->middleware('onlyAdmin', ['only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']]);
        $this->secteurRepository = $secteurRepository;
    }

    public function index() {
        $secteurs = $this->secteurRepository->get();
        return view('secteurs.index', compact('secteurs'));
    }

    public function create() {
        return view('secteurs.create');
    }

    public function store(Request $request) {

        $request->validate([
            'libelle' => 'required|max:255|unique:secteurs',
        ]);

        $request->merge([
            'user_id' => Auth::user()->id,
            'slug' => Str::slug($request->get('libelle')),
        ]);
            
        $secteur = $this->secteurRepository->store($request->all());

        return redirect('/dashboard/secteur/')->withStatus("Nouveau Secteur d'activités  (".$secteur->libelle.") vient d'être ajouté");
    
    }

    public function edit($slug) {
        $secteur = $this->secteurRepository->getBySlug($slug);
        
        return view('secteurs.edit', compact('secteur'));
    }

    public function update(Request $request, $id) {
        $this->secteurRepository->update($id, $request->all());
        return redirect('/dashboard/secteur')->withStatus("Diplome a bien été modifier");
    }

    public function show($slug) {
        $secteur = $this->secteurRepository->getBySlug($slug);
        return view('secteurs.show', compact('secteur'));
    }

    public function destroy($id) {
		$this->secteurRepository->destroy($id);
        return redirect()->back()->withError("Diplome a bien été supprimer");;
    }
}
