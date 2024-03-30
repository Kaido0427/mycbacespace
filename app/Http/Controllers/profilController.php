<?php

namespace App\Http\Controllers;

use App\Models\avatar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class profilController extends Controller
{


    public function updatePassword()
    {
        //mettre a jour sa photo de profil 
    }

    public function updateData()
    {
        //Metttre a jour les informations que le client a  entreer lors de 'l'inscription
    }

    public function storeOrUpdateImage(Request $request)
    {
        // Valider les données de la requête
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Assurez-vous que l'image est valide
        ]);

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

                // Enregistrement d'un log pour la mise à jour réussie de la photo de profil
                Log::info('Photo de profil mise à jour avec succès pour l\'utilisateur: ' . $user->id);

                // Retourner une réponse réussie
                return redirect()->route('home')->with('success', 'Photo de profil mise à jour avec succès');
            } else {
                // Retourner une réponse d'erreur si aucun fichier n'a été téléchargé
                return redirect()->route('home')->with('error', 'Aucune image n\'a été téléchargée.');
            }
        } catch (\Exception $e) {
            // En cas d'erreur, enregistrer un log d'erreur
            Log::error('Erreur lors de la mise à jour de la photo de profil pour l\'utilisateur: ' . $user->id . '. Message d\'erreur: ' . $e->getMessage());

            // Retourner une réponse d'erreur
            return redirect()->route('home')->with('error', 'Une erreur est survenue lors de la mise à jour de la photo de profil. Veuillez réessayer.');
        }
    }



    public function addPicture()
    {
        return view('profil.addPhoto');
    }
}
