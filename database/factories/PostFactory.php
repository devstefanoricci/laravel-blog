<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = \App\Models\Post::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
             'title' => fake()->sentence(),
             'content' => fake()->paragraph(),
             'user_id' => fake()->numberBetween(2,10),
             'category_id' => fake()->numberBetween(1,10)
        ];
    }
}
