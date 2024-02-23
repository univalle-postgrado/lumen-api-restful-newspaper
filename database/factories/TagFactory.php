<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TagFactory extends Factory
{
    protected $model = Tag::class;

    public function definition()
    {
        $title = $this->faker->word;
        return [
            'title' => $title,
            'alias' => Str::slug($title),
            'published' => rand(0, 1),
            'created_by' => 'factory'
        ];
    }
}
