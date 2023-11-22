<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = fake()->text(30);
        $slug = Str::slug($title);
        return [
            'title' => $title,
            'slug'  => $slug,
            'content' => fake()->text(100),
            'thumbnail' => fake()->imageUrl(),
            'status' => rand(0,1),
            'config' => rand(0,1),
            'category_id' => rand(1, 10),
        ];
    }
}
