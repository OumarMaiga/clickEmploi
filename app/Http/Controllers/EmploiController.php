<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Repositories\OpportuniteRepository;
use App\Repositories\EntrepriseRepository;
use App\Repositories\PostuleRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\File;
use App\Models\Opportunite;
use App\Models\Secteur;

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
        $emplois = $this->opportuniteRepository->getByType('emploi');
        return view('emplois.index', compact('emplois'));
    }
    
    public function create() {
        $user = Auth::user();
        $domaines = Secteur::select('id', 'libelle', 'slug')->distinct()->get();
        $entreprises = $this->entrepriseRepository->getByForeignId('user_id', $user->id);
        return view('emplois.create', compact('entreprises', 'domaines'));
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
            'type' => 'emploi',
            'slug' => $slug,
            'user_id' => Auth::user()->id,
        ]);
        
        $opportunite = $this->opportuniteRepository->store($request->all());
        
        if ($request->has('secteur')) {
            $secteurs = $request->input('secteur');
            $relation = $opportunite->secteurs()->sync($secteurs);
        }

        return redirect('/dashboard/emploi')->withStatus("Nouveau emploi publié");
    }

    public function edit($slug) {
        $emploi = $this->opportuniteRepository->getBySlug($slug);
        $user = Auth::user();
        $entreprises = $this->entrepriseRepository->getByForeignId('user_id', $user->id);
        return view('emplois.edit', compact('emploi', 'entreprises'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'entreprise_id' => 'required',
        ]);
        $this->opportuniteRepository->update($id, $request->all());

        return redirect('/dashboard/emploi')->withStatus("Emploi a bien été mise à jour");
    }

    public function show($slug) {
        $opportunite = $this->opportuniteRepository->getBySlug($slug);
        $entreprise = $this->entrepriseRepository->getById($opportunite->entreprise_id);
        $postulants = $this->postuleRepository->getByForeignId('opportunite_id', $opportunite->id);
        $secteurs = $opportunite->secteurs->pluck('libelle');
        return view('emplois.show', compact('opportunite', 'entreprise', 'postulants', 'secteurs'));
    }
    
    public function detail($slug) {
        $opportunite = $this->opportuniteRepository->getBySlug($slug);
        $entreprise = $this->entrepriseRepository->getById($opportunite->entreprise_id);
        $opportunite_similaires = Opportunite::where('poste', $opportunite->poste)->limit(4)->get();
        $secteurs = $opportunite->secteurs->pluck('libelle');
        return view('pages.detail', compact('opportunite', 'entreprise', 'opportunite_similaires', 'secteurs'));
    }

    public function destroy($id) {
		$this->opportuniteRepository->destroy($id);
        return redirect()->back();
    }
    
    public function list()
    {
        $opportunites = $this->opportuniteRepository->getByType('emploi');
        return view('pages/home', compact('opportunites'));
    }
}
