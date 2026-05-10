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
        Schema::create('user_favorites', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->foreignId('exhibit_id')
                ->constrained('exhibits')
                ->cascadeOnDelete();

            $table->timestamp('added_at')->useCurrent()
                ->comment('Дата добавления в избранное');

            $table->unique(['user_id', 'exhibit_id']);

            $table->index(['user_id', 'added_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_favorites');
    }
};
