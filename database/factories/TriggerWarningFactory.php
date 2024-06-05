<?php

namespace Database\Factories;

use App\Models\TriggerWarning;
use Illuminate\Database\Eloquent\Factories\Factory;

class TriggerWarningFactory extends Factory
{
    protected $model = TriggerWarning::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'slug' => $this->faker->unique()->slug(),
            'title' => $this->faker->word(),
        ];
    }
}
