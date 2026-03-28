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
        // Count number of users and create more if there are less than 20
        if (\App\Models\User::count() < 20) {
            \App\Models\User::factory()
                ->count(20 - \App\Models\User::count())
                ->create();
        }

        $questions = \App\Models\Question::factory()
            ->count(200)
            ->create();


        $questions->each(function ($question) {
            $allTopics = \App\Models\Topic::all();
            $users = \App\Models\User::all();

            $randomTopics = $allTopics->random(rand(1, min(3, $allTopics->count())))->pluck('id');
            $question->topics()->attach($randomTopics);

            // for 60% of questions, create an answer
            if (rand(1, 100) <= 60) {
                \App\Models\Answer::factory()
                    ->create([
                        'question_id' => $question->id,
                        'politician_id' => $question->politician_id,
                    ]);
            }

            $numberOfVotes = rand(0, $users->count());

            if ($numberOfVotes > 0) {
                $randomUsers = $users->random($numberOfVotes);

                foreach ($randomUsers as $user) {
                    // Create the vote, overriding the factory defaults
                    \App\Models\Vote::factory()->create([
                        'user_id' => $user->id,
                        'question_id' => $question->id,
                    ]);
                }
            }
        });
    }
}
