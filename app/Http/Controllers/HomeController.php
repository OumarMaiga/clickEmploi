<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Repositories\OpportuniteRepository;
use App\Repositories\UserRepository;
use App\Repositories\DiplomeRepository;

use App\Models\File;
use App\Models\Opportunite;
use App\Models\Secteur;
use App\Models\Diplome;
use App\Models\Activite;

use Mail;

class HomeController extends Controller
{
    protected $opportuniteRepository;
    protected $userRepository;

    public function __construct(OpportuniteRepository $opportuniteRepository, UserRepository $userRepository, DiplomeRepository $diplomeRepository) {
        $this->opportuniteRepository = $opportuniteRepository;
        $this->userRepository = $userRepository;
        $this->diplomeRepository = $diplomeRepository;
    }
    
    public function index()
    {
        //Tous les offres
        //$opportunites = $this->opportuniteRepository->get();
        $opportunites = Opportunite::orderBy('created_at', 'desc')->simplePaginate(15);
        $offre_par_profil = $this->offre_par_profil();
        if(Auth::check()) {
            $domaine_par_profil = Auth::user()->secteurs()->get();
        } else {
            $domaine_par_profil = null;
        }
        return view('pages/home', compact('opportunites', 'offre_par_profil', 'domaine_par_profil'));
    }
    
    public function accueil()
    {
        $activites = Activite::select('slug', 'libelle')->limit(9)->get();
        $postes = Opportunite::select('title')->limit(9)->get();
        $adresses = Opportunite::distinct('adresse')->select('lieu')->limit(9)->get();
        //Recuperation des entreprises qui ont posté le plus d'offre
        $entreprises = Opportunite::selectRaw('count(opportunites.entreprise_id) as opportunite_count, opportunites.entreprise_id, entreprises.libelle, entreprises.slug, files.file_path')
                                    ->rightJoin('entreprises', 'opportunites.entreprise_id', '=', 'entreprises.id')
                                    ->rightJoin('files', 'opportunites.entreprise_id', '=', 'files.entreprise_id')
                                    ->where('files.type', '=', 'photo_entreprise')
                                    ->groupBy('opportunites.entreprise_id', 'entreprises.libelle', 'entreprises.slug', 'files.file_path')
                                    ->orderByDesc('opportunite_count')
                                    ->limit(3)
                                    ->get()
                                    ->toArray();
        // Recuperation par ordre
        $first_entreprise = count($entreprises) > 0 ? $entreprises[0] : false;
        $second_entreprise = count($entreprises) > 1 ? $entreprises[1] : false;
        $third_entreprise = count($entreprises) > 2 ? $entreprises[2] : false;
        $forth_entreprise = count($entreprises) > 3 ? $entreprises[3] : false;
        $fith_entreprise = count($entreprises) > 4 ? $entreprises[4] : "";
        return view('pages/accueil', compact('adresses', 'activites', 'postes', 'first_entreprise', 'second_entreprise', 'third_entreprise', 'forth_entreprise', 'fith_entreprise'));
    }
 
    public function profil($email) {
        $user = $this->userRepository->getByEmail($email);
        $photo = photo_profil($user->email);
        $secteurs = $user->secteurs->pluck('libelle');
        
        return view('pages.profil', compact('user', 'photo', 'secteurs'));
    }

    public function edit_profil() {
        $user = Auth::user();
        $domaines = Secteur::select('id', 'libelle', 'slug')->distinct()->get();
        $photo = photo_profil($user->email);
        $secteur_checked = $user->secteurs()->get();
        $diplomes = $this->diplomeRepository->get();
        return view('pages.edit_profil', compact('user', 'photo', 'domaines', 'secteur_checked', 'diplomes'));
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

        if ($request->has('secteur')) {
            $secteurs = $request->input('secteur');
            $relation = $user->secteurs()->sync($secteurs);
        }
        return redirect("/profil/$user->email")->withStatus('Profil mise à jour');

    }

    public function filtre(Request $request) {
        $opportunites = new Opportunite;
        if($request->has('secteur')) {
            /*$activites_secteur = Activite::whereIn('secteur_id', $request->secteur)->pluck('id');
            $opportunites = Opportunite::join('activite_opportunite', function ($join) use ($activites_secteur) {
                                            $join->on('opportunites.id', '=', 'activite_opportunite.opportunite_id')
                                                ->whereIn('activite_opportunite.activite_id', $activites_secteur);
                                            });*/
            $secteurs = Secteur::whereIn('id', $request->secteur)->pluck('id');
            $opportunites = Opportunite::join('opportunite_secteur', function ($join) use ($secteurs) {
                                            $join->on('opportunites.id', '=', 'opportunite_secteur.opportunite_id')
                                                ->whereIn('opportunite_secteur.secteur_id', $secteurs);
                                            });
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
        $opportunites = $opportunites->orderBy('created_at', 'desc')->get()->unique('id');
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
        if(Auth::check()) {
            $domaine_par_profil = Auth::user()->secteurs()->get();
        } else {
            $domaine_par_profil = null;
        }
        $opportunites = $opportunites->orderBy('created_at', 'desc')->get();
        $nbre_offres = $opportunites->count();
        $offre_par_profil = collect();
        return view('pages.opportunites.opportunites', compact('opportunites', 'nbre_offres', 'offre_par_profil', 'domaine_par_profil'));
    }

    public function jobboard() {
        return view('pages.jobboard');
    }

    //Offre par profil
    public function offre_par_profil() {
        if(Auth::check()){
            $domaine_par_profil = Auth::user()->secteurs()->pluck('id')->toArray();
            $dernier_diplome_user = Auth::user()->diplome()->associate(Auth::user()->dernier_diplome)->diplome;

            //Verifier si le diplome existe
            if($dernier_diplome_user) {
                $annee_etude_user = $dernier_diplome_user->annee_etude;         
            } else {
                $annee_etude_user = 0;
            }

            $offre_par_profil = Opportunite::whereHas('secteurs', function($q) use ($domaine_par_profil) {
                $q->whereIn('secteurs.id', $domaine_par_profil);
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
            ])->sortByDesc('created_at');
                        
        }else{
            $offre_par_profil = Opportunite::where('id', '0')->get();
        }
        return $offre_par_profil;
    }
}
