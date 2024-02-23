<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Elimina todos los registros existentes en la tabla antes de agregar nuevos datos
        DB::table('categories')->truncate();

        $categories = ['Local', 'Nacional', 'Internacional', 'Deportes', 'Cultura', 'Economía', 'Seguridad', 'Política'];
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
