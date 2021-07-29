<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Secteur;
use App\Models\Diplome;
use App\Models\Activite;
use App\Models\User;

use App\Repositories\UserRepository;

use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    
    protected $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->middleware('onlyAdmin', ['only' => ['destroy', 'changeState']]);
        $this->middleware('adminAndPartenaireOnly', ['only' => ['index', 'show']]);
        $this->userRepository = $userRepository;
    }

    public function index() {
        $users = $this->userRepository->getByType('user');
        $secteurs = Secteur::orderBy('libelle', 'asc')->get();
        $diplomes = Diplome::orderBy('libelle', 'asc')->get();
        $annee_experience = Auth::user()->annee_experience;
        
        return view('dashboards.users.index', compact('users', 'secteurs', 'diplomes'));
    }

    public function show($email) {
        $user = $this->userRepository->getByEmail($email);
        $photo = photo_profil($user->email);
        $activites = $user->activites->pluck('libelle');
        return view('dashboards.users.show', compact('user', 'photo', 'a$activites'));
    }

    public function destroy($id) {
		$this->userRepository->destroy($id);
        return redirect()->back()->withError("l'utilisateur a bien été supprimer");;
    } 
    
    public function changeState($id, Request $request) {

        $user = $this->userRepository->getById($id);
        if($user->etat == true)
        {
            $etat = false;
        } else {
            $etat = true;
        }
        
        $request->merge([
            'etat' => $etat
        ]);

        $this->userRepository->update($id, $request->all());
        
        return redirect("/dashboard/user/$user->email")->withStatus("L'état de l'utilisateur vient d'être changer");

    }

    public function filter(Request $request) {
        $users = User::where('etat', true)->where('type', 'user');
        $diplome = Diplome::where('slug', $request->diplome)->first();
        $secteur = Secteur::where('slug', $request->secteur)->first();
        if ($secteur) {
            $activite_ids = Activite::where('secteur_id', $secteur->id)->pluck('id')->toArray();
        }else{
            $activite_ids = [];
        }
        if($request->has('secteur')){
            if ($secteur != null) {
                $users = User::join('activite_user', 'users.id', '=', 'activite_user.user_id')->whereIn('activite_user.activite_id', $activite_ids)->distinct('id');
            }
        }
        if($request->has('diplome')){
            if ($diplome != null) {
                $users = $users->where('dernier_diplome', $diplome->id);
            }
        }
        $users = $users->orderBy('nom', 'asc')->get();
        
        $secteurs = Secteur::orderBy('libelle', 'asc')->get();
        $diplomes = Diplome::orderBy('libelle', 'asc')->get();

        $request->session()->flash('filter_user', $users);

        return view('dashboards.users.index', compact('users', 'secteurs', 'diplomes'));
    }

    public function export() {
        $data = Session::get('filter_user');
        return Excel::download(new UsersExport($data), 'users.xlsx');
    }

}
