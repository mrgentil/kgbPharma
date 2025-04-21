<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Medicament;
use App\Models\SaleDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $filtre = $request->get('filtre'); // jour, semaine, mois, année

        $query = Sale::with('details.medicament');

        switch ($filtre) {
            case 'jour':
                $query->whereDate('date_vente', today());
                break;
            case 'semaine':
                $query->whereBetween('date_vente', [now()->startOfWeek(), now()->endOfWeek()]);
                break;
            case 'mois':
                $query->whereMonth('date_vente', now()->month)->whereYear('date_vente', now()->year);
                break;
            case 'annee':
                $query->whereYear('date_vente', now()->year);
                break;
        }

        $ventes = $query->latest('date_vente')->paginate(10);

        return view('sales.index', compact('ventes', 'filtre'));
    }


    public function create()
    {
        $medicaments = Medicament::all();
        return view('sales.create', compact('medicaments'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'medicament_id.*' => 'required|exists:medicaments,id',
            'quantite.*' => 'required|integer|min:1',
            'prix_unitaire.*' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $sale = Sale::create([
                'date_vente' => now(),
                'total' => $request->total,
                'user_id' => auth()->id(),
            ]);

            foreach ($request->medicament_id as $index => $medicamentId) {
                $quantite = $request->quantite[$index];
                $prixUnitaire = $request->prix_unitaire[$index];

                SaleDetail::create([
                    'sale_id' => $sale->id,
                    'medicament_id' => $medicamentId,
                    'quantite' => $quantite,
                    'prix_unitaire' => $prixUnitaire,
                ]);

                // Déduction du stock
                $medicament = Medicament::find($medicamentId);
                $medicament->stock -= $quantite;
                $medicament->save();
            }

            DB::commit();
            return redirect()->route('sales.index')->with('success', 'Vente enregistrée avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erreur : ' . $e->getMessage());
        }
    }

    public function edit(Sale $sale)
    {
        $sale->load('details');
        $medicaments = Medicament::all();
        return view('sales.edit', compact('sale', 'medicaments'));
    }

    public function update(Request $request, Sale $sale)
    {
        $request->validate([
            'medicament_id.*' => 'required|exists:medicaments,id',
            'quantite.*' => 'required|integer|min:1',
            'prix_unitaire.*' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            // Restauration du stock avant mise à jour
            foreach ($sale->details as $detail) {
                $detail->medicament->increment('stock', $detail->quantite);
            }

            $sale->details()->delete();

            foreach ($request->medicament_id as $index => $medicamentId) {
                $quantite = $request->quantite[$index];
                $prixUnitaire = $request->prix_unitaire[$index];

                SaleDetail::create([
                    'sale_id' => $sale->id,
                    'medicament_id' => $medicamentId,
                    'quantite' => $quantite,
                    'prix_unitaire' => $prixUnitaire,
                ]);

                $medicament = Medicament::find($medicamentId);
                $medicament->decrement('stock', $quantite);
            }

            $sale->update([
                'total' => $request->total,
            ]);

            DB::commit();
            return redirect()->route('sales.index')->with('success', 'Vente mise à jour avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erreur : ' . $e->getMessage());
        }
    }

    public function destroy(Sale $sale)
    {
        DB::transaction(function () use ($sale) {
            foreach ($sale->details as $detail) {
                $detail->medicament->increment('stock', $detail->quantite);
            }
            $sale->delete();
        });

        return redirect()->route('sales.index')->with('success', 'Vente supprimée avec succès.');
    }
}
