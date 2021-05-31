<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PostuleRepository;
use App\Repositories\OpportuniteRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\File;

class PostuleController extends Controller
{
    protected $postuleRepository;
    protected $opportuniteRepository;

    public function __construct(PostuleRepository $postuleRepository, OpportuniteRepository $opportuniteRepository) {
        $this->postuleRepository = $postuleRepository;
        $this->opportuniteRepository = $opportuniteRepository;
    }

    public function store(Request $request, $slug) {
        $opportunite = $this->opportuniteRepository->getBySlug($slug);
        $request->validate([
            'cv' => 'file|mimes:csv,txt,doc,docx,xls,pdf|max:2048',
        ]);

        if(Auth::check()){
            $request->merge([
                'user_id' => Auth::user()->id,
                'opportunite_id' => $opportunite->id,
            ]);
        }
        //Enregistrement de la postulation
        $postule = $this->postuleRepository->store($request->all());
        
        $fileModel = new File;

        if($request->hasFile('cv')) {
            
            $fileName = time().'_'.$request->file('cv')->getClientOriginalName();
            $filePath = $request->file('cv')->storeAs("uploads/cv/opportunite/$opportunite->id", $fileName, 'public');
            $fileModel->libelle = $fileName;
            $fileModel->file_path = '/storage/' . $filePath;

            if (Auth::check()) {
                $fileModel->user_id = Auth::user()->id;
            }

            $fileModel->type = 'cv_opportunite';
            $fileModel->postule_id = $postule->id;
            $fileModel->save();
        }

        return redirect("/$opportunite->type/$opportunite->slug#postuler")->withStatus("Postulation effectuée avec succès");

    }

}
