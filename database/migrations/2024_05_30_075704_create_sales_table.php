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
            $table->string('sale_invoice');
            $table->date('sale_date');
            $table->unsignedBigInteger('sale_customer_id');
            $table->double('sale_discount_percent');
            $table->double('sale_discount_cash');
            $table->double('sale_total_gross');
            $table->double('sale_total_net');
            $table->double('sale_amount');
            $table->double('sale_total');
            $table->timestamps();

            $table->foreign('sale_customer_id')->references('id')->on('customers')->onDelete('cascade');
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
