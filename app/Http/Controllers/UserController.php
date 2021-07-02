<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\Secteur;
use App\Models\Diplome;
use App\Models\User;

use App\Exports\UsersExport;
use App\Exports\UsersExportCustom;
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
        return view('dashboards.users.index', compact('users', 'secteurs', 'diplomes'));
    }

    public function show($email) {
        $user = $this->userRepository->getByEmail($email);
        $photo = photo_profil($user->email);
        $secteurs = $user->secteurs->pluck('libelle');
        return view('dashboards.users.show', compact('user', 'photo', 'secteurs'));
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
        if($request->has('secteur')){
            if ($secteur != null) {
                $users = $secteur->users();
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

        return view('dashboards.users.index', compact('users', 'secteurs', 'diplomes'));
    }

    public function export() {
        /*$data = User::where('type', 'user')->get();
        $data_array[] = array('Prenom & Nom','Domaine d\'activité', 'Niveau d\'étude', 'Durée d\'experience');

        foreach ($data as $value) {
            $data_array[] = array(
                'Prenom & Nom' => $value->prenom." ".$value->nom,
                'Domaine d\'activité' => $value->prenom,
                'Niveau d\'étude' => $value->dernier_diplome,
                'Durée d\'experience' => $value->experience_professionnel,
            );
        }
        Excel::create('Utilisateur', function($excel) use($data_array){
            $excel->setTitle('Users');
            $excel->sheet('Données user', function($sheet) use ($data_array){
                $sheet->fromArray($data_array, null, 'A1', false, false);
            });
        })->download('xslx');*/
    /*return [
        (new UsersExport)->withFilename('users-' . time() . '.xlsx'),
    ];*/
    
    $data = User::where('type', 'user')->get();
        return Excel::download(new UsersExport($data), 'users.xlsx');
    }

    public function exportCustom() {
        $data = User::where('type', 'user')->get();
        return Excel::download(new UsersExportCustom($data), 'users.xlsx')->only('nom', 'email');
    }
}
