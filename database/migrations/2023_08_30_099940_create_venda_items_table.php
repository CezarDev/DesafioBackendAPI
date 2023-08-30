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
        Schema::create('venda_items', function (Blueprint $table) {
            $table->id();
            $table->integer('quantidade');
            $table->decimal('valor_unitario', 10, 2);
            $table->decimal('valor_total', 10, 2);
            $table->timestamps();

            $table->unsignedBigInteger('venda_id');
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('produto_id');

            $table->foreign('venda_id')->references('id')->on('vendas')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('cliente_id')->references('id')->on('clientes')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('produto_id')->references('id')->on('produtos')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('venda_items');
    }
};
