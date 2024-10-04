<?php

namespace Database\Factories;

use App\Models\avatar;
use App\Models\categorie;
use App\Models\service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create('fr_FR');

        $validatedData = [
            'nom' => $faker->lastName,
            'prenoms' => $faker->firstName,
            'raison' => $faker->company,
            'adresse' => $faker->address,
            'bp' => $faker->randomNumber(4),
            'telephone' => $faker->phoneNumber,
            'email' => $faker->unique()->safeEmail,
            'declaration' => $faker->text,
            'engagement' => $faker->text,
            'engagsup' => $faker->text,
            'date' => $faker->date,
            'dateCreate' => $faker->date,
            'numAssocies' => $faker->randomNumber(2),
            'regime' => $faker->randomElement(['Régime Général', 'Régime Simplifié']),
            'user_type' => 'client',
            'password' => 'clientcb@ce',
        ];

        $user = User::create($validatedData);

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

            $services = service::inRandomOrder()->limit(rand(1, 3))->pluck('id')->toArray();
            $user->services()->attach($services);

            $categorie = categorie::inRandomOrder()->first();
            foreach ($categorie->taches as $tache) {
                $user->procedures()->create([
                    'categorie_id' => $categorie->id,
                    'tache_id' => $tache->id,
                    'user_id' => $user->id,
                ]);
            }
        }

        return $validatedData;
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
