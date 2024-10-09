<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;



class BlogDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        

        $user_id = User::inRandomOrder()->first()->id ?? 1;  // Use user ID 1 as fallback if no users exist


         // Generate a random image from Lorem Picsum
         $imageUrl = 'https://picsum.photos/600/400';

         // Download the image and save it to the storage (public folder)
         $imageContents = file_get_contents($imageUrl);
         $imageName = 'blog_images/' . $this->faker->unique()->word . '.jpg'; // Save the image with a unique name
         Storage::disk('public')->put($imageName, $imageContents); // Store the image in the public storage disk
 

        return [
            'title' => $this->faker->sentence,
            'category_id'=>1,
            'user_id'=>$user_id,
            'slug' => $this->faker->slug,
            'image' => $imageName ,
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
