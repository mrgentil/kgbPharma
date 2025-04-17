<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriqueStock extends Model
{
    use HasFactory;

    protected $fillable = ['medicament_id', 'type', 'quantite', 'description'];

    public function medicament()
    {
        return $this->belongsTo(Medicament::class);
    }
}
