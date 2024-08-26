<?php
namespace Database\Seeders;

use App\Models\CompanySetting;
use Illuminate\Database\Seeder;

class CompanySettingSeeder extends Seeder
{
    public function run()
    {
        $data = new CompanySetting();
        $data->company_name  = 'Company Name';
        $data->address  = 'address of your company';
        $data->city  = 'Durgapur';
        $data->state  = 'West Bengal';
        $data->country  = 'India';
        $data->phone  = '1234567890';
        $data->email  = 'info@example.com';
        $data->website  = 'http://www.example.com';
        $data->gst_vat_number  = '1234567890';
        $data->save();
    }
}
