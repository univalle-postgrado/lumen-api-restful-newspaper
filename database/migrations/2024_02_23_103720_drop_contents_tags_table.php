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
        Schema::table('contents_tags', function (Blueprint $table) {
            Schema::dropIfExists('contents_tags');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('contents_tags', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('content_id');
            $table->unsignedInteger('tag_id');
            $table->foreign('content_id')->references('id')->on('contents');
            $table->foreign('tag_id')->references('id')->on('tags');
            $table->unique(['content_id', 'tag_id']);
        });
    }
};
