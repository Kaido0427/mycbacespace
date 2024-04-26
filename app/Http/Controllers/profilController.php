<?php

namespace App\Http\Controllers;

use App\Models\avatar;
use App\Models\Notification;
use App\Models\procedure;
use App\Models\User;
use App\Notifications\myNotifs;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class profilController extends Controller
{


    public function updatePassword(Request $request)
    {
        $request->validate([
            'oldPass' => 'required',
            'newPass' => 'required',
            'verifyPass' => 'required|same:newPass',
        ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->newPass)]);

        // Déconnecter l'utilisateur
        Auth::logout();

        // Invalider la session
        $request->session()->invalidate();

        // Regénérer le token CSRF
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('status', 'Password updated successfully');
    }

    public function checkPassword(Request $request)
    {
        if (!Hash::check($request->password, auth()->user()->password)) {
            return response()->json(['status' => 'error', 'message' => 'Le mot de passe actuel est incorrect']);
        }

        return response()->json(['status' => 'success']);
    }


    public function updateUserData(Request $request)
    {
        Log::info('Updating user data', ['data' => $request->all()]);

        $user = User::find(auth()->user()->id);

        $user->update([
            'nom' => $request->input('nom'),
            'prenoms' => $request->input('prenoms'),
            'adresse' => $request->input('adresse'),
            'bp' => $request->input('bp'),
            'telephone' => $request->input('telephone'),
        ]);

        Log::info('User data updated ', ['user' => $user]);

        // Renvoie les données mises à jour dans la réponse JSON
        return response()->json([
            'success' => true,
            'message' => 'Vos informations ont été mises à jour avec succès.',
            'nom' => $user->nom,
            'prenoms' => $user->prenoms,
            'adresse' => $user->adresse,
            'bp' => $user->bp,
            'telephone' => $user->telephone
        ], 200);
    }


    public function storeOrUpdateImage(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,bmp,svg,webp,ico|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('avatars/' . $imageName);

            // Déplacer la nouvelle image vers le dossier avatars
            $image->move(public_path('avatars'), $imageName);

            // Vérifier si l'utilisateur a déjà un avatar
            if ($user->avatar) {
                // Supprimer l'ancienne image si elle existe
                $oldImagePath = public_path('avatars/' . $user->avatar->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }

                // Mettre à jour l'avatar existant
                $user->avatar->image = $imageName;
                $user->avatar->save();
            } else {
                // Créer un nouvel avatar
                $user->avatar()->create([
                    'image' => $imageName,
                ]);
            }

            Log::info('Photo de profil mise à jour avec succès pour l\'utilisateur: ' . $user->id);
            return response()->json([
                'success' => true,
                'message' => 'Photo de profil mise à jour avec succès',
                'imageName' => $imageName,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Aucune image n\'a été téléchargée.',
        ]);
    }

    public function tasks()
    {
        $procedures = Procedure::where('user_id', auth()->user()->id)
            ->with('tache')
            ->get()
            ->map(function ($procedure) {
                return [
                    'id' => $procedure->id,
                    'tache' => [
                        'id' => $procedure->tache->id,
                        'nom_tache' => $procedure->tache->nom_tache,
                        'description' => $procedure->tache->description,
                    ],
                    'doc_client' => $procedure->doc_client,
                    'doc_traité' => $procedure->doc_traité,
                    'status' => $procedure->status,
                ];
            });

        return response()->json($procedures);
    }

    public function docsUpload(Request $request)
    {
        Log::info('Début de la fonction docsUpload');

        $validatedData = $request->validate([
            'doc_client' => 'required|file',
            'tache_id' => 'required|exists:procedures,tache_id',
        ]);

        $procedure = Procedure::where('tache_id', $request->tache_id)->firstOrFail();

        Log::info('Recherche de la procédure : ', ['procedure' => $procedure]);

        if ($procedure->doc_client) {
            // Supprimer le fichier existant
            $existingDocPath = public_path('document_clients/' . $procedure->doc_client);
            if (File::exists($existingDocPath)) {
                File::delete($existingDocPath);
            }
        }

        Log::info('Téléchargement du fichier pour la tâche : ' . $request->tache_id);

        $doc = $request->file('doc_client');
        $docName = time() . '.' . $doc->getClientOriginalExtension();
        $doc->move(public_path('document_clients'), $docName);
        $procedure->doc_client = $docName;
        $procedure->status = "soumis";
        $procedure->save();

        Log::info('Mise à jour de la procédure pour la tâche : ', ['procedure' => $procedure]);

        $tache = $procedure->tache;

        Log::info('tache: ', ['tache' => $tache]);

        Notification::create([
            'message' => $procedure->tache->nom_tache . ' a été soumis avec succès! Merci de patienter durant le traitement de votre document ',
            'user_id' => $procedure->user_id,
            'status' => $procedure->status
        ]);

        // Créer l'URL du fichier téléchargé
        $fileUrl = asset('document_clients/' . $docName);

        Log::info('Création de l\'URL du fichier téléchargé pour la tâche : ' . $request->tache_id);

        return response()->json([
            'message' => 'Téléchargement effectué avec succès',
            'file_url' => $fileUrl,
            'procedure' => $procedure,
            'tache' => [
                'id' => $tache->id,
                'nom_tache' => $tache->nom_tache,
                'description' => $tache->description,
            ]
        ]);
    }

    public function treatUpload(Request $request)
    {
        $validatedData = $request->validate([
            'doc_traité' => 'required|file',
            'tache_id' => 'required|exists:procedures,tache_id',
        ]);

        $procedure = Procedure::where('tache_id', $request->tache_id)->with('tache', 'user')->firstOrFail();

        if ($procedure->doc_traité) {
            // Supprimer le fichier existant
            $existingDocPath = public_path('document_traités/' . $procedure->doc_traité);
            if (File::exists($existingDocPath)) {
                File::delete($existingDocPath);
            }
        }

        $doc = $request->file('doc_traité');
        $docName = time() . '.' . $doc->getClientOriginalExtension();
        $doc->move(public_path('document_traités'), $docName);

        $procedure->doc_traité = $docName;
        $procedure->status = "Terminé";
        $procedure->save();

        // Créer l'URL du fichier téléchargé
        $fileUrl = asset('document_traités/' . $docName);

        Notification::create([
            'message' => $procedure->tache->nom_tache . ' a été traité avec succès! Merci de consulter le panel tâche pour télécharger votre document ',
            'user_id' => $procedure->user_id,
            'status' => $procedure->status
        ]);

        $user = $procedure->user;
        $procedures = $user->procedures()->with('tache')->get();
        $taches = $procedures->pluck('tache')->unique();

        return response()->json([
            'message' => 'Téléchargement effectué avec succès',
            'procedure' => $procedure,
            'nouveau_statut' => $procedure->status,
            'tache' => $procedure->tache,
            'procedures' => $procedures,
            'taches' => $taches
        ]);
    }
}
