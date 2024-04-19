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
        try {
            // Valider les données de la requête
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,bmp,svg,webp,ico|max:2048',
            ]);
        } catch (ValidationException $e) {
            // En cas d'erreur de validation, enregistrer un log d'erreur
            Log::error('Erreur de validation de la photo de profil pour l\'utilisateur: ' . Auth::id() . '. Message d\'erreur: ' . $e->getMessage());

            // Retourner une réponse JSON d'erreur
            return response()->json(['success' => false, 'message' => 'Le format de l\'image n\'est pas valide. Veuillez réessayer.']);
        }

        try {
            // Récupérer l'utilisateur connecté
            $user = Auth::user();

            // Vérifier si un fichier a été téléchargé
            if ($request->hasFile('image')) {
                // Traitement de l'image
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('avatars'), $imageName);

                // Vérifier si l'utilisateur a déjà un avatar
                if ($user->avatar) {
                    // Mettre à jour l'avatar existant
                    $avatar = $user->avatar;

                    // Supprimer l'ancienne photo de profil du dossier avatars
                    if (file_exists(public_path('avatars/' . $avatar->image))) {
                        unlink(public_path('avatars/' . $avatar->image));
                    }

                    // Mettre à jour l'avatar avec la nouvelle photo
                    $avatar->image = $imageName;
                    $avatar->save();
                } else {
                    // Créer un nouvel avatar s'il n'existe pas encore
                    $avatar = new Avatar();
                    $avatar->user_id = $user->id;
                    $avatar->image = $imageName;
                    $avatar->save();
                }

                Log::info('Photo de profil mise à jour avec succès pour l\'utilisateur: ' . $user->id);

                // Retourner une réponse JSON réussie
                return response()->json(['success' => true, 'message' => 'Photo de profil mise à jour avec succès', 'imageName' => $imageName]);
            } else {
                // Retourner une réponse JSON d'erreur si aucun fichier n'a été téléchargé
                return response()->json(['success' => false, 'message' => 'Aucune image n\'a été téléchargée.']);
            }
        } catch (\Exception $e) {
            // En cas d'erreur, enregistrer un log d'erreur
            Log::error('Erreur lors de la mise à jour de la photo de profil pour l\'utilisateur: ' . $user->id . '. Message d\'erreur: ' . $e->getMessage());

            // Retourner une réponse JSON d'erreur
            return response()->json(['success' => false, 'message' => 'Une erreur est survenue lors de la mise à jour de la photo de profil. Veuillez réessayer.']);
        }
    }

    public function tasks()
    {
        $procedures = Procedure::where('user_id', auth()->user()->id)->get();

        return view('dashbord', compact('procedures
        '));
    }


    public function docsUpload(Request $request)
    {
        Log::info('Début de la fonction docsUpload');

        $validator = Validator::make($request->all(), [
            'doc_client' => 'required|file',
            'tache_id' => 'required|exists:procedures,tache_id',
        ]);

        Log::info('Validation des données');

        if ($validator->fails()) {
            Log::error('Erreur de validation', ['errors' => $validator->errors()]);
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $procedure = Procedure::where('tache_id', $request->tache_id)->first();

        Log::info('Recherche de la procédure : ', ['procedure' => $procedure]);

        if (!$procedure) {
            Log::error('Tâche non trouvée pour l\'ID : ' . $request->tache_id);
            return response()->json(['error' => 'tache non trouvée'], 404);
        }

        if ($procedure->doc_client) {
            // Supprimer le fichier existant
            $existingDocPath = public_path('document_clients/' . $procedure->doc_client);
            if (file_exists($existingDocPath)) {
                unlink($existingDocPath);
            }
        }

        Log::info('Téléchargement du fichier pour la tâche : ' . $request->tache_id);

        $doc = $request->file('doc_client');
        $docName = time() . '.' . $doc->getClientOriginalExtension();
        $doc->move(public_path('document_clients'), $docName);
        $ext = $doc->getClientOriginalExtension();
        $procedure->doc_client = $docName;
        $procedure->status = "soumis";
        $procedure->save();

        Log::info('Mise à jour de la procédure pour la tâche : ', ['procedure' => $procedure]);

        $tache = $procedure->tache;

        Log::info('tache: ', ['tache' => $tache]);

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
        $validator = Validator::make($request->all(), [
            'doc_traité' => 'required|file',
            'tache_id' => 'required|exists:procedures,tache_id',
        ]);

        if ($validator->fails()) {
            Log::error("Échec de la validation : " . $validator->errors());
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            $procedure = Procedure::where('tache_id', $request->tache_id)->first();

            if (!$procedure) {
                Log::error("La procédure n'existe pas pour l'ID de tâche : {$request->tache_id}");
                return response()->json(['error' => 'La procédure n\'existe pas'], 404);
            }

            $procedure->load('tache');

            if ($procedure->doc_traité) {
                // Supprimer le fichier existant
                $existingDocPath = public_path('document_traités/' . $procedure->doc_traité);
                if (file_exists($existingDocPath)) {
                    unlink($existingDocPath);
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
                'message' => '' . $procedure->tache->nom_tache . ' a été traité avec succès! Merci de consulter le panel tâche pour télécharger votre document ',
                'user_id' => $procedure->user_id,
            ]);

            // Récupérer l'utilisateur associé à la procédure sélectionnée
            $user = $procedure->user;

            // Récupérer toutes les procédures de cet utilisateur
            $procedures = $user->procedures()->with('tache')->get();

            // Récupérer toutes les tâches uniques associées à ces procédures
            $taches = $procedures->pluck('tache')->unique();

            // Renvoie la réponse à la requête AJAX avec les procédures, les tâches et l'URL du fichier
            return response()->json([
                'message' => 'Téléchargement effectué avec succès',
                'procedure' => $procedure,
                'tache' => $procedure->tache,
                'procedures' => $procedures,
                'taches' => $taches
            ]);
        } catch (\Exception $e) {
            Log::error("Erreur lors du traitement de la requête : " . $e->getMessage());
            return response()->json(['error' => 'Erreur lors du traitement de la requête'], 500);
        }
    }
}
