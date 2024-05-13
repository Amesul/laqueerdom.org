<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Performance;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PerformanceFactory extends Factory
{
    protected $model = Performance::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),

            'user_id' => User::factory(),
            'event_id' => Event::factory(),
        ];
    }
}
