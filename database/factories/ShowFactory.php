<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Show;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShowFactory extends Factory
{
    protected $model = Show::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'deadline' => $this->faker->date(),
            'applications_open' => $this->faker->boolean(),
            'event_id' => Event::factory(),
        ];
    }
}
