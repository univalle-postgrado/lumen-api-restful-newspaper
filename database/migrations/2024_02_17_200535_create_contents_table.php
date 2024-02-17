<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pretitle', 180);
            $table->string('title', 180);
            $table->string('alias', 180);
            $table->string('author', 60);
            $table->string('image_url', 255);
            $table->string('introduction', 300);
            $table->text('body');
            $table->string('tags', 300);
            $table->enum('format', ['ONLY_TEXT', 'WITH_IMAGE', 'WITH_GALLERY', 'WITH_VIDEO']);
            $table->boolean('featured');
            $table->enum('status', ['WRITING', 'PUBLISHED', 'NOT_PUBLISHED', 'ARCHIVED']);
            $table->unsignedSmallInteger('edition_date');
            $table->string('category_title', 60);
            $table->string('category_alias', 60);
            $table->timestamps();
            $table->string('created_by', 60);
            $table->string('updated_by', 60)->nullable();
            $table->unique(['edition_date', 'category_alias', 'alias']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
