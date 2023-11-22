<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CourseCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = fake()->text(15);
        $slug = Str::slug($name);
        return [
            'name' => $name,
            'slug'  => $slug,
            'parent_id' => rand(0,1),
            'thumbnail' => fake()->imageUrl()
        ];
    }
}
