<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use App\Repositories\DiplomeRepository;
use App\Models\User;
use App\Models\Secteur;
use App\Models\Abonnee;

class RegisteredUserController extends Controller
{    
    protected $diplomeRepository;

    public function __construct(DiplomeRepository $diplomeRepository) {
        $this->diplomeRepository = $diplomeRepository;
    }
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $domaines = Secteur::select('id', 'libelle', 'slug')->distinct()->get();
        $diplomes = $this->diplomeRepository->get();
        return view('auth.register', compact('domaines', 'diplomes'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'telephone' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::min(8)],
            'annee_experience' => 'sometimes|numeric|between:0,20'
        ]);

        $request->merge([
            'password' => Hash::make($request->password),
            'type' => 'user',
        ]);

        $inputs = $request->all();

        $user = User::create($inputs);

        if ($request->has('secteur')) {
            $secteurs = $request->input('secteur');
            $relation = $user->secteurs()->sync($secteurs);
        }

        //Enregistrer user comme abonné
        if ($request->alert_sms) {
            // Calcul de 1 mois apres aujourd'hui
            $date = date('Y-m-d', strtotime("+ 1 month"));
            Abonnee::create([
                'type' => 'mois',
                'user_id' => $user->id,
                'etat' => 'encours',
                'date_fin' => $date,
            ]);
        }
        
        event(new Registered($user));

        Auth::login($user);
        
        // On verifie si le user n'a  pas un abonnement actif on retourne une session flash  
        if(is_abonnee(Auth::user()->id)){
            return redirect('/home');
        } else {
            return redirect('/home')->withAbonnement("");
        }
    }
}
