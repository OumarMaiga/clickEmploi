<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\DiplomeRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DiplomeController extends Controller
{
    protected $diplomeRepository;

    public function __construct(DiplomeRepository $diplomeRepository) {
        $this->middleware('adminOnly', ['only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']]);
        $this->diplomeRepository = $diplomeRepository;
    }

    public function index() {
        $diplomes = $this->diplomeRepository->get()->sortBy('annee_etude');
        return view('diplomes.index', compact('diplomes'));
    }

    public function create() {
        return view('diplomes.create');
    }

    public function store(Request $request) {

        $request->validate([
            'libelle' => 'required|max:255|unique:diplomes',
            'annee_etude' => 'required|numeric|min:6'
        ]);

        $request->merge([
            'slug' => Str::slug($request->get('libelle')),
            'user_id' => Auth::user()->id,
        ]);
            
        $diplome = $this->diplomeRepository->store($request->all());

        return redirect('/dashboard/diplome/')->withStatus("Nouveau diplome (".$diplome->libelle.") vient d'être ajouté");
    
    }

    public function edit($slug) {
        $diplome = $this->diplomeRepository->getBySlug($slug);
        
        return view('diplomes.edit', compact('diplome'));
    }

    public function update(Request $request, $id) {
        $this->diplomeRepository->update($id, $request->all());
        return redirect('/dashboard/diplome')->withStatus("Diplome a bien été modifier");
    }

    public function show($slug) {
        $diplome = $this->diplomeRepository->getBySlug($slug);
        return view('diplomes.show', compact('diplome'));
    }

    public function destroy($id) {
		$this->diplomeRepository->destroy($id);
        return redirect()->back()->withError("Diplome a bien été supprimer");
    } 
}
