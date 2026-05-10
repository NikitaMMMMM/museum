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
        Schema::create('news', function (Blueprint $table) {
            $table->id();

            $table->string('title', 255);
            $table->string('slug', 255)->unique()
                ->comment('URL-friendly название');
            $table->longText('content')
                ->comment('HTML содержимое новости');
            $table->string('short_description', 500)->nullable()
                ->comment('Краткое описание для карточки');
            $table->string('cover_image_url', 255)->nullable()
                ->comment('Главное изображение');

            $table->foreignId('author_id')
                ->constrained('users')
                ->restrictOnDelete() 
                ->comment('Автор новости');

            $table->timestamp('publish_date')
                ->useCurrent()
                ->index()
                ->comment('Дата публикации');
            $table->boolean('is_published')->default(false)
                ->index()
                ->comment('Опубликована ли новость');
            $table->integer('views_count')->default(0)
                ->comment('Количество просмотров');

            $table->softDeletes();
            $table->timestamps();

            $table->fullText(['title', 'short_description']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
