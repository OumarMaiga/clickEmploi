<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Repositories\OpportuniteRepository;
use Illuminate\Support\Facades\Auth;

class FormationController extends Controller
{
    protected $opportuniteRepository;

    public function __construct(OpportuniteRepository $opportuniteRepository) {
        $this->opportuniteRepository = $opportuniteRepository;
    }

    public function index() {
        $formations = $this->opportuniteRepository->getByType('formation');
        return view('formations.index', compact('formations'));
    }
    
    public function create() {
        return view('formations.create');
    }

    public function store(Request $request) {

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $request->merge([
            'type' => 'formation',
            'slug' => Str::slug($request->get('title')),
            'user_id' => Auth::user()->id,
        ]);
        
        $this->opportuniteRepository->store($request->all());

        return redirect('/dashboard/formation')->withStatus("Nouveau formation publié");
    }

    public function edit($slug) {
        $formation = $this->opportuniteRepository->getBySlug($slug);
        return view('formations.edit', compact('formation'));
    }

    public function update(Request $request, $id) {
        $this->opportuniteRepository->update($id, $request->all());
        return redirect('/dashboard/formation')->withStatus("Formation a bien été mise à jour");
    }

    public function show($slug) {
        $formation = $this->opportuniteRepository->getBySlug($slug);
        return view('formations.show', compact('formation'));
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
