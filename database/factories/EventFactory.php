<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Venue;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->text(),
            'date' => fake()->dateTimeBetween('-2 years', '+1 years'),
            'price' => $this->faker->randomNumber(),
            'thumbnail' => $this->faker->word(),
            'type' => $this->faker->word(),

            'venue_id' => Venue::factory(),
        ];
    }
}
