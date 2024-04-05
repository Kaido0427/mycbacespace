<?php

namespace Database\Seeders;

use App\Models\categorie;
use App\Models\service;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class servicesCategories extends Seeder
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

        categorie::insert($categories);

        // Insérer les services
        $services = [
            ['nom_service' => 'Assistant comptable et fiscale'],
            ['nom_service' => 'Tenue de la comptabilité'],
            ['nom_service' => 'Conseils et formation pratique en gestion'],
            ['nom_service' => 'Etude de micro projet d\'investissement'],
            ['nom_service' => 'Evaluation économique et financière des PME et PMI'],
            ['nom_service' => 'Autres prestation (à préciser dans la lettre de mission)'],
        ];

        service::insert($services);

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
