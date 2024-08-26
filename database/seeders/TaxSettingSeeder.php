<?php
namespace Database\Seeders;

use App\Models\TaxSetting;
use Illuminate\Database\Seeder;

class TaxSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new TaxSetting();
        $data->name  = 'GST';
        $data->tax  = '10.00';
        $data->save();
    }
}
