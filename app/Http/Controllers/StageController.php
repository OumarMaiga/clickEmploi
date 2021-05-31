<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Repositories\OpportuniteRepository;
use Illuminate\Support\Facades\Auth;

class StageController extends Controller
{
    protected $opportuniteRepository;

    public function __construct(OpportuniteRepository $opportuniteRepository) {
        $this->opportuniteRepository = $opportuniteRepository;
    }

    public function index() {
        $stages = $this->opportuniteRepository->getByType('stage');
        return view('stages.index', compact('stages'));
    }
    
    public function create() {
        return view('stages.create');
    }

    public function store(Request $request) {

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $request->merge([
            'type' => 'stage',
            'slug' => Str::slug($request->get('title')),
            'user_id' => Auth::user()->id,
        ]);
        
        $this->opportuniteRepository->store($request->all());

        return redirect('/dashboard/stage')->withStatus("Nouveau stage publié");
    }

    public function edit($slug) {
        $stage = $this->opportuniteRepository->getBySlug($slug);
        return view('stages.edit', compact('stage'));
    }

    public function update(Request $request, $id) {
        $this->opportuniteRepository->update($id, $request->all());
        return redirect('/dashboard/stage')->withStatus("Stage a bien été mise à jour");
    }

    public function show($slug) {
        $stage = $this->opportuniteRepository->getBySlug($slug);
        return view('stages.show', compact('stage'));
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
