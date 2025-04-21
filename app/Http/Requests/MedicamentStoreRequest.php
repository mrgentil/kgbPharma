<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicamentStoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            'nom' => 'required|string|max:255',
            'forme' => 'nullable|string|max:100',
            'dosage' => 'nullable|string|max:100',
            'prix_achat' => 'required|numeric|min:0',
            'prix_vente' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'stock_min' => 'required|integer|min:0',
            'expiration' => 'required|date|after:today',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'code_barre' => 'nullable|string|max:255|unique:medicaments,code_barre',
        ];
    }
}
