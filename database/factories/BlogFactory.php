<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Auth;

class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user_id = Auth::User()->id;
        return [
            'title' => $this->faker->sentence,
            'category_id'=>2,
            'user_id'=>$user_id,
            'slug' => $this->faker->slug,
            'image' => 'https://picsum.photos/seed/' . $this->faker->unique()->word . '/600/400', // Using Lorem Picsum for image generation
            'content' => $this->faker->paragraphs(5, true),
            'short_description' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
            'meta_keyword' => $this->faker->words(5, true),
            'meta_title' => $this->faker->sentence,
            'meta_description' => $this->faker->sentence,
            'author' =>  $user_id,
            'canonical' => $this->faker->url,
        ];
    }
}
