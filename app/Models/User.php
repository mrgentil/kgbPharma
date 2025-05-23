<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Traits\RoleTrait;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable; use RoleTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'is_suspended',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_suspended' => 'boolean',
    ];

    public function ventes() {
        return $this->hasMany(Supplier::class);
    }

    public function getInitialsAttribute()
    {
        $names = explode(' ', $this->name);
        $initials = '';

        if (count($names) > 1) {
            $initials .= strtoupper($names[0][0]); // Première lettre du prénom
            $initials .= strtoupper($names[1][0]); // Première lettre du nom de famille
        } else {
            $initials .= strtoupper($names[0][0]); // Si un seul nom, utiliser la première lettre
        }

        return $initials;
    }

    public function getRandomColorAttribute()
    {
        // Générer une couleur aléatoire en format hexadécimal
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }

}
