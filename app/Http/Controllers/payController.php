<?php

namespace App\Http\Controllers;

use App\Models\payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class payController extends Controller
{

    public function paySign(Request $request)
    {
        $montant = $request->input('montant');
        $user = auth()->user();

        try {
            \FedaPay\FedaPay::setApiKey("sk_sandbox_PpbR6paPMzU_riHeOcUxG1th");
            \FedaPay\FedaPay::setEnvironment('sandbox');

            $transaction = \FedaPay\Transaction::create(array(
                "description" => 'Transaction de ' . $user->nom,
                "amount" => $montant,
                "currency" => ["iso" => "XOF"],
                "callback_url" => "https://127.0.0.1:8000/successTrans",
                "customer" => [
                    "firstname" => $user->prenoms,
                    "lastname" => $user->nom,
                    "email" => $user->email,
                    "phone_number" => [
                        "number" => $user->telephone,
                        "country" => "bj"
                    ]
                ]
            ));

            Log::info("Transaction créée avec succès. ID de transaction : " . $transaction->id);
            Log::info("Montant de la transaction : " . $montant);
            Log::info("Nom du client : " . $user->nom);
            Log::info("Prénoms du client : " . $user->prenoms);
            Log::info("Email du client : " . $user->email);
            Log::info("Téléphone du client : " . $user->telephone);

            $transaction = \FedaPay\Transaction::retrieve($transaction->id);
            $transaction->sendNow(['transaction_id' => $transaction->id]);
            Log::info("Transaction envoyée avec succès. ID de transaction : " . $transaction->id);

            return redirect()->route('payment.success')->with('success', 'La transaction a été créée avec succès. ID de transaction : ' . $transaction->id);
        } catch (\FedaPay\Error\ApiConnection $e) {
            Log::error("Erreur de connexion à l'API : " . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur de connexion à l\'API : ' . $e->getMessage());
        } catch (\FedaPay\Error\ApiConnection $e) {
            Log::error("Erreur API : " . $e->getMessage());
            return redirect()->back()->with('error', 'Erreur API : ' . $e->getMessage());
        } catch (\Exception $e) {
            Log::error("Une erreur est survenue : " . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }

    public function transactionCallback(Request $request)
    {
        try {
            // Vérifier si le statut de la transaction est approuvé
            if ($request->status == 'approved') {
                // Enregistrer les données de paiement avec le statut approuvé
                Payment::create([
                    'montant' => $request->amount,
                    'transaction_id' => $request->transaction_id,
                    'devise' => 'XOF', // Assurez-vous d'adapter cela en fonction de vos besoins
                    'user_id' => auth()->id(), // Supposons que vous utilisez l'authentification de Laravel
                    'statut' => 'approved'
                ]);
            } elseif ($request->status == 'transferred') {
                // Enregistrer les données de paiement avec le statut transféré
                Payment::create([
                    'montant' => $request->amount,
                    'transaction_id' => $request->transaction_id,
                    'devise' => 'XOF', // Assurez-vous d'adapter cela en fonction de vos besoins
                    'user_id' => auth()->id(), // Supposons que vous utilisez l'authentification de Laravel
                    'statut' => 'transferred'
                ]);
            } elseif ($request->status == 'refunded') {
                // Enregistrer les données de paiement avec le statut remboursé
                Payment::create([
                    'montant' => $request->amount,
                    'transaction_id' => $request->transaction_id,
                    'devise' => 'XOF', // Assurez-vous d'adapter cela en fonction de vos besoins
                    'user_id' => auth()->id(), // Supposons que vous utilisez l'authentification de Laravel
                    'statut' => 'refunded'
                ]);
            } elseif ($request->status == 'approved_partially_refunded') {
                // Enregistrer les données de paiement avec le statut partiellement remboursé
                Payment::create([
                    'montant' => $request->amount,
                    'transaction_id' => $request->transaction_id,
                    'devise' => 'XOF', // Assurez-vous d'adapter cela en fonction de vos besoins
                    'user_id' => auth()->id(), // Supposons que vous utilisez l'authentification de Laravel
                    'statut' => 'approved_partially_refunded'
                ]);
            } elseif ($request->status == 'transferred_partially_refunded') {
                // Enregistrer les données de paiement avec le statut partiellement transféré et partiellement remboursé
                Payment::create([
                    'montant' => $request->amount,
                    'transaction_id' => $request->transaction_id,
                    'devise' => 'XOF', // Assurez-vous d'adapter cela en fonction de vos besoins
                    'user_id' => auth()->id(), // Supposons que vous utilisez l'authentification de Laravel
                    'statut' => 'transferred_partially_refunded'
                ]);
            } else {
                // Enregistrer les données de paiement avec un statut par défaut si aucun des statuts ne correspond
                Payment::create([
                    'montant' => $request->amount,
                    'transaction_id' => $request->transaction_id,
                    'devise' => 'XOF', // Assurez-vous d'adapter cela en fonction de vos besoins
                    'user_id' => auth()->id(), // Supposons que vous utilisez l'authentification de Laravel
                    'statut' => 'unknown' // Ou tout autre statut par défaut approprié
                ]);
            }

            return response()->json(['message' => 'Transaction enregistrée avec succès.'], 200);
        } catch (\Exception $e) {
            // Log des autres exceptions
            return response()->json(['error' => 'Une erreur est survenue : ' . $e->getMessage()], 500);
        }
    }
}
