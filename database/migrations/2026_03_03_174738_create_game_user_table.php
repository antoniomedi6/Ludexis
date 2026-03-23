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
        Schema::create('game_user', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('pending');
            $table->text('review')->nullable();
            $table->decimal('weight_applied')->default(1);
            $table->integer('hours_finish')->default(0);
            $table->integer('hours_completed')->default(0);
            $table->decimal('rating')->default(0)->nullable();
            $table->string('drop_reason')->nullable();
            $table->foreignId('game_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_user');
    }
};