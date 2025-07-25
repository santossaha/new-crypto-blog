<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Technology', 'slug' => Str::slug('Technology'), 'status' => 'Active', 'type' => 'Blog'],
            ['name' => 'Health', 'slug' => Str::slug('Health'), 'status' => 'Inactive', 'type' => 'Blog'],
            ['name' => 'Education', 'slug' => Str::slug('Education'), 'status' => 'Active', 'type' => 'Blog'],
            ['name' => 'Lifestyle', 'slug' => Str::slug('Lifestyle'), 'status' => 'Active', 'type' => 'Blog'],
            ['name' => 'Finance', 'slug' => Str::slug('Finance'), 'status' => 'Inactive', 'type' => 'News'],
            ['name' => 'Sports', 'slug' => Str::slug('Sports'), 'status' => 'Active', 'type' => 'News'],
            ['name' => 'Entertainment', 'slug' => Str::slug('Entertainment'), 'status' => 'Active', 'type' => 'Blog'],
            ['name' => 'Travel', 'slug' => Str::slug('Travel'), 'status' => 'Inactive', 'type' => 'Blog'],
            ['name' => 'Politics', 'slug' => Str::slug('Politics'), 'status' => 'Active', 'type' => 'News'],
            ['name' => 'Science', 'slug' => Str::slug('Science'), 'status' => 'Inactive', 'type' => 'News'],
            ['name' => 'music', 'slug' => Str::slug('music'), 'status' => 'Active', 'type' => 'Event'],
            ['name' => 'video', 'slug' => Str::slug('video'), 'status' => 'Active', 'type' => 'Event'],
            ['name' => 'birthday', 'slug' => Str::slug('birthday'), 'status' => 'Active', 'type' => 'Event'],
            ['name' => 'workshop', 'slug' => Str::slug('workshop'), 'status' => 'Active', 'type' => 'Event'],
            ['name' => 'Conferences', 'slug' => Str::slug('conferences'), 'status' => 'Active', 'type' => 'Event'],
        ];

        DB::table('blog_categories')->insert($data);
    }
}
