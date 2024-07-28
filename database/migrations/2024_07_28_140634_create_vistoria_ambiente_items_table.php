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
        Schema::create('vistoria_ambiente_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vistoria_id');
            $table->unsignedBigInteger('ambiente_item_id');
            $table->timestamps();

            $table->foreign('vistoria_id')->references('id')->on('vistorias')->onDelete('cascade');
            $table->foreign('ambiente_item_id')->references('id')->on('ambiente_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vistoria_ambiente_items');
    }
};
