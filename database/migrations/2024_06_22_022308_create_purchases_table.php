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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('invoice');
            $table->date('date');
            $table->bigInteger('supplier_id')->unsigned()->nullable();
            $table->double('discount_percent');
            $table->double('discount_cash');
            $table->double('total_gross');
            $table->double('total_net');
            $table->double('payment_money');
            $table->double('change_money');
            $table->timestamps();

            $table->index('invoice'); // Menambahkan index pada kolom invoice

            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
