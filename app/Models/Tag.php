<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title', 'alias', 'published', 'created_at', 'updated_at', 'created_by', 'updated_by'
    ];

    public function contents()
    {
        return $this->belongsToMany(Content::class);
    }
}
