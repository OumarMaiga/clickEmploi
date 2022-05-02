<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Repositories\OpportuniteRepository;
use App\Repositories\EntrepriseRepository;
use App\Repositories\PostuleRepository;

use App\Models\File;
use App\Models\Opportunite;
use App\Models\Secteur;
use App\Models\Diplome;

class EmploiController extends Controller
{
    protected $opportuniteRepository;
    protected $entrepriseRepository;
    protected $postuleRepository;

    public function __construct(OpportuniteRepository $opportuniteRepository, EntrepriseRepository $entrepriseRepository, PostuleRepository $postuleRepository) {
        $this->middleware('adminAndPartenaireOnly', ['only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']]);
        $this->opportuniteRepository = $opportuniteRepository;
        $this->entrepriseRepository = $entrepriseRepository;
        $this->postuleRepository = $postuleRepository;
    }

    public function index() {
        if (Auth::user()->type == "admin") {
            $emplois = Opportunite::where('type', 'emploi')->get();
        } else {
            $emplois = Opportunite::where('user_id', Auth::user()->id)->where('type', 'emploi')->get();
        }
        return view('emplois.index', compact('emplois'));
    }
    
    public function create() {
        $user = Auth::user();
        $domaines = Secteur::select('id', 'libelle')->get();
        $entreprises = $this->entrepriseRepository->getByForeignId('user_id', $user->id);
        $diplomes = Diplome::get();
        return view('emplois.create', compact('entreprises', 'domaines', 'diplomes'));
    }

    public function store(Request $request) {

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'lieu' => 'required',
            'entreprise_id' => 'required',
            'annee_experience' => 'numeric|between:0,20',
        ]);

        $nbreLibelle = Opportunite::where('title', $request->title)->count();
        
        if ($nbreLibelle != '0') {
            $slug = Str::slug($request->get('title'))."-".$nbreLibelle;
        }
        else {
            $slug = Str::slug($request->get('title'));
        }
        $echeance = $request->date_echeance."T".$request->time_echeance;
        $request->merge([
            'type' => 'emploi',
            'slug' => $slug,
            'user_id' => Auth::user()->id,
            'echeance' => $echeance,
        ]);
        $opportunite = $this->opportuniteRepository->store($request->all());
        
        if ($request->has('secteur')) {
            $secteurs = $request->input('secteur');
            $opportunite->secteurs()->sync($secteurs);
        }
        
        return redirect('/dashboard/emploi')->withStatus("Nouveau emploi publié");
    }

    public function edit($slug) {
        $emploi = $this->opportuniteRepository->getBySlug($slug);
        $domaines = Secteur::select('id', 'libelle', 'slug')->distinct()->get();
        $user = Auth::user();
        $diplomes = Diplome::get();
        $entreprises = $this->entrepriseRepository->getByForeignId('user_id', $user->id);
        $secteur_checked = $emploi->secteurs()->get();
        return view('emplois.edit', compact('emploi', 'entreprises', 'diplomes', 'domaines', 'secteur_checked'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'lieu' => 'required',
            'entreprise_id' => 'required',
            'annee_experience' => 'numeric|between:0,20',
        ]);
        if ($request->has('date_echeance') || $request->has('time_echeance')) {
            $echeance = $request->date_echeance."T".$request->time_echeance;
            $request->merge([
                'echeance' => $echeance,
            ]);
        }
        $this->opportuniteRepository->update($id, $request->all());
        if ($request->has('secteur')) {
            $opportunite = $this->opportuniteRepository->getById($id);
            $secteurs = $request->input('secteur');
            $opportunite->secteurs()->sync($secteurs);
        }
        return redirect('/dashboard/emploi')->withStatus("Emploi a bien été mise à jour");
    }

    public function show($slug) {
        $opportunite = $this->opportuniteRepository->getBySlug($slug);
        $entreprise = $this->entrepriseRepository->getById($opportunite->entreprise_id);
        $postulants = $this->postuleRepository->getByForeignId('opportunite_id', $opportunite->id);
        $activites = $opportunite->activites->pluck('libelle');
        $niveau = $opportunite->diplome()->associate($opportunite->niveau)->diplome;
        $annee_experience = $opportunite->annee_experience;
        if ($annee_experience == "0.5") {
            $annee_experience = "6 mois";
        } elseif($annee_experience == "1") {
            $annee_experience = "1 an";
        }elseif($annee_experience == "2") {
            $annee_experience = "2 ans";
        }elseif($annee_experience == "3") {
            $annee_experience = "3 ans";
        }elseif($annee_experience == "4") {
            $annee_experience = "4 ans";
        }elseif($annee_experience == "5") {
            $annee_experience = "5 ans";
        }else{
            $annee_experience = "";
        }
                
        return view('emplois.show', compact('opportunite', 'entreprise', 'postulants', 'activites', 'niveau', 'annee_experience'));
    }
    
    public function detail($slug) {
        $opportunite = $this->opportuniteRepository->getBySlug($slug);
        $entreprise = $this->entrepriseRepository->getById($opportunite->entreprise_id);

        $domaines_opportunite = $opportunite->activites()->distinct()->pluck('secteur_id')->toArray();
        $activites_secteur = DB::table('activites')->whereIn('secteur_id', $domaines_opportunite)->pluck('id')->toArray();
        
        $opportunite_similaires =  Opportunite::where('type', 'emploi')->whereHas('activites', function($q) use ($activites_secteur) {
            $q->whereIn('activites.id', $activites_secteur);
        })->limit(4)->get();

        $domaines = $opportunite->secteurs->pluck('libelle');

        $niveau = $opportunite->diplome()->associate($opportunite->niveau)->diplome;
        $annee_experience = $opportunite->annee_experience;
        
        if ($annee_experience == "0.5") {
            $annee_experience = "6 mois";
        } elseif($annee_experience == "1") {
            $annee_experience = "1 an";
        }elseif($annee_experience == "2") {
            $annee_experience = "2 ans";
        }elseif($annee_experience == "3") {
            $annee_experience = "3 ans";
        }elseif($annee_experience == "4") {
            $annee_experience = "4 ans";
        }elseif($annee_experience == "5") {
            $annee_experience = "5 ans";
        }else{
            $annee_experience = "";
        }

        if(Auth::check()) {
            $domaine_par_profil = Auth::user()->secteurs()->get();
            // Texte de la lettre de motivation
            $motivation_texte = "C'est avec un réel plaisir que moi #name# je postule à cette offre ...";
            $name = Auth::user()->prenom." ".Auth::user()->nom;
        } else {
            $domaine_par_profil = null;
            $motivation_texte = "";
            $name = "";
        }
        
        return view('pages.opportunites.opportunite', compact('opportunite', 'entreprise', 'opportunite_similaires', 'domaines', 'niveau', 'annee_experience', 'domaine_par_profil', 'motivation_texte', 'name'));
    }

    public function destroy($id) {
		$this->opportuniteRepository->destroy($id);
        return redirect()->back();
    }
    
    public function list()
    {
        //$opportunites = $this->opportuniteRepository->getByType('emploi');
        $opportunites = Opportunite::where('type', '=', 'emploi')->simplePaginate(7);
        $offre_par_profil = $this->offre_par_profil();
        if(Auth::check()) {
            $domaine_par_profil = Auth::user()->secteurs()->get();
        } else {
            $domaine_par_profil = null;
        }
        return view('pages/opportunites/emplois', compact('opportunites', 'offre_par_profil', 'domaine_par_profil'));
    }

    public function offre_par_profil() {
        if (Auth::check()) {
            $activite_par_profil = Auth::user()->activites()->pluck('id')->toArray();

            $dernier_diplome_user = Auth::user()->diplome()->associate(Auth::user()->dernier_diplome)->diplome;
            if($dernier_diplome_user) {
                $annee_etude = $dernier_diplome_user->annee_etude;         
            } else {
                $annee_etude = 0;
            }
            $offre_par_profil = Opportunite::where('type', 'emploi')->whereHas('activites', function($q) use ($activite_par_profil) {
                $q->whereIn('activites.id', $activite_par_profil);
            })->join('diplomes', 'opportunites.niveau', 'diplomes.id')
                ->where('annee_etude', '<=', $annee_etude)
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
