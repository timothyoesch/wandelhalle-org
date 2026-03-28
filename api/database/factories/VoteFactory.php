<?php

namespace Database\Factories;

use App\Models\Vote;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Vote>
 */
class VoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // We will override user_id and question_id in the seeder!
            'user_id' => \App\Models\User::factory(),
            'question_id' => \App\Models\Question::factory(),
            'is_upvote' => $this->faker->boolean(),
        ];
    }
}
