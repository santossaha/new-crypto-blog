<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
           $this->call(BasicSetup::class);
          $this->call(GeneralSettingSeeder::class);
          $this->call(CompanySettingSeeder::class);
          $this->call(EmailSettingSeeder::class);
          $this->call(CategorySeeder::class);
          $this->call(BlogSeeder::class);

        $this->call(EventSeeder::class);
        //AirDrops Seeder
        $this->call(AirDropsTableSeeder::class);




    }
}
