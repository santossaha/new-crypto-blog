<?php

namespace Database\Factories;

use App\Models\BlogCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;



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

        $categoryId = BlogCategory::inRandomOrder()->first()->id ?? 1;


         // Generate a random image from Lorem Picsum
         $imageUrl = 'https://picsum.photos/600/400';

         // Download the image and create a temporary file
         $imageContents = file_get_contents($imageUrl);
         $tempPath = tempnam(sys_get_temp_dir(), 'blog_image_');
         file_put_contents($tempPath, $imageContents);

         // Create an UploadedFile instance
         $uploadedFile = new UploadedFile(
             $tempPath,
             'blog_image.jpg',
             'image/jpeg',
             null,
             true
         );

         // Use the uploadImage helper function
         $imagePath = uploadImage($uploadedFile, 'blog_images', null, 'blog');


        return [
            'title' => $this->faker->sentence,
            'category_id'=>$categoryId,
            'user_id'=>$user_id,
            'slug' => $this->faker->slug,
            'image' => $imagePath,
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
