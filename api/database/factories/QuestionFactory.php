<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'body' => implode(" ", fake()->sentences(rand(2, 4))),
            'rationale' => implode(" ", fake()->sentences(rand(5, 15))),
            // Select a random politician ID from the existing politicians in the database
            'politician_id' => \App\Models\Politician::inRandomOrder()->first()->id,
            'status' => "published",
            'published_at' => now(),
            'user_id' => \App\Models\User::inRandomOrder()->first()->id,
        ];
    }
}
