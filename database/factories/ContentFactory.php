<?php

namespace Database\Factories;

use App\Models\Content;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ContentFactory extends Factory
{
    protected $model = Content::class;

    public function definition()
    {
        // Obtenemos una categoría aleatoriamente y que esté publicada
        $categories = Category::select('id', 'title', 'alias')->where('published', true)->get();
        $category = $categories->random(1)->first();

        $title = substr($this->faker->sentence, 0, 180);
        return [
            'pretitle' => rand(0, 1) ? null : substr($this->faker->sentence, 0, 180),
            'title' => $title,
            'alias' => Str::slug($title),
            'author' => $this->faker->name,
            'image_url' => $this->faker->imageUrl(640, 480),
            'introduction' => $this->faker->paragraph,
            'body' => $this->faker->text,
            'format' => $this->faker->randomElement(['ONLY_TEXT', 'WITH_IMAGE', 'WITH_GALLERY', 'WITH_VIDEO']),
            'status' => $this->faker->randomElement(['WRITING', 'PUBLISHED', 'NOT_PUBLISHED', 'ARCHIVED']),
            'edition_date' => rand(20240101, intval(date('Ymd'))),
            'category_id' => $category->id,
            'category_title' => $category->title,
            'category_alias' => $category->alias,
            'created_by' => 'factory'
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Content $content) {
            // Asocia tags al content
            $tags = Tag::where('published', true)->inRandomOrder()->limit(3)->get(); // Asocia hasta 3 tags de forma aleatoria
            $content->tags()->attach($tags);
        });
    }
}
