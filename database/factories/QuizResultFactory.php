<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\QuizResult>
 */
class QuizResultFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'score' => fake()->numberBetween(1,10),
            'start_time' => fake()->dateTime(),
            'end_time' => fake()->dateTime(),
            'user_id' => rand(1,4),
            'quiz_id' => rand(1,10)
        ];
    }
}
