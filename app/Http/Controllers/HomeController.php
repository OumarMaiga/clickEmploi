<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Repositories\OpportuniteRepository;
use App\Repositories\UserRepository;

use App\Models\File;
use App\Models\Opportunite;
use App\Models\Secteur;
use App\Models\Diplome;
use App\Models\Activite;


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
        $offre_par_profil = $this->offre_par_profil();
        return view('pages/home', compact('opportunites', 'offre_par_profil'));
    }
    
    public function accueil()
    {
        $activites = Activite::select('slug', 'libelle')->limit(9)->get();
        $postes = Opportunite::select('title')->limit(9)->get();
        $adresses = Opportunite::distinct('adresse')->select('lieu')->limit(9)->get();
        return view('pages/accueil', compact('adresses', 'activites', 'postes'));
    }
 
    public function profil($email) {
        $user = $this->userRepository->getByEmail($email);
        $photo = photo_profil($user->email);
        $activites = $user->activites->pluck('libelle');
        
        return view('pages.profil', compact('user', 'photo', 'activites'));
    }

    public function edit_profil() {
        $user = Auth::user();
        $domaines = Secteur::select('id', 'libelle', 'slug')->distinct()->get();
        $photo = photo_profil($user->email);
        $activite_checked = $user->activites()->get();
        return view('pages.edit_profil', compact('user', 'photo', 'domaines', 'activite_checked'));
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

        if ($request->has('activite')) {
            $activites = $request->input('activite');
            $relation = $user->activites()->sync($activites);
        }
        return redirect("/profil/$user->email")->withStatus('Profil mise à jour');

    }

    public function filtre(Request $request) {
        $opportunites = new Opportunite;
        if($request->has('secteur')) {
            $activites_secteur = Activite::whereIn('secteur_id', $request->secteur)->pluck('id');
            $opportunites = Opportunite::join('activite_opportunite', 'opportunites.id', '=', 'activite_opportunite.opportunite_id')
                                        ->whereIn('activite_opportunite.activite_id', $activites_secteur);
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
        $offre_par_profil = $this->offre_par_profil();
        return view('pages.filter', compact('opportunites', 'nbre_offres', 'offre_par_profil'));
        
    }

        public function search(Request $request) {
        $title = $request->title;
        $adresse = $request->adresse;
        $opportunites = new Opportunite;
        if($title != null) {
            $opportunites = $opportunites->where('title', 'like', "%$title%");
        }
        if($adresse != null) {
            $opportunites = $opportunites->where('lieu', 'like', "%$adresse%");
        } 
        $opportunites = $opportunites->get();
        $nbre_offres = $opportunites->count();
        $offre_par_profil = collect();
        return view('pages.opportunites.opportunites', compact('opportunites', 'nbre_offres', 'offre_par_profil'));
    }

    public function jobboard() {
        return view('pages.jobboard');
    }

    //Offre par profil
    public function offre_par_profil() {
        if(Auth::check()){
            $activite_par_profil = Auth::user()->activites()->pluck('id')->toArray();

            $dernier_diplome_user = Auth::user()->diplome()->associate(Auth::user()->dernier_diplome)->diplome;

            //Verifier si le diplome existe
            if($dernier_diplome_user) {
                $annee_etude_user = $dernier_diplome_user->annee_etude;         
            } else {
                $annee_etude_user = 0;
            }

            $offre_par_profil = Opportunite::whereHas('activites', function($q) use ($activite_par_profil) {
                $q->whereIn('activites.id', $activite_par_profil);
            })->join('diplomes', 'opportunites.niveau', 'diplomes.id')
                ->where('annee_etude', '<=', $annee_etude_user)
                ->get([
                    'opportunites.id as id',
                    'title',
                    'echeance',
                    'entreprise_id',
                    'lieu',
                    'type',
                    "opportunites.slug as slug",
                    "opportunites.annee_experience as annee_experience",
                    "opportunites.created_at as created_at",
                ]);
                        
            }else{
                $offre_par_profil = Opportunite::where('id', '0')->get();
            }
            return $offre_par_profil;
        }
}
