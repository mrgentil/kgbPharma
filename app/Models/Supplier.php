<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom', 'telephone', 'email'
    ];

    public function medicaments() {
        return $this->hasMany(Medicament::class);
    }

}
