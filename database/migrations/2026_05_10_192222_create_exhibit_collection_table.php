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
        Schema::create('exhibit_collection', function (Blueprint $table) {
            $table->foreignId('exhibit_id')
                ->constrained('exhibits')
                ->cascadeOnDelete();
            $table->foreignId('collection_id')
                ->constrained('collections')
                ->cascadeOnDelete();
            $table->integer('position')->default(0)
                ->comment('Позиция экспоната в коллекции');

            $table->primary(['exhibit_id', 'collection_id']);

            $table->index('collection_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exhibit_collection');
    }
};
