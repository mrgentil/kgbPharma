<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StockMovement;
use App\Http\Controllers\Controller;

class StockMovementController extends Controller
{
    public function index()
    {
        $mouvements = StockMovement::with('medicament')->latest()->get();
        return view('stock-movements.index', compact('mouvements'));
    }
}
