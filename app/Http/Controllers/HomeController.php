<?php

namespace App\Http\Controllers;

use App\Models\procedure;
use App\Models\tache;
use App\Models\User;
use App\Notifications\TaskRelanceNotification;
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
        $client = null;
        $user = auth()->user();

        // Je récupère mon rôle d'utilisateur connecté
        $role = $user->user_type;

        // Je récupère la liste des clients
        $clients = User::where('user_type', 'client')->get();

        // Je récupère toutes les tâches et les procédures associées ayant doc_client égal à null
        $tachesWithPendingClients = Tache::with(['procedures' => function ($query) {
            // Je filtre les procédures pour récupérer uniquement celles où doc_client est null
            $query->whereNull('doc_client');
        }])
            ->get();

        // J'affiche le tableau de bord en fonction de mon rôle d'utilisateur
        if ($role === 'admin') {
            return view('admindash', compact('clients', 'client', 'role', 'user', 'tachesWithPendingClients'));
        } else {
            return view('dashboard', compact('user'));
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
