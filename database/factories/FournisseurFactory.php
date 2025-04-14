<?php

namespace Database\Factories;

use App\Models\Supplier;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FournisseurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->company,
            'telephone' => $this->faker->phoneNumber,
            'email' => $this->faker->companyEmail,
        ];
    }
}
