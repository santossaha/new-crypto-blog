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
      
    }
}
