<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Medicament;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MedicamentStoreRequest;
use App\Http\Requests\MedicamentUpdateRequest;

class MedicamentController extends Controller
{
    public function index(Request $request)
    {
        $query = Medicament::query();

        if ($request->ajax()) {
            if ($request->has('filter')) {
                switch ($request->filter) {
                    case 'perimes':
                        $query->where('expiration', '<', now());
                        break;
                    case 'bientot_perimes':
                        $query->whereBetween('expiration', [now(), now()->addDays(30)]);
                        break;
                    case 'faible_stock':
                        $query->whereColumn('stock', '<', 'stock_min');
                        break;
                }
            }

            if ($request->has('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('nom', 'LIKE', "%$search%")
                        ->orWhere('code_barre', 'LIKE', "%$search%");
                });
            }

            $medicaments = $query->latest()->get();

            return view('medicaments.partials.table', compact('medicaments'))->render();
        }

        $medicaments = $query->latest()->paginate(15);
        return view('medicaments.index', compact('medicaments'));
    }


    public function create()
    {
        $suppliers = Supplier::all();
        return view('medicaments.create', compact('suppliers'));
    }



    public function store(MedicamentStoreRequest $request)
    {
        Medicament::create($request->validated());

        return redirect()->route('medicaments.index')
            ->with('success', 'Médicament ajouté avec succès');
    }

    public function show(Medicament $medicament)
    {
        return view('medicaments.show', compact('medicament'));
    }

    public function edit(Medicament $medicament)
    {
        $suppliers = Supplier::all();
        return view('medicaments.edit', compact('medicament', 'suppliers'));
    }

    public function update(MedicamentUpdateRequest $request, Medicament $medicament)
    {
        $medicament->update($request->validated());

        return redirect()->route('medicaments.index')
            ->with('success', 'Médicament mis à jour avec succès');
    }

    public function destroy(Medicament $medicament)
    {
        $medicament->delete();

        return redirect()->route('medicaments.index')
            ->with('success', 'Médicament supprimé avec succès');
    }
}
