<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'pretitle',
        'title',
        'alias',
        'author',
        'image_url',
        'introduction',
        'body',
        'tags',
        'format',
        'featured',
        'status',
        'edition_date',
        'category_title',
        'category_alias',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by'
    ];

}
