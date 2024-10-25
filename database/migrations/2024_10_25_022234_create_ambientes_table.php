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
        Schema::create('ambientes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vistoria_id');

            // Demais colunas...
            $table->string('nome_ambiente');
            $table->string('piso')->nullable();;
            $table->string('cons_piso')->nullable();;
            $table->text('observacao_piso')->nullable();
            $table->string('rodape')->nullable();;
            $table->string('cons_rodape')->nullable();;
            $table->text('observacao_rodape')->nullable();
            $table->string('parede')->nullable();;
            $table->string('cons_parede')->nullable();;
            $table->string('cor_parede')->nullable();;
            $table->string('cons_pintura_parede')->nullable();;
            $table->text('observacao_parede')->nullable();
            $table->string('teto')->nullable();;
            $table->string('cons_teto')->nullable();;
            $table->string('cor_teto')->nullable();;
            $table->string('cons_pintura_teto')->nullable();;
            $table->text('observacao_teto')->nullable();
            $table->string('porta')->nullable();;
            $table->string('cons_porta')->nullable();;
            $table->string('cor_porta')->nullable();;
            $table->string('cons_pintura_porta')->nullable();;
            $table->text('observacao_porta')->nullable();
            $table->string('janela')->nullable();;
            $table->string('cons_janela')->nullable();;
            $table->string('cor_janela')->nullable();;
            $table->string('cons_pintura_janela')->nullable();;
            $table->text('observacao_janela')->nullable();
            $table->text('observacoes')->nullable();
            $table->json('detalhes')->nullable();;

            $table->timestamps();


            $table->foreign('vistoria_id')->references('id')->on('vistorias')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ambientes');
    }
};
