<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('episodes', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('anime_id')->constrained('animes')->onDelete('cascade');
            $table->string('title', 255);
            $table->integer('number');
            $table->date('air_date')->nullable();
            $table->text('summary')->nullable();
            $table->foreignId('anime_id')->constrained('animes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('episodes');
    }
};
