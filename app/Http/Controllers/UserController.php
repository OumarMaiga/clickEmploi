<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    
    protected $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->middleware('onlyAdmin', ['only' => ['index', 'show', 'destroy', 'changeState']]);
        $this->userRepository = $userRepository;
    }

    public function index() {
        $users = $this->userRepository->getByType('user');
        return view('users.index', compact('users'));
    }

    public function show($email) {
        $user = $this->userRepository->getByEmail($email);
        return view('users.show', compact('user'));
    }

    public function destroy($id) {
		$this->userRepository->destroy($id);
        return redirect()->back()->withError("l'utilisateur a bien été supprimer");;
    } 
    
    public function changeState($id, Request $request) {

        $user = $this->userRepository->getById($id);

        if($user->etat == true)
        {
            $request->merge([
                'etat' => false,
            ]);
        } else {
            $request->merge([
                'etat' => true,
            ]);
        }

        $this->userRepository->update($id, $request->all());
        
        return redirect("/dashboard/user/$user->email")->withStatus("L'état de l'utilisateur vient d'être changer");

    }
}
