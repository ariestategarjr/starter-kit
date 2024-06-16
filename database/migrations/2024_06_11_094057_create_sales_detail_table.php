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
        Schema::create('sales_detail', function (Blueprint $table) {
            $table->id();
            $table->string('invoice');
            $table->string('barcode');
            $table->double('purchase_price');
            $table->double('selling_price');
            $table->double('amount');
            $table->double('sub_total');
            $table->timestamps();

            $table->foreign('invoice')->references('invoice')->on('sales')->onDelete('cascade');
            $table->foreign('barcode')->references('barcode')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_detail');
    }
};
