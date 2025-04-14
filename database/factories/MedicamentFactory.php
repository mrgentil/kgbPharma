<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medicament>
 */
class MedicamentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
    return [
        'nom' => $this->faker->word,
        'forme' => $this->faker->randomElement(['comprimé', 'sirop', 'capsule']),
        'dosage' => $this->faker->randomElement(['250mg', '500mg', '1g']),
        'prix_achat' => $this->faker->randomFloat(2, 5, 100),
        'prix_vente' => $this->faker->randomFloat(2, 10, 150),
        'stock' => $this->faker->numberBetween(10, 100),
        'stock_min' => 5,
        'expiration' => now()->addMonths(rand(3, 24)),
    ];
}
}
