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
        Schema::create('exhibits', function (Blueprint $table) {
            $table->id();

            $table->string('inventory_number', 50)->unique()
                ->comment('Музейный инвентарный номер');
            $table->string('title', 255)
                ->comment('Название экспоната');
            $table->string('slug', 255)->unique()
                ->comment('URL-friendly название');
            $table->string('short_description')->nullable()
                ->comment('Короткое описание для карточки');
            $table->text('description')->nullable()
                ->comment('Подробное описание');
            $table->integer('year_created')->nullable()
                ->comment('Год создания экспоната');
            $table->string('condition', 50)->nullable()
                ->comment('Состояние сохранности');
            $table->string('donor_name', 150)->nullable()
                ->comment('ФИО дарителя');

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->comment('Кто добавил экспонат');

            $table->boolean('is_published')->default(false)
                ->index()
                ->comment('Опубликован ли экспонат');

            $table->softDeletes();
            $table->timestamps();

            $table->index('year_created');
            $table->fullText(['title', 'description']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exhibits');
    }
};
