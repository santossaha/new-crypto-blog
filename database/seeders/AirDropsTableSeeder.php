<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AirDrops;

class AirDropsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //return true;
        $numberOfRecords = 40; // Specify the number of records you want to create

        for($i= 0; $i < $numberOfRecords; $i++){
            AirDrops::factory()->create();
            sleep(3);
        }


    }
}
