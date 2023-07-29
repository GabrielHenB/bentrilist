<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "user_id" => \App\Models\User::factory(),
            "category_id" => \App\Models\Category::factory(),
            "slug" => $this->faker->unique()->slug(2),
            "title" => $this->faker->sentence(2),
            'excerpt' => $this->faker->sentence(),
            'body' => $this->faker->sentence(),
        ];
    }
}
