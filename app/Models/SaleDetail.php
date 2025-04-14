<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    use HasFactory;

    public function vente() {
        return $this->belongsTo(Sale::class);
    }

    public function medicament() {
        return $this->belongsTo(Medicament::class);
    }

}
