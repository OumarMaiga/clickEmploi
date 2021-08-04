<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Repositories\ActiviteRepository;
use App\Repositories\SecteurRepository;
use App\Models\Activite;

class ActiviteController extends Controller
{protected $activiteRepository;

    public function __construct(ActiviteRepository $activiteRepository, SecteurRepository $secteurRepository) {
        $this->middleware('adminOnly', ['only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']]);
        $this->activiteRepository = $activiteRepository;
        $this->secteurRepository = $secteurRepository;
    }

    public function index() {
        $activites = Activite::join('secteurs', 'secteurs.id', 'activites.secteur_id')
                                ->orderBy('secteurs.libelle')
                                ->get([
                                    'activites.id as id',
                                    'secteurs.libelle as secteur_libelle',
                                    'activites.libelle as activite_libelle',
                                    'activites.slug as slug'
                                ]);
        return view('activites.index', compact('activites'));
    }

    public function create() {
        $secteurs = $this->secteurRepository->get();
        return view('activites.create', compact('secteurs'));
    }

    public function store(Request $request) {

        $request->merge([
            'user_id' => Auth::user()->id,
            'slug' => Str::slug($request->get('libelle')),
        ]);
            
        $activite = $this->activiteRepository->store($request->all());

        return redirect('/dashboard/activite/')->withStatus("Nouveau activite d'activités  (".$activite->libelle.") vient d'être ajouté");
    
    }

    public function edit($slug) {
        $activite = $this->activiteRepository->getBySlug($slug);
        $secteurs = $this->secteurRepository->get();
        
        return view('activites.edit', compact('activite', 'secteurs'));
    }

    public function update(Request $request, $id) {
        $this->activiteRepository->update($id, $request->all());
        return redirect('/dashboard/activite')->withStatus("activite d'activité a bien été modifier");
    }

    public function show($slug) {
        $activite = $this->activiteRepository->getBySlug($slug);
        return view('activites.show', compact('activite'));
    }

    public function destroy($id) {
		$this->activiteRepository->destroy($id);
        return redirect()->back()->withError("Activité a bien été supprimer");;
    }
}
