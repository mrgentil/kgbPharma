<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HistoriqueStock;
use App\Models\Medicament; // Ajouté
use Carbon\Carbon; // Ajouté

class HistoriqueStockController extends Controller
{
    public function index()
    {
        // Récupère tous les mouvements avec leurs médicaments associés
        $mouvements = HistoriqueStock::with(['medicament' => function ($query) {
            $query->withTrashed(); // Inclut les médicaments supprimés (si soft delete)
        }])->latest()->get();

        // Récupère les médicaments expirés ou proches de l'expiration
        $produitsExpires = Medicament::where('expiration', '<=', now()->addDays(30))
            ->orderBy('expiration')
            ->get();

        // Compte le nombre total de médicaments en stock
        $totalMedicaments = Medicament::count();

        return view('historique-stock.index', [
            'mouvements' => $mouvements,
            'produitsExpires' => $produitsExpires,
            'totalMedicaments' => $totalMedicaments
        ]);
    }
}
