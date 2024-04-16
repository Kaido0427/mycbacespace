<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class CheckPayement
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
        if (Auth::user()->user_type === "admin") {
            // L'utilisateur est un administrateur, je lui donne l'accès
            return $next($request);
        } elseif (!Auth::user()->hasPaid()) {
            // L'utilisateur est connecté mais n'a pas encore effectué de paiement
            if ($request->is('subscription')) {
                // L'utilisateur tente d'accéder à la page de souscription ou de paiement, je lui donne l'accès
                return $next($request);
            } else {
                // Je redirige l'utilisateur vers la page de souscription
                return redirect()->route('subscription')->with('error', 'Vous devez effectuer un paiement avant d\'accéder à cette page.');
            }
        }

        return $next($request);
    }
}
