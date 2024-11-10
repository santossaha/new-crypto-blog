<?php

namespace Database\Factories;

use App\Models\EventsModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

     protected $model = EventsModel::class;
    public function definition()
    {
        $user_id = Auth::User()->id;

        $startDate = $this->faker->dateTimeBetween('-1 year', 'now');
         $endDate =$this->faker->dateTimeBetween($startDate, '+1 year'); // Ensure end date is after start date

        return [
            'title' => $this->faker->sentence,
            'category_id'=>11,
            'user_id'=>$user_id,
            'slug' => $this->faker->slug,
            'image' => 'https://picsum.photos/seed/' . $this->faker->unique()->word . '/600/400', // Using Lorem Picsum for image generation
            'description' => $this->faker->paragraphs(5, true),
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
            'meta_keyword' => $this->faker->words(5, true),
            'meta_title' => $this->faker->sentence,
            'meta_description' => $this->faker->sentence,
            'author' =>  $user_id,
            'canonical' => $this->faker->url,
            'approve_status'=>'Aprroved',
            'start_date'=> $startDate,
            'endDate'=>$endDate,
            'location'=> $this->faker->sentence,
           
        ];
    }
}
