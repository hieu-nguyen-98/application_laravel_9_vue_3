<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory()->create()->id,
            'meta_title' => $this->faker->sentence(),
            'title' => $this->faker->title(),
            'content' => $this->faker->title(),
            'image' => $this->faker->imageUrl($width = 200, $height = 200),
            'image_title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'date' => $this->faker->dateTimeThisMonth(),
            'view' => $this->faker->numberBetween($min = 10000, $max = 50000),
        ];
    }
}
