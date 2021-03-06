<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Repositories\EntrepriseRepository;
use App\Repositories\OpportuniteRepository;

use App\Models\File;
use App\Models\Entreprise;
use App\Models\Opportunite;

class EntrepriseController extends Controller
{
    protected $entrepriseRepository;
    protected $opportuniteRepository;

    public function __construct(EntrepriseRepository $entrepriseRepository, OpportuniteRepository $opportuniteRepository) {
        $this->middleware('adminAndPartenaireOnly', ['only' => ['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']]);
        $this->entrepriseRepository = $entrepriseRepository;
        $this->opportuniteRepository = $opportuniteRepository;
    }

    public function index() {
        $entreprises = $this->entrepriseRepository->getByForeignId('user_id', Auth::user()->id);        
        return view('entreprises.index', compact('entreprises'));
    }

    public function create() {
        return view('entreprises.create');
    }

    public function store(Request $request) {

        $request->validate([
            'libelle' => 'required|max:255',
        ]);


        $nbreLibelle = Entreprise::where('libelle', $request->libelle)->count();
        
        if ($nbreLibelle != '0') {
            $slug = Str::slug($request->get('libelle'))."-".$nbreLibelle;
        }
        else {
            $slug = Str::slug($request->get('libelle'));
        }

        $request->merge([
            'slug' => $slug,
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
        $image_entreprise = File::where('entreprise_id', $entreprise->id)->orderBy('id', 'desc')->first()->get('file_path');
        
        if (Auth::check()) {
            $activite_par_profil = Auth::user()->activites()->pluck('id')->toArray();

            $dernier_diplome_user = Auth::user()->diplome()->associate(Auth::user()->dernier_diplome)->diplome;
            if($dernier_diplome_user) {
                $annee_etude = $dernier_diplome_user->annee_etude;         
            } else {
                $annee_etude = 0;
            }
            $offre_par_profil = Opportunite::where('entreprise_id', $entreprise->id)->whereHas('activites', function($q) use ($activite_par_profil) {
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
        return view('entreprises.show', compact('entreprise', 'image_entreprise', 'offre_par_profil'));
    }

    public function detail($slug) {
        $entreprise = $this->entrepriseRepository->getBySlug($slug);
        $image_entreprise = File::where('entreprise_id', $entreprise->id)->select('file_path')->orderBy('id', 'desc')->first();
        $opportunites = $this->opportuniteRepository->getByForeignId('entreprise_id', $entreprise->id);
        $nbre_offres = $opportunites->count();
        
        if (Auth::check()) {
            $activite_par_profil = Auth::user()->activites()->pluck('id')->toArray();
            
            $dernier_diplome_user = Auth::user()->diplome()->associate(Auth::user()->dernier_diplome)->diplome;
            if($dernier_diplome_user) {
                $annee_etude = $dernier_diplome_user->annee_etude;         
            } else {
                $annee_etude = 0;
            }
            $offre_par_profil = Opportunite::where('entreprise_id', $entreprise->id)->whereHas('activites', function($q) use ($activite_par_profil) {
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
        return view('entreprises.detail', compact('entreprise', 'image_entreprise', 'nbre_offres', 'opportunites', 'offre_par_profil'));
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
