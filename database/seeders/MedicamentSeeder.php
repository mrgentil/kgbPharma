<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Medicament;
use App\Models\Supplier;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class MedicamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Créer 3 fournisseurs
        $suppliers = collect();
        for ($i = 1; $i <= 3; $i++) {
            $suppliers->push(Supplier::create([
                'nom' => 'Fournisseur ' . $i,
                'telephone' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
            ]));
        }

        $formes = ['Comprimé', 'Sirop', 'Gélule', 'Pommade', 'Injectable'];
        $dosages = ['250mg', '500mg', '100mg', '5ml', '10ml'];

        for ($i = 1; $i <= 50; $i++) {
            $stock = rand(0, 20);
            $expiration = now()->addDays(rand(-30, 365)); // date entre il y a 30 jours et dans 1 an

            Medicament::create([
                'nom' => 'Medicament ' . Str::random(5),
                'forme' => $faker->randomElement($formes),
                'dosage' => $faker->randomElement($dosages),
                'prix_achat' => $faker->randomFloat(2, 1, 100),
                'prix_vente' => $faker->randomFloat(2, 5, 150),
                'stock' => $stock,
                'stock_min' => 5,
                'expiration' => $expiration,
                'supplier_id' => $suppliers->random()->id,
            ]);
        }
    }
}
