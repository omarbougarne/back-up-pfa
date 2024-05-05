<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animes', function (Blueprint $table) {
            $table->id();
            $table->string("title", 300);
            $table->string("synopsis", 6000);
            $table->string('image');
            $table->decimal('score', 4, 2)->nullable()->default(null);
            $table->foreignId('manga_id')->nullable()->constrained('mangas');
            $table->enum('status', ['plan to watch', 'completed', 'dropped'])->default(null);
            $table->enum('category', ['action', 'comedy', 'drama', 'adventure', 'fantasy', 'sci-fi', 'mystery', 'thriller', 'sports', 'supernatural', 'historical'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animes');
    }
};
