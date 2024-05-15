<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Document;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'message' => $this->faker->word(),

            'user_id' => User::factory(),
            'document_id' => Document::factory(),
        ];
    }
}
