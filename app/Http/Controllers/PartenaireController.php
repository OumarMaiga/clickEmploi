<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class PartenaireController extends Controller
{
    
    protected $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->middleware('onlyAdmin', ['only' => ['index', 'create', 'store', 'destroy']]);
        $this->userRepository = $userRepository;
    }

    public function index() {
        $partenaires = $this->userRepository->getByType('partenaire');
        return view('partenaires.index', compact('partenaires'));
    }

    public function create() {
        return view('partenaires.create');
    }

    public function store(Request $request) {

        $request->validate([
            'telephone' => 'required|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6'
        ]);

        $request->merge([
            'type' => 'partenaire',
            'password' => Hash::make($request->get('password')),
            ]);
            
        $partenaire = $this->userRepository->store($request->all());
        return redirect('/dashboard/partenaire')->withStatus("Nouveau partenaire (".$partenaire->prenom." ".$partenaire->nom.") vient d'être ajouté");
    }

    public function edit($email) {
        $partenaire = $this->userRepository->getByEmail($email);
        return view('partenaires.edit', compact('partenaire'));
    }

    public function update(Request $request, $id) {
        $this->userRepository->update($id, $request->all());
        return redirect('/dashboard/partenaire')->withStatus("Partenaire ".$request->input('prenom')." ".$request->input('nom')." a bien été modifier");
    }

    public function show($email) {
        $partenaire = $this->userRepository->getByEmail($email);
        return view('partenaires.show', compact('partenaire'));
    }

    public function destroy($id) {
		$this->userRepository->destroy($id);
        return redirect()->back();
    } 
}
