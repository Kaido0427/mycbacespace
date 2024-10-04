<?php

namespace App\Http\Controllers;

use App\Models\payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class payController extends Controller
{

    public function pay(Request $request)
    {
        //Je recupere les informations de la transaction effetué depuis le widget dans la vue
        //Puis je les enregistrent dans les tables transactions,et article_transactions

        $public_key = config('kkiapay.public_key');
        $private_key = config('kkiapay.private_key');
        $secret = config('kkiapay.secret');
        $sandbox = config("kkiapay.sandbox");

        $kkiapay = new \Kkiapay\Kkiapay(
            $public_key,
            $private_key,
            $secret,
            $sandbox
        );
        $transactionData = $request->all();
        Log::info($request->all()); 

        $transactionId = $transactionData['transaction_id'];

        $transactionDetails = $kkiapay->verifyTransaction($transactionId);

        Log::info(get_object_vars($transactionDetails));
        if ($transactionDetails->status === 'SUCCESS') {
            // Enregistre les données de la transaction dans la base de données
            payment::create([
                'montant' => $transactionDetails->amount,
                'status' => $transactionDetails->status,
                'transaction_id' => $transactionId ?? null,
                'user_id' => auth()->user()->id,
            ]);

            return redirect()->route('mails.index')->with('success', 'Le mail a été envoyé avec succès ! Consultez votre boîte mail');
        } else {
            // Gérer le cas où la transaction a échoué
            return redirect()->route('mails.error')->with('error', 'Une erreur est survenu lors de la transaction');
        }
    }
}
