<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;


class QuestionAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Question::factory()
            ->count(40)
            ->hasAttached(
                \App\Models\Topic::inRandomOrder()->take(3)->get()
            )
            ->create();

        \App\Models\Answer::factory()
            ->count(20)
            ->create();
    }
}
