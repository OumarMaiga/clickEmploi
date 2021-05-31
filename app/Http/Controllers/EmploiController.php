<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Repositories\OpportuniteRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\File;

class EmploiController extends Controller
{
    protected $opportuniteRepository;

    public function __construct(OpportuniteRepository $opportuniteRepository) {
        $this->opportuniteRepository = $opportuniteRepository;
    }

    public function index() {
        $emplois = $this->opportuniteRepository->getByType('emploi');
        return view('emplois.index', compact('emplois'));
    }
    
    public function create() {
        return view('emplois.create');
    }

    public function store(Request $request) {

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $request->merge([
            'type' => 'emploi',
            'slug' => Str::slug($request->get('title')),
            'user_id' => Auth::user()->id,
        ]);
        
        $opportunite = $this->opportuniteRepository->store($request->all());
        $id = $opportunite->id;
        
        $this->save_opportunite_image($id, $request);

        return redirect('/dashboard/emploi')->withStatus("Nouveau emploi publié");
    }

    public function edit($slug) {
        $emploi = $this->opportuniteRepository->getBySlug($slug);
        return view('emplois.edit', compact('emploi'));
    }

    public function update(Request $request, $id) {
        $this->opportuniteRepository->update($id, $request->all());

        $this->save_opportunite_image($id, $request);

        return redirect('/dashboard/emploi')->withStatus("Emploi a bien été mise à jour");
    }

    public function show($slug) {
        $emploi = $this->opportuniteRepository->getBySlug($slug);
        return view('emplois.show', compact('emploi'));
    }
    
    public function detail($slug) {
        $opportunite = $this->opportuniteRepository->getBySlug($slug);
        return view('pages.detail', compact('opportunite'));
    }

    public function destroy($id) {
		$this->opportuniteRepository->destroy($id);
        return redirect()->back();
    }

    public function save_opportunite_image($id, $request) {
        $fileModel = new File;

        $request->validate([
            'image' => 'file|mimes:png,jpg,gif,jpeg|max:5120',
        ]);

        if($request->hasFile('image')) {
            
            $fileName = time().'_'.$request->file('image')->getClientOriginalName();
            $filePath = $request->file('image')->storeAs("uploads/images/opportunite/$id", $fileName, 'public');
            $fileModel->libelle = $fileName;
            $fileModel->file_path = '/storage/' . $filePath;
            $fileModel->type = 'photo_opportunite';
            $fileModel->user_id = Auth::user()->id;

            $fileModel->save();
        }
    }
}
