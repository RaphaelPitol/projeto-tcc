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
         Schema::create('ambiente_fotos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('vistoria_id')
                  ->constrained('vistorias')
                  ->cascadeOnDelete();

            $table->foreignId('ambiente_id')
                  ->constrained('ambientes')
                  ->cascadeOnDelete();

            $table->string('imagem'); // caminho da imagem
            $table->integer('ordem')->default(0); // ordem das fotos

            $table->index(['vistoria_id', 'ambiente_id']);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ambiente_fotos');
    }
};
