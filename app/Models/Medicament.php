<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicament extends Model
{
    use HasFactory;

    public function fournisseur() {
        return $this->belongsTo(Supplier::class);
    }

    public function venteDetails() {
        return $this->hasMany(SaleDetail::class);
    }

    public function stocks() {
        return $this->hasMany(Stock::class);
    }

}
