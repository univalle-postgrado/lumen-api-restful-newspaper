<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $faker = Faker::create();
        // $title = $faker->sentence;

        $categories = ['Local', 'Nacional', 'Internacional', 'Deportes', 'Cultura', 'Economía', 'Seguridad'];
        $i = 0;
        foreach ($categories as $category) {
            $i++;
            DB::table('categories')->insert([
                'title' => $category,
                'alias' => Str::slug($category),
                'position' => $i,
                'published' => rand(0, 1),
                'created_by' => 'seeder'
            ]);
        }
        
    }
}
