<?php

namespace Database\Factories;

use App\Models\Document;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentFactory extends Factory
{
    protected $model = Document::class;

    public function definition(): array
    {
        return [
            'slug' => $this->faker->slug(3),
            'title' => $this->faker->sentence(5),
            'content' => $this->faker->text(3000),
            'type' => $this->faker->randomElement(['report', 'briefing', 'idea']),

            'user_id' => User::factory(),
        ];
    }
}
