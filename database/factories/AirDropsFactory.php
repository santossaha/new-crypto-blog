<?php

namespace Database\Factories;

use App\Models\AirDrops;
use Illuminate\Database\Eloquent\Factories\Factory;

class AirDropsFactory extends Factory
{
    protected $model = AirDrops::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(['Token', 'Coin', 'NFTs']),
            'name' => $this->faker->word,
            'coin_token_symbol' => strtoupper($this->faker->lexify('???')),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'winner_announcement_date' => $this->faker->date(),
            'coin_token_image' => $this->faker->imageUrl(),
            'coin_token_qty' => $this->faker->numberBetween(100,1000),
            'total_airdrop_qty' => $this->faker->numberBetween(1000, 10000),
            'no_of_winners' => $this->faker->numberBetween(1, 10),
            'project_website' => $this->faker->url,
            'email' => $this->faker->safeEmail,
            'description_of_project' => $this->faker->paragraph,
            'task_details' => $this->faker->paragraph,
            'project_based_on' => 'Blockchain',
            'country' => $this->faker->country,
            'tast_link' => $this->faker->url,
            'facebook_link' => $this->faker->url,
            'facebook_url' => $this->faker->url,
            'twitter_url' => $this->faker->url,
            'instagram_url' => $this->faker->url,
            'reddit_url' => $this->faker->url,
            'telegram_url' => $this->faker->url,
            'discord_url' => $this->faker->url,
            'contract_address' => $this->faker->uuid,
            'contact' => $this->faker->randomElement(['telegram_id', 'whatsapp_number']),
            'contact_id' => $this->faker->userName,
            'aprove_status' => $this->faker->randomElement(['approved', 'pending', 'rejected']),
            'upvote' => $this->faker->numberBetween(0,100),
            'airdrop_status' => $this->faker->randomElement(['Upcomming', 'Previous', 'Trending']),
        ];
    }
}
