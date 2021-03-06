<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();
        if(Auth::user()->type === "admin" || Auth::user()->type === "partenaire") {
            return redirect('/dashboard')->withWelcome("Bienvenue <strong>".Auth::user()->prenom." ".Auth::user()->nom."</strong>");
        } else {
            // On verifie si le user n'a pas un abonnement actif on retourne une session flash  
            if(is_abonnee(Auth::user()->id)){
                return redirect()->intended(RouteServiceProvider::HOME);
            } else {
                return redirect()->intended(RouteServiceProvider::HOME)->withAbonnement("");
            }
        }

    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
