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
        Schema::create('sales_detail_temporary', function (Blueprint $table) {
            $table->id();
            $table->string('invoice');
            $table->string('barcode');
            $table->double('purchase_price');
            $table->double('selling_price');
            $table->double('amount');
            $table->double('sub_total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_detail_temporary');
    }
};
