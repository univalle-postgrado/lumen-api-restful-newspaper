<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Content;

class ContentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Elimina todos los registros existentes en la tabla antes de agregar nuevos datos
        Content::truncate();

        // Agrega datos de ejemplo
        Content::create([
            'title' => 'Lima sugiere otro referéndum para “despedir” a Evo Morales',
            'alias' => 'lima-sugiere-otro-referendum-para-despedir-a-evo-morales',
            'author' => 'Sucre/CORREO DEL SUR',
            'image_url' => 'https://correodelsur.com/img/contents/images_640/2024/02/22/b7a75a6d-d061-47f4-b964-475df516749f.jpg',
            'introduction' => 'Según su propuesta, la consulta sería el mismo día de las elecciones judiciales',
            'body' => 'Para el ministro de Justicia, Iván Lima, el resultado del 21F es “definitivo”; sin embargo, sugirió que, junto a las elecciones judiciales de este año, se convoque a otro referéndum para reformar parcialmente la Constitución Política del Estado (CPE), previa aprobación por dos tercios de votos de la Asamblea Legislativa, así “despedimos a quien destruyó la independencia judicial”, en alusión a Evo Morales.',
            'format' => 'WITH_IMAGE',
            'status' => 'PUBLISHED',
            'edition_date' => 20240222,
            'created_by' => 'seeder',
            'category_id' => 1,
            'category_title' => 'Política',
            'category_alias' => 'politica'
        ]);
        Content::find(1)->tags()->attach([1, 2, 3]);

        // Método factory para generar datos de ejemplo más complejos
        Content::factory(99)->create(); 
    }
}
