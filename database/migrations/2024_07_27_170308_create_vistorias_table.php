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
        Schema::create('vistorias', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Adiciona a coluna user_id
            $table->unsignedBigInteger('locador_id'); // Adiciona a coluna locador_id
            $table->unsignedBigInteger('locatario_id'); // Adiciona a coluna locatario_id
            $table->unsignedBigInteger('imovel_id'); // Adiciona a coluna imovel_id
            $table->date('date');
            $table->boolean('status')->default(false);
            $table->timestamps();

            // Define as chaves estrangeiras após adicionar as colunas
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('locador_id')->references('id')->on('locador_locatarios')->onDelete('cascade');
            $table->foreign('locatario_id')->references('id')->on('locador_locatarios')->onDelete('cascade');
            $table->foreign('imovel_id')->references('id')->on('imovels')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vistorias');
    }
};
