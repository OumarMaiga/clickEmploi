<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PostuleRepository;
use App\Repositories\OpportuniteRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
        $opportunite = DB::table('opportunites')
                            ->select('opportunites.id as id', 'opportunites.title as title', 'opportunites.title as title', 
                            'opportunites.slug as slug', 'opportunites.type as type', 'opportunites.email as email', 
                            'opportunites.content as content', 
                            'entreprises.libelle as entreprise_name')
                            ->join('entreprises', 'opportunites.entreprise_id', '=', 'entreprises.id')
                            ->where('opportunites.slug', $slug)
                            ->get();
                            
        $request->validate([
            'cv' => 'file|mimes:csv,txt,doc,docx,xls,pdf|max:2048',
        ]);
        
        if(Auth::check()){
            $request->merge([
                'user_id' => Auth::user()->id,
                'opportunite_id' => $opportunite[0]->id,
            ]);
        }
        //Enregistrement de la postulation
        $postule = $this->postuleRepository->store($request->all());
        
        $filePath = "";

        $fileModel1 = new File;

        if ($request->has('cv_profil')) {
            $cv = voir_cv_profil(Auth::user()->id);

            $fileModel1->libelle = $cv->libelle;
            $fileModel1->file_path = $cv->file_path;
            $fileModel1->user_id = Auth::user()->id;
            $fileModel1->type = 'cv_opportunite';
            $fileModel1->postule_id = $postule->id;
            $fileModel1->save();

            $filePath = str_replace("/storage/", "", $cv->file_path);
        }

        $fileModel = new File;

        if($request->hasFile('cv')) {
            
            $fileName = time().'_'.$request->file('cv')->getClientOriginalName();
            $filePath = $request->file('cv')->storeAs("uploads/cv/opportunite/".$opportunite[0]->id, $fileName, 'public');
            $fileModel->libelle = $fileName;
            $fileModel->file_path = '/storage/' . $filePath;

            if (Auth::check()) {
                $fileModel->user_id = Auth::user()->id;
            }

            $fileModel->type = 'cv_opportunite';
            $fileModel->postule_id = $postule->id;
            $fileModel->save();
        } 
        $url  = env('APP_URL')."/".$opportunite[0]->type."/".$opportunite[0]->slug;
        $data = array (
            'title' => $opportunite[0]->title,
            'slug' => $opportunite[0]->slug,
            'url' => $url,
            'email' => $opportunite[0]->email,
            'content' => $opportunite[0]->content,
            'file_path' => $filePath != "" ? 'storage/'.$filePath : "",
            'user_name' => $request->prenom." ".$request->nom,
            'user_email' => $request->email,
            'user_telephone' => $request->telephone,
            'user_motivation' => $request->motivation,
            'entreprise_name' => $opportunite[0]->entreprise_name,
        );
        automatic_mail_to_entreprise($data);

        return redirect("/".$opportunite[0]->type."/".$opportunite[0]->slug."#postuler")->withStatus("Votre candidature a bien été envoyée");

    }

}
