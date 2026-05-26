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
         Schema::create('payments', function (Blueprint $table) {
        $table->id('payment_id');
        $table->unsignedBigInteger('order_id')->nullable();
        $table->unsignedBigInteger('payment_method_id')->nullable();
        $table->string('payment_status', 50)->nullable();
        $table->decimal('payment_amount', 10, 2)->nullable();
        $table->timestamp('paid_at')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};