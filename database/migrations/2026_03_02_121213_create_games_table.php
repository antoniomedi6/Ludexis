<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('synopsis')->nullable();
            $table->string('cover_url')->nullable();
            $table->string('video_url')->nullable();
            $table->date('first_release_date')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->integer('avg_time')->nullable();
            $table->float('rating')->nullable();
            $table->json('screenshots')->nullable();
            $table->json('artworks')->nullable();
            $table->integer('igdb_id')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};