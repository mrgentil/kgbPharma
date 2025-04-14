<?php

namespace Database\Seeders;

use App\Models\Sale;
use App\Models\User;
use App\Models\Stock;
use App\Models\Medicament;
use App\Models\SaleDetail;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendeurs = User::whereIn('role', ['vendeur', 'Caissier'])->get();
        $medicaments = Medicament::all();

        for ($i = 0; $i < 10; $i++) {
            $user = $vendeurs->random();
            $vente = Sale::create([
                'date_vente' => now()->subDays(rand(0, 30)),
                'total' => 0,
                'user_id' => $user->id,
            ]);

            $total = 0;

            foreach ($medicaments->random(rand(1, 3)) as $medicament) {
                $qte = rand(1, 5);
                $total += $medicament->prix_vente * $qte;

                SaleDetail::create([
                    'vente_id' => $vente->id,
                    'medicament_id' => $medicament->id,
                    'quantite' => $qte,
                    'prix_unitaire' => $medicament->prix_vente,
                ]);

                // Enregistrement dans l'historique des stocks
                Stock::create([
                    'medicament_id' => $medicament->id,
                    'type_mouvement' => 'vente',
                    'quantite' => $qte,
                    'remarque' => 'Vente ID ' . $vente->id,
                    'date_mouvement' => now(),
                ]);

                // Mettre à jour le stock actuel
                $medicament->stock -= $qte;
                $medicament->save();
            }

            $vente->total = $total;
            $vente->save();
        }
    }
    }

