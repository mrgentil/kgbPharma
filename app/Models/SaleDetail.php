<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    use HasFactory;
    protected $fillable = ['quantite', 'prix_unitaire', 'total', 'sale_id', 'medicament_id'];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function medicament()
    {
        return $this->belongsTo(Medicament::class);
    }
}
