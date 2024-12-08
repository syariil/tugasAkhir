<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Tim;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tim>
 */
class TimFactory extends Factory
{
    protected $model = Tim::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'squad' => $this->faker->name(),
            'leader' => $this->faker->name(),
            'short_squad' => substr($this->faker->name(), 0, 5),
            'no_whatsapp' => $this->faker->randomNumber(9),
            'nickname1' => $this->faker->name(),
            'id_nickname1' => $this->faker->randomNumber(8),
            'nickname2' => $this->faker->name(),
            'id_nickname2' => $this->faker->randomNumber(8),
            'nickname3' => $this->faker->name(),
            'id_nickname3' => $this->faker->randomNumber(8),
            'nickname4' => $this->faker->name(),
            'id_nickname4' => $this->faker->randomNumber(8),
            'nickname5' => $this->faker->name(),
            'id_nickname5' => $this->faker->randomNumber(8),
            'nickname6' => $this->faker->name(),
            'id_nickname6' => $this->faker->randomNumber(8),
            'season' => $this->faker->numberBetween(1, 5)
            // Tambahkan atribut lain sesuai kebutuhan
        ];
    }
}
