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
            $table->unsignedBigInteger('id_locador')->nullable();
            $table->unsignedBigInteger('id_locatario')->nullable();
            $table->unsignedBigInteger('id_imobiliaria')->nullable();
            $table->unsignedBigInteger('id_vistoriador')->nullable();
            $table->boolean('status')->default(0);
            $table->string('nome', 55);
            $table->string('cep', 55);
            $table->string('logradouro', 55);
            $table->string('numero', 6);
            $table->string('bairro', 50);
            $table->string('cidade', 50);
            $table->date('data_prazo');

            $table->foreign('id_locador')->references('id')->on('locador_locatarios')->onDelete('set null');
            $table->foreign('id_locatario')->references('id')->on('locador_locatarios')->onDelete('set null');
            $table->foreign('id_imobiliaria')->references('id')->on('users')->onDelete('set null');
            $table->foreign('id_vistoriador')->references('id')->on('users')->onDelete('set null');

            $table->timestamps();
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
