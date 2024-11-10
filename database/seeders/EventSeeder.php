<?php

namespace Database\Seeders;

use App\Models\EventsModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::inRandomOrder()->first() ?? User::find(1);  // Get a random user or fallback to user ID 1
        EventsModel::factory()->count(80)->create([
            'user_id'=>$user->id,
            'author'=>$user->id,
        ]); // Adjust count as needed
    }
}
