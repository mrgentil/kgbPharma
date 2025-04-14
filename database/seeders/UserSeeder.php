<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['Admin', 'Manager', 'Pharmacien', 'Vendeur', 'Caissier'];

        foreach ($roles as $role) {
            User::create([
                'name' => ucfirst($role),
                'email' => "$role@example.com",
                'password' => Hash::make('password'), // mot de passe par défaut
                'role' => $role,
            ]);
        }
    }
}
