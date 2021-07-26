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

class FormationController extends Controller
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
        $formations = $this->opportuniteRepository->getByType('formation');
        return view('formations.index', compact('formations'));
    }
    
    public function create() {
        $user = Auth::user();
        $domaines = Secteur::select('id', 'libelle', 'slug')->distinct()->get();
        $diplomes = Diplome::get();
        $entreprises = $this->entrepriseRepository->getByForeignId('user_id', $user->id);
        return view('formations.create', compact('entreprises', 'domaines', 'diplomes'));
    }

    public function store(Request $request) {

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'entreprise_id' => 'required',
        ]);

        $nbreLibelle = Opportunite::where('title', $request->title)->count();
        
        if ($nbreLibelle != '0') {
            $slug = Str::slug($request->get('title'))."-".$nbreLibelle;
        }
        else {
            $slug = Str::slug($request->get('title'));
        }

        $request->merge([
            'type' => 'formation',
            'slug' => $slug,
            'user_id' => Auth::user()->id,
        ]);
        
        $opportunite = $this->opportuniteRepository->store($request->all());
       
        if ($request->has('secteur')) {
            $secteurs = $request->input('secteur');
            $relation = $opportunite->secteurs()->sync($secteurs);
        }
        
        return redirect('/dashboard/formation')->withStatus("Nouveau formation publié");
    }

    public function edit($slug) {
        $formation = $this->opportuniteRepository->getBySlug($slug);
        $diplomes = Diplome::get();
        $user = Auth::user();
        $entreprises = $this->entrepriseRepository->getByForeignId('user_id', $user->id);
        return view('formations.edit', compact('formation', 'entreprises', 'diplomes'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'entreprise_id' => 'required',
        ]);
        $this->opportuniteRepository->update($id, $request->all());

        return redirect('/dashboard/formation')->withStatus("Formation a bien été mise à jour");
    }

    public function show($slug) {
        $opportunite = $this->opportuniteRepository->getBySlug($slug);
        $entreprise = $this->entrepriseRepository->getById($opportunite->entreprise_id);
        $postulants = $this->postuleRepository->getByForeignId('opportunite_id', $opportunite->id);
        $secteurs = $opportunite->secteurs->pluck('libelle');
        $niveau = $opportunite->diplome()->associate($opportunite->niveau)->diplome;
        return view('formations.show', compact('opportunite', 'entreprise', 'postulants', 'secteurs', 'niveau'));
    }

    public function detail($slug) {
        $opportunite = $this->opportuniteRepository->getBySlug($slug);
        $entreprise = $this->entrepriseRepository->getById($opportunite->entreprise_id);
        $opportunite_similaires = Opportunite::where('title', $opportunite->title)->limit(4)->get();
        $secteurs = $opportunite->secteurs->pluck('libelle');
        $niveau = $opportunite->diplome()->associate($opportunite->niveau)->diplome;
        return view('pages.opportunites.opportunite', compact('opportunite', 'entreprise', 'opportunite_similaires', 'secteurs', 'niveau'));
    }

    public function destroy($id) {
		$this->opportuniteRepository->destroy($id);
        return redirect()->back();
    }

    public function list()
    {
        $opportunites = $this->opportuniteRepository->getByType('formation');
        $offre_par_profil = $this->offre_par_profil();
        return view('pages/opportunites/formations', compact('opportunites', 'offre_par_profil'));
    }
    public function offre_par_profil() {
        if (Auth::check()) {
            //Recuperer tous les domaines du user
            $domaine_par_profil = Auth::user()->activites()->distinct()->pluck('secteur_id')->toArray();

            //Récupérer tous les activites de chaque domaine recuperé
            $activite_par_profil = DB::table('activites')->whereIn('secteur_id', $domaine_par_profil)->pluck('id')->toArray();

            $dernier_diplome_user = Auth::user()->diplome()->associate(Auth::user()->dernier_diplome)->diplome;
            if($dernier_diplome_user) {
                $annee_etude = $dernier_diplome_user->annee_etude;         
            } else {
                $annee_etude = 0;
            }
            $offre_par_profil = Opportunite::where('type', 'formation')->whereHas('activites', function($q) use ($activite_par_profil) {
                $q->whereIn('activites.id', $activite_par_profil);
            })->get([
                    'opportunites.id as id',
                    'title',
                    'echeance',
                    'entreprise_id',
                    'lieu',
                    'type',
                    "opportunites.slug as slug",
                    "opportunites.created_at as created_at",
                ]);
        }else{
            $offre_par_profil = Opportunite::where('id', '0')->get();
        }
        return $offre_par_profil;
    }
}
