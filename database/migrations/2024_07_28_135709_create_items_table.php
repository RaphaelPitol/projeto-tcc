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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nome');
            $table->unsignedBigInteger('material');
            $table->unsignedBigInteger('cor');
            $table->unsignedBigInteger('conservacao');
            $table->json('descricao');
            $table->text('observacao');
            $table->timestamps();

            $table->foreign('nome')->references('id')->on('nome_items')->onDelete('cascade');
            $table->foreign('material')->references('id')->on('material_items')->onDelete('cascade');
            $table->foreign('cor')->references('id')->on('cor_items')->onDelete('cascade');
            $table->foreign('conservacao')->references('id')->on('conservacao_items')->onDelete('cascade');
            // $table->foreign('descricao')->references('id')->on('descricao_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
