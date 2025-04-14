<?php

namespace Database\Seeders;

use App\Models\Supplier;
use App\Models\Medicament;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MedicamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fournisseurs = Supplier::all();

        Medicament::factory()->count(20)->make()->each(function ($medicament) use ($fournisseurs) {
            $medicament->fournisseur_id = $fournisseurs->random()->id;
            $medicament->save();
        });
    }
}
