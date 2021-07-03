<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\OpportuniteRepository;
use App\Repositories\UserRepository;
use App\Models\File;
use App\Models\Opportunite;


class HomeController extends Controller
{
    protected $opportuniteRepository;
    protected $userRepository;

    public function __construct(OpportuniteRepository $opportuniteRepository, UserRepository $userRepository) {
        $this->opportuniteRepository = $opportuniteRepository;
        $this->userRepository = $userRepository;
    }
    
    public function index()
    {
        //Tous les offres
        $opportunites = $this->opportuniteRepository->get();
        //Offres par profil
        $domaine_par_profil = Auth::user()->secteurs()->pluck('id');
        $dernier_diplome_user = Auth::user()->diplome()->associate(Auth::user()->dernier_diplome)->diplome;
        $offre_par_domaine = Opportunite::whereHas('secteurs', function($q) use ($domaine_par_profil) {
            $q->whereIn('secteurs.id', $domaine_par_profil);
        })->join('diplomes', 'opportunites.niveau', 'diplomes.id')
            ->where('annee_etude', '<=', $dernier_diplome_user->annee_etude)
            ->get([
                'opportunites.id as id',
                'title',
                'echeance',
                'entreprise_id',
                'lieu',
                'type',
                "opportunites.slug as slug",
                "opportunites.created_at as created_at",
            ]);

        /*dd($offre_par_domaine);
        die();*/
        return view('pages/home', compact('opportunites', 'offre_par_domaine'));
    }
    
    public function accueil()
    {
        $adresses = Opportunite::distinct('adresse')->select('lieu')->limit(9)->get();
        return view('pages/accueil', compact('adresses'));
    }
 
    public function profil($email) {
        $user = $this->userRepository->getByEmail($email);
        $photo = photo_profil($user->email);
        $secteurs = $user->secteurs->pluck('libelle');
        
        return view('pages.profil', compact('user', 'photo', 'secteurs'));
    }

    public function edit_profil() {
        $user = Auth::user();
        $photo = photo_profil($user->email);
        return view('pages.edit_profil', compact('user', 'photo'));
    }

    public function update_profil($id, Request $request) {
        $user = Auth::user();

        $request->validate([
            'photo' => 'file|mimes:png,jpg,gif,jpeg|max:5120',
            'cv' => 'file|mimes:csv,txt,doc,docx,xls,pdf|max:2048',
        ]);

        $this->userRepository->update($id, $request->all());

        $ImageModel = new File;

        if($request->hasFile('photo')) {
            
            $fileName = time().'_'.$request->file('photo')->getClientOriginalName();
            $filePath = $request->file('photo')->storeAs("uploads/images/profil/$user->id", $fileName, 'public');
            $ImageModel->libelle = $fileName;
            $ImageModel->file_path = '/storage/' . $filePath;
            $ImageModel->type = 'photo_profil';
            $ImageModel->user_id = $user->id;

            $ImageModel->save();
        }

        if($request->hasFile('cv')) {
            $CvModel = new File;
            
            $fileName = time().'_'.$request->file('cv')->getClientOriginalName();
            $filePath = $request->file('cv')->storeAs("uploads/cv/profil/$user->id", $fileName, 'public');
            $CvModel->libelle = $fileName;
            $CvModel->file_path = '/storage/' . $filePath;
            $CvModel->type = 'cv_profil';
            $CvModel->user_id = $user->id;
            $CvModel->profil_id = $user->id;

            $CvModel->save();
        }

        return redirect("/$user->email")->withStatus('Profil mise à jour');

    }

    public function filtre(Request $request) {
        $opportunites = new Opportunite;
        if($request->has('poste')) {
            $opportunites = $opportunites->whereIn('poste', $request->poste);
        }
        if($request->has('contrat')) {
            $opportunites = $opportunites->whereIn('type_contrat', $request->contrat);
        }
        if($request->has('date')) {
            if ($request->date == "24h") {
                $hier = date('Y-m-d',strtotime("-1 days"));
                $opportunites = $opportunites->whereDate('created_at', '>=', $hier);
            } elseif($request->date == "7j") {
                $semaine = date('Y-m-d',strtotime("-7 days"));
                $opportunites = $opportunites->whereDate('created_at', '>=', $semaine);
            } elseif($request->date == "1m") {
                $mois = date('Y-m-d',strtotime("-1 months"));
                $opportunites = $opportunites->whereDate('created_at', '>=', $mois);
            } else {

            }
        }
        $opportunites = $opportunites->get();
        $nbre_offres = $opportunites->count();
        return view('pages.filter', compact('opportunites', 'nbre_offres'));
        
    }

        public function search(Request $request) {
        $poste = $request->poste;
        $adresse = $request->adresse;
        $opportunites = new Opportunite;
        if($poste != null) {
            $opportunites = $opportunites->where('poste', 'like', "%$poste%");
        }
        if($adresse != null) {
            $opportunites = $opportunites->where('lieu', 'like', "%$adresse%");
        } 
        $opportunites = $opportunites->get();
        $nbre_offres = $opportunites->count();
        return view('pages.opportunites', compact('opportunites', 'nbre_offres'));
    }

}
