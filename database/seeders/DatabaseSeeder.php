<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
      
        \App\Models\User::create([
            'nom' => 'Admin',
            'prenoms' => 'CBACE-CGA',
            'email' => 'admincbace@gmail.com',
            'password' => 'cb@cePass',
            'user_type' => 'admin'
        ]);
    }
}
