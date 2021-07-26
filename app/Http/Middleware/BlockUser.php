<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlockUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
         if (Auth::check()) {
            if (Auth::user()->etat == false) {    
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect('login')->withDenied('Votre compte a été suspendu');
            }
        }
        return $next($request);
    }
}
