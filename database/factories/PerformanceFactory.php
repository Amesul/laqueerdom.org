<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Performance;
use App\Models\Show;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PerformanceFactory extends Factory
{
    protected $model = Performance::class;

    public function definition(): array
    {
        return [
            'slug' => $this->faker->slug(3),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->text(3000),

            'user_id' => User::factory(),
            'show_id' => Show::factory(),
        ];
    }
}
