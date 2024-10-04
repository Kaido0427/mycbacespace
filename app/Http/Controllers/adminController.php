<?php

namespace App\Http\Controllers;
 
use App\Models\notification;
use App\Models\tache;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class adminController extends Controller
{ 

    //======================================SECTION ADMINISTRATEUR===============================
    public function relanceTache(Request $request)
    {
        try {
            $tacheId = $request->input('tache_id');
            $tacheWithPendingClients = Tache::with(['procedures' => function ($query) {
                $query->where('doc_client', '=', DB::raw("''"))
                    ->orWhereNull('doc_client');
            }])->findOrFail($tacheId);

            foreach ($tacheWithPendingClients->procedures as $procedure) {
                // Vérifier si une notification existe déjà pour cet utilisateur et cette tâche
                $existingNotification = notification::where('user_id', $procedure->user->id)
                    ->where('message', 'LIKE', '%' . $procedure->tache->nom_tache . '%')
                    ->first();

                if ($existingNotification) {
                    // Mise à jour de la notification existante avec un nouveau message
                    $existingNotification->update([
                        'message' => 'Nous attendons toujours la soumission ou l\'accomplissement de ' . $procedure->tache->nom_tache,
                        'last_updated_at'=>now()
                    ]);
                } else {
                    // Création d'une nouvelle notification
                    Notification::create([
                        'message' => 'Vous n\'avez pas encore effectué la tâche concernant ' . $procedure->tache->nom_tache . '. Veuillez fournir le document demandé.',
                        'user_id' => $procedure->user->id,
                        'status' => $procedure->status
                    ]);
                }
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Vous pouvez enregistrer le message d'erreur dans un journal ou effectuer d'autres actions en cas d'exception
            Log::error('Error in relanceTache: ' . $e->getMessage());

            // Retourner une réponse d'erreur appropriée
            return response()->json(['error' => 'Une erreur s\'est produite lors de la relance de la tâche. Veuillez réessayer plus tard.'], 500);
        }
    }


    public function searchClients(Request $request)
    {
        $searchQuery = $request->input('query');

        $clients = User::where('user_type', 'client')
            ->where(function ($query) use ($searchQuery) {
                $query->where('prenoms', 'like', "%{$searchQuery}%")
                    ->orWhere('nom', 'like', "%{$searchQuery}%")
                    ->orWhereHas('procedures.categorie', function ($subquery) use ($searchQuery) {
                        $subquery->where('nom_categorie', 'like', "%{$searchQuery}%");
                    });
            })
            ->get();

        return response()->json($clients);
    }



    //============================================SECTION CLIENT=================================


    public function historyTransactions()
    {
        // pour voir l'histrorique des transactions effectués sur un periode donnée
    }
}
