<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicamentUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [
            'nom' => 'sometimes|string|max:255',
            'forme' => 'nullable|string|max:100',
            'dosage' => 'nullable|string|max:100',
            'prix_achat' => 'sometimes|numeric|min:0',
            'prix_vente' => 'sometimes|numeric|min:0',
            'stock' => 'sometimes|integer|min:0',
            'stock_min' => 'sometimes|integer|min:0',
            'expiration' => 'sometimes|date|after:today',
            'supplier_id' => 'sometimes|exists:suppliers,id',
        ];
    }
}
