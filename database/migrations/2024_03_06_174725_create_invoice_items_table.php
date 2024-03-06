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
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('material_id')->constrained('materials')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('invoice_id')->constrained('invoices')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('quantity');
            $table->double('unitPrice')->default(0);
            $table->double('subTotal');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_items');
    }
};
