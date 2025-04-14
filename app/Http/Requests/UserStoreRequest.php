<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // ou appliquer un policy ici
    }

    public function rules(): array
    {
        return [
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role'  => 'required|in:Admin,Manager,Pharmacien,Vendeur,Caissier',
            'password' => 'required|min:6',
        ];
    }
}
