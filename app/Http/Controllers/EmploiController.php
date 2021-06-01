<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Repositories\OpportuniteRepository;
use App\Repositories\EntrepriseRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\File;

class EmploiController extends Controller
{
    protected $opportuniteRepository;
    protected $entrepriseRepository;

    public function __construct(OpportuniteRepository $opportuniteRepository, EntrepriseRepository $entrepriseRepository) {
        $this->opportuniteRepository = $opportuniteRepository;
        $this->entrepriseRepository = $entrepriseRepository;
    }

    public function index() {
        $emplois = $this->opportuniteRepository->getByType('emploi');
        return view('emplois.index', compact('emplois'));
    }
    
    public function create() {
        $user = Auth::user();
        $entreprises = $this->entrepriseRepository->getByForeignId('user_id', $user->id);
        return view('emplois.create', compact('entreprises'));
    }

    public function store(Request $request) {

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'entreprise_id' => 'required',
        ]);

        $request->merge([
            'type' => 'emploi',
            'slug' => Str::slug($request->get('title')),
            'user_id' => Auth::user()->id,
        ]);
        
        $opportunite = $this->opportuniteRepository->store($request->all());
        
        return redirect('/dashboard/emploi')->withStatus("Nouveau emploi publié");
    }

    public function edit($slug) {
        $emploi = $this->opportuniteRepository->getBySlug($slug);
        $user = Auth::user();
        $entreprises = $this->entrepriseRepository->getByForeignId('user_id', $user->id);
        return view('emplois.edit', compact('emploi', 'entreprises'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'entreprise_id' => 'required',
        ]);
        $this->opportuniteRepository->update($id, $request->all());

        return redirect('/dashboard/emploi')->withStatus("Emploi a bien été mise à jour");
    }

    public function show($slug) {
        $opportunite = $this->opportuniteRepository->getBySlug($slug);
        $entreprise = $this->entrepriseRepository->getById($opportunite->entreprise_id);
        return view('emplois.show', compact('opportunite'));
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
