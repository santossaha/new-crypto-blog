<?php

namespace Database\Seeders;

use App\Models\BlogDetail;
use App\Models\User;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::inRandomOrder()->first() ?? User::find(1);  // Get a random user or fallback to user ID 1

        BlogDetail::factory()->count(25)->create([
            'user_id' => $user->id,
        ]);
    }
}
