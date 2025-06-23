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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->unsignedBigInteger('produto_id');            
            $table->float('valor_venda', 10, 2);
            $table->integer('quantidade');
            $table->integer('numero_parcelas');
            $table->timestamps();

            $table->foreign('cliente_id')->references('id')->on('customers');
            $table->foreign('produto_id')->references('id')->on('products');            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
