<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicament extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'forme',
        'dosage',
        'prix_achat',
        'prix_vente',
        'stock',
        'stock_min',
        'expiration',
        'supplier_id'
    ];

    protected $casts = [
        'expiration' => 'date',
    ];

    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }

    public function venteDetails() {
        return $this->hasMany(SaleDetail::class);
    }

    public function stocks() {
        return $this->hasMany(Stock::class);
    }

    // Vérifie si le stock est faible
    public function isLowStock(): bool
    {
        return $this->stock <= $this->stock_min;
    }

    // Vérifie si le médicament est périmé
    public function isExpired(): bool
    {
        return now()->greaterThan($this->expiration);
    }

}
