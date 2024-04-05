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
        $client=null;
        // je  récupére le rôle de l'utilisateur connecté
        $role = auth()->user()->user_type;

        $user=auth()->user();

        // Je récupére la liste des clients
        $clients = User::where('user_type', 'client')->get();
        // j'affiche le tableau de bord en fonction du rôle de l'utilisateur
        if ($role === 'admin') {
            return view('admindash', compact('clients','client','role','user'));
        } else {
            return view('dashboard',compact('user'));
        }
    }


    public function subscription()
    {
        return view('abonement');
    }

    public function mailIndex()
    {
        return view('mails.index');
    }

    public function mailerror()
    {
        return view('mails.error');
    }
}
