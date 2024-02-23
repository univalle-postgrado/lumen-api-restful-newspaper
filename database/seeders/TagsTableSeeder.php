<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Elimina todos los registros existentes en la tabla antes de agregar nuevos datos
        Tag::truncate();

        // Agrega datos de ejemplo
        Tag::create(['title' => 'Escasez de Dólares', 'alias' => 'escasez-de-dolares', 'published' => true, 'created_by' => 'seeder']);
        Tag::create(['title' => 'Cámara de Diputados', 'alias' => 'camara-de-diputados', 'published' => false, 'created_by' => 'seeder']);
        Tag::create(['title' => 'Robos', 'alias' => 'robos', 'published' => true, 'created_by' => 'seeder']);
        Tag::create(['title' => 'Gobierno nacional', 'alias' => 'gobierno-nacional', 'published' => true, 'created_by' => 'seeder']);
        Tag::create(['title' => 'Sucre', 'alias' => 'sucre', 'published' => true, 'created_by' => 'seeder']);

        // Método factory para generar datos de ejemplo más complejos
        Tag::factory(10)->create(); 
    }
}
