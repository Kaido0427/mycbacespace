<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\tache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class adminController extends Controller
{

    //======================================SECTION ADMINISTRATEUR===============================
    public function relanceTache(Request $request)
    {
        try {
            $tacheId = $request->input('tache_id');
            $tacheWithPendingClients = Tache::with(['procedures' => function ($query) {
                $query->whereNull('doc_client');
            }])->findOrFail($tacheId);

            foreach ($tacheWithPendingClients->procedures as $procedure) {
                Notification::create([
                    'message' => 'Vous n\'avez pas encore effectué la tâche concernant ' . $procedure->tache->nom_tache . '. Veuillez fournir le document demandé.',
                    'user_id' => $procedure->user->id
                ]);
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Vous pouvez enregistrer le message d'erreur dans un journal ou effectuer d'autres actions en cas d'exception
            Log::error('Error in relanceTache: ' . $e->getMessage());

            // Retourner une réponse d'erreur appropriée
            return response()->json(['error' => 'Une erreur s\'est produite lors de la relance de la tâche. Veuillez réessayer plus tard.'], 500);
        }
    }




    //============================================SECTION CLIENT=================================


    public function historyTransactions()
    {
        // pour voir l'histrorique des transactions effectués sur un periode donnée
    }
}
