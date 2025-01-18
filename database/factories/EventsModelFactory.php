<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\EventsModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class EventsModelFactory extends Factory
{
    protected $model = EventsModel::class;

    public function definition()
    {
        //$user_id = Auth::User()->id;

        $startDate = $this->faker->dateTimeBetween('-1 year', 'now');
        $endDate =$this->faker->dateTimeBetween($startDate, '+1 year'); // Ensure end date is after start date

         // Generate a random image from Lorem Picsum
         $imageUrl = 'https://picsum.photos/600/400';

         // Download the image and save it to the storage (public folder)
         $imageContents = file_get_contents($imageUrl);
         $imageName = 'event_images/' . $this->faker->unique()->word . '.jpg'; // Save the image with a unique name
         Storage::disk('public')->put($imageName, $imageContents); // Store the image in the public storage disk

        return [
            'user_id'=>1,
            'title' => $this->faker->sentence,
            'slug' => $this->faker->slug,
            'location'=> $this->faker->sentence,
            'image' => $imageName,
            'start_date'=> $startDate,
            'end_date'=>$endDate,
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
            'meta_keyword' => $this->faker->words(5, true),
            'meta_title' => $this->faker->sentence,
            'meta_description' => $this->faker->sentence,
            'author' =>  1,
            'canonical' => $this->faker->url,
            'description' => $this->faker->paragraphs(5, true),
        ];
    }
}
