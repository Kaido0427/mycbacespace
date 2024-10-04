<?php

namespace Database\Seeders;

use App\Models\avatar;
use App\Models\categorie;
use App\Models\service;
use App\Models\tache;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class start extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['nom_categorie' => 'Individuel'],
            ['nom_categorie' => 'Société civile immobilière'],
            ['nom_categorie' => 'Société Anonyme'],
            ['nom_categorie' => 'GIE'],
            ['nom_categorie' => 'Société de fait'],
            ['nom_categorie' => 'SNC'],
            ['nom_categorie' => 'Entreprenant'],
            ['nom_categorie' => 'Société par action simplifiée'],
            ['nom_categorie' => 'Syndicat'],
            ['nom_categorie' => 'EARL'],
            ['nom_categorie' => 'SARL'],
            ['nom_categorie' => 'Coopérative'],
            ['nom_categorie' => 'Association organisme'],
        ];

        Categorie::insert($categories);

        $services = [
            ['nom_service' => 'Assistant comptable et fiscale'],
            ['nom_service' => 'Tenue de la comptabilité'],
            ['nom_service' => 'Conseils et formation pratique en gestion'],
            ['nom_service' => 'Etude de micro projet d\'investissement'],
            ['nom_service' => 'Evaluation économique et financière des PME et PMI'],
            ['nom_service' => 'Autres prestation (à préciser dans la lettre de mission)'],
        ];

        Service::insert($services);

        $categorieIds = Categorie::pluck('id')->toArray();

        $taches = [
            ['nom_tache' => 'pièces d\'identité', 'description' => 'Copies des pièces d\'identité des dirigeants et associés.', 'categorie_id' => $categorieIds[0]],
            ['nom_tache' => 'justificatifs de domicile', 'description' => 'Justificatifs de domicile des dirigeants et de la société.', 'categorie_id' => $categorieIds[0]],
            ['nom_tache' => 'statuts de la société', 'description' => 'Statuts signés et datés de la société.', 'categorie_id' => $categorieIds[1]],
            ['nom_tache' => 'comptes annuels', 'description' => 'Derniers comptes annuels approuvés de la société.', 'categorie_id' => $categorieIds[1]],
            ['nom_tache' => 'documents d\'immatriculation', 'description' => 'Copies des documents d\'immatriculation de la société au registre du commerce.', 'categorie_id' => $categorieIds[2]],
            ['nom_tache' => 'procès-verbaux d\'assemblée', 'description' => 'Copies des procès-verbaux des assemblées générales.', 'categorie_id' => $categorieIds[2]],
            ['nom_tache' => 'documents constitutifs', 'description' => 'Copies des documents constitutifs de la société.', 'categorie_id' => $categorieIds[3]],
            ['nom_tache' => 'déclarations légales', 'description' => 'Copies des déclarations légales effectuées par la société.', 'categorie_id' => $categorieIds[3]],
            ['nom_tache' => 'documents de fondation', 'description' => 'Copies des documents de fondation de la société.', 'categorie_id' => $categorieIds[4]],
            ['nom_tache' => 'procès-verbaux des réunions', 'description' => 'Copies des procès-verbaux des réunions du conseil d\'administration.', 'categorie_id' => $categorieIds[4]],
            ['nom_tache' => 'documents d\'inscription au registre', 'description' => 'Copies des documents d\'inscription au registre du commerce.', 'categorie_id' => $categorieIds[5]],
            ['nom_tache' => 'déclarations fiscales', 'description' => 'Copies des déclarations fiscales effectuées par la société.', 'categorie_id' => $categorieIds[5]],
            ['nom_tache' => 'documents d\'enregistrement', 'description' => 'Copies des documents d\'enregistrement de la société.', 'categorie_id' => $categorieIds[6]],
            ['nom_tache' => 'justificatifs d\'activité', 'description' => 'Justificatifs de l\'activité exercée par la société.', 'categorie_id' => $categorieIds[6]],
            ['nom_tache' => 'statuts de la société', 'description' => 'Statuts signés et datés de la société.', 'categorie_id' => $categorieIds[7]],
            ['nom_tache' => 'procès-verbaux d\'assemblée', 'description' => 'Copies des procès-verbaux des assemblées générales.', 'categorie_id' => $categorieIds[7]],
            ['nom_tache' => 'documents constitutifs', 'description' => 'Copies des documents constitutifs de la société.', 'categorie_id' => $categorieIds[8]],
            ['nom_tache' => 'déclarations légales', 'description' => 'Copies des déclarations légales effectuées par la société.', 'categorie_id' => $categorieIds[8]],
            ['nom_tache' => 'documents d\'immatriculation', 'description' => 'Copies des documents d\'immatriculation de la société au registre du commerce.', 'categorie_id' => $categorieIds[9]],
            ['nom_tache' => 'comptes annuels', 'description' => 'Derniers comptes annuels approuvés de la société.', 'categorie_id' => $categorieIds[9]],
            ['nom_tache' => 'statuts de la société', 'description' => 'Statuts signés et datés de la société.', 'categorie_id' => $categorieIds[10]],
            ['nom_tache' => 'procès-verbaux d\'assemblée', 'description' => 'Copies des procès-verbaux des assemblées générales.', 'categorie_id' => $categorieIds[10]],
            ['nom_tache' => 'documents constitutifs', 'description' => 'Copies des documents constitutifs de la société.', 'categorie_id' => $categorieIds[11]],
            ['nom_tache' => 'déclarations légales', 'description' => 'Copies des déclarations légales effectuées par la société.', 'categorie_id' => $categorieIds[11]],
            ['nom_tache' => 'documents d\'affiliation', 'description' => 'Copies des documents d\'affiliation de la société aux organismes sociaux.', 'categorie_id' => $categorieIds[12]],
            ['nom_tache' => 'justificatifs d\'activité', 'description' => 'Justificatifs de l\'activité exercée par la société.', 'categorie_id' => $categorieIds[12]],
        ];

        Tache::insert($taches);



        $adminUser = [
            'nom' => 'Admin',
            'prenoms' => 'Admin',
            'raison' => 'Admin Raison',
            'adresse' => 'Adresse Admin',
            'bp' => 'BP Admin',
            'telephone' => '1234567890',
            'email' => 'admincbace@gmail.com',
            'declaration' => 'Déclaration Admin',
            'engagement' => 'Engagement Admin',
            'engagsup' => 'Engagement Supplémentaire Admin',
            'date' => now(),
            'dateCreate' => now(),
            'numAssocies' => 1,
            'regime' => 'Régime Admin',
            'password' => '@dminCb@ce', // Hash du mot de passe
            'user_type' => 'admin',
        ];

        $user = User::create($adminUser);

        $defaultImagePath = base_path('dist/user-default.png');
        if (file_exists($defaultImagePath)) {
            $imageName = time() . '_user-default.png';
            $destinationPath = base_path('avatars/' . $imageName);
            if (copy($defaultImagePath, $destinationPath)) {
                // je crée l'entrée dans la base de données pour l'avatar
                avatar::create([
                    'user_id' => $user->id,
                    'image' => $imageName
                ]);
            } else {
                echo "L'image par défaut n'a pas été trouvée.";
            }
        }
    }
}
