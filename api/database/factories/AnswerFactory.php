<?php

namespace Database\Factories;

use App\Models\Answer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Answer>
 */
class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $question = \App\Models\Question::inRandomOrder()->first();
        return [
            'question_id' => $question->id,
            'body' => implode(" ", fake()->sentences(rand(5, 15))),
            'status' => "published",
            'politician_id' => $question->politician_id,
        ];
    }
}
