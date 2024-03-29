<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //J'affiche le tableau de bord a l'utilisateur en fonction de son type 
        //apres sa connexion
        $role = auth()->user()->user_type;
        $clients = User::where('user_type', "client")->get();

        if ($role == "admin") {
            return view('admindash', compact('clients'));
        } else {
            return view('dashboard');
        }
    }
}
