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
        Schema::create('exhibit_media', function (Blueprint $table) {
            $table->id();

            $table->foreignId('exhibit_id')
                ->constrained('exhibits')
                ->cascadeOnDelete();
            $table->string('file_url', 255)
                ->comment('Путь к файлу');
            $table->enum('file_type', ['image', 'document'])
                ->default('image');
            $table->boolean('is_main')->default(false)
                ->index()
                ->comment('Главное фото экспоната');
            $table->string('caption', 255)->nullable()
                ->comment('Подпись к фото');
            $table->integer('sort_order')->default(0)
                ->comment('Порядок сортировки');

            $table->timestamps();

            $table->index(['exhibit_id', 'is_main']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exhibit_media');
    }
};
