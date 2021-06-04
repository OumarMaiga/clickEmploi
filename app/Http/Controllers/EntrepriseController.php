<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\EntrepriseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\File;

class EntrepriseController extends Controller
{
    protected $entrepriseRepository;

    public function __construct(EntrepriseRepository $entrepriseRepository) {
        $this->entrepriseRepository = $entrepriseRepository;
    }

    public function index() {
        $entreprises = $this->entrepriseRepository->get();
        
        return view('entreprises.index', compact('entreprises'));
    }

    public function create() {
        return view('entreprises.create');
    }

    public function store(Request $request) {

        $request->validate([
            'libelle' => 'required|max:255',
        ]);

        $request->merge([
            'slug' => Str::slug($request->get('libelle')),
            'user_id' => Auth::user()->id,
        ]);
            
        $entreprise = $this->entrepriseRepository->store($request->all());
        $id = $entreprise->id;
        $this->save_entreprise_image($id, $request);
        return redirect('/dashboard/entreprise/')->withStatus("Nouvelle entreprise (".$entreprise->libelle.") vient d'être créer");
    
    }

    public function edit($slug) {
        $entreprise = $this->entrepriseRepository->getBySlug($slug);
        
        return view('entreprises.edit', compact('entreprise'));
    }

    public function update(Request $request, $id) {
        $this->entrepriseRepository->update($id, $request->all());

        $this->save_entreprise_image($id, $request);

        return redirect('/dashboard/entreprise')->withStatus("Diplome a bien été modifier");
    }

    public function show($slug) {
        $entreprise = $this->entrepriseRepository->getBySlug($slug);
        return view('entreprises.show', compact('entreprise'));
    }

    public function destroy($id) {
		$this->entrepriseRepository->destroy($id);
        return redirect()->back()->withError("Diplome a bien été supprimer");;
    }

    public function save_entreprise_image($id, $request) {
        $fileModel = new File;


        if($request->hasFile('image')) {
                
            $request->validate([
                'image' => 'file|mimes:png,jpg,gif,jpeg|max:5120',
            ]);
            
            $fileName = time().'_'.$request->file('image')->getClientOriginalName();
            $filePath = $request->file('image')->storeAs("uploads/images/entreprise/$id", $fileName, 'public');
            $fileModel->libelle = $fileName;
            $fileModel->file_path = '/storage/' . $filePath;
            $fileModel->entreprise_id = $id;
            $fileModel->type = 'photo_entreprise';
            $fileModel->user_id = Auth::user()->id;

            $fileModel->save();
        }
    }
}
