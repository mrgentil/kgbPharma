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
    public function index()
    {
        $medicaments = Medicament::with('supplier')
            ->orderBy('nom')
            ->paginate(10);

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
