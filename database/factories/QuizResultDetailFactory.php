<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\QuizResultDetail>
 */
class QuizResultDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'question_id' => rand(1,10),
            'answer_id' => rand(1,10),
            'quiz_result_id' => rand(1,10),
        ];
    }
}
