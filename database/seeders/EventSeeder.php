<?php

namespace Database\Seeders;

use App\Models\EventsModel;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EventsModel::factory()->count(80)->create(); // Adjust count as needed
    }
}
