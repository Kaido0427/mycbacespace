<?php

namespace Database\Seeders;

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
            ['nom_tache' => 'pièces d\'identité', 'categorie_id' => $categorieIds[0]],
            ['nom_tache' => 'justificatifs de domicile', 'categorie_id' => $categorieIds[0]],
            ['nom_tache' => 'statuts de la société', 'categorie_id' => $categorieIds[1]],
            ['nom_tache' => 'comptes annuels', 'categorie_id' => $categorieIds[1]],
            ['nom_tache' => 'documents d\'immatriculation', 'categorie_id' => $categorieIds[2]],
            ['nom_tache' => 'procès-verbaux d\'assemblée', 'categorie_id' => $categorieIds[2]],
            ['nom_tache' => 'documents constitutifs', 'categorie_id' => $categorieIds[3]],
            ['nom_tache' => 'déclarations légales', 'categorie_id' => $categorieIds[3]],
            ['nom_tache' => 'documents de fondation', 'categorie_id' => $categorieIds[4]],
            ['nom_tache' => 'procès-verbaux des réunions', 'categorie_id' => $categorieIds[4]],
            ['nom_tache' => 'documents d\'inscription au registre', 'categorie_id' => $categorieIds[5]],
            ['nom_tache' => 'déclarations fiscales', 'categorie_id' => $categorieIds[5]],
            ['nom_tache' => 'documents d\'enregistrement', 'categorie_id' => $categorieIds[6]],
            ['nom_tache' => 'justificatifs d\'activité', 'categorie_id' => $categorieIds[6]],
            ['nom_tache' => 'statuts de la société', 'categorie_id' => $categorieIds[7]],
            ['nom_tache' => 'procès-verbaux d\'assemblée', 'categorie_id' => $categorieIds[7]],
            ['nom_tache' => 'documents constitutifs', 'categorie_id' => $categorieIds[8]],
            ['nom_tache' => 'déclarations légales', 'categorie_id' => $categorieIds[8]],
            ['nom_tache' => 'documents d\'immatriculation', 'categorie_id' => $categorieIds[9]],
            ['nom_tache' => 'comptes annuels', 'categorie_id' => $categorieIds[9]],
            ['nom_tache' => 'statuts de la société', 'categorie_id' => $categorieIds[10]],
            ['nom_tache' => 'procès-verbaux d\'assemblée', 'categorie_id' => $categorieIds[10]],
            ['nom_tache' => 'documents constitutifs', 'categorie_id' => $categorieIds[11]],
            ['nom_tache' => 'déclarations légales', 'categorie_id' => $categorieIds[11]],
            ['nom_tache' => 'documents d\'affiliation', 'categorie_id' => $categorieIds[12]],
            ['nom_tache' => 'justificatifs d\'activité', 'categorie_id' => $categorieIds[12]],
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

        User::create($adminUser);
    }
}
