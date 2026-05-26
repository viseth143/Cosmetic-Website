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
       Schema::create('shippings', function (Blueprint $table) {
        $table->id('shipping_id');
        $table->unsignedBigInteger('order_id')->nullable();
        $table->unsignedBigInteger('shipping_method_id')->nullable();
        $table->unsignedBigInteger('address_id')->nullable();
        $table->string('contact_phone', 250)->nullable();
        $table->decimal('shipping_cost', 10, 2)->nullable();
        $table->string('tracking_number', 250)->nullable();
        $table->timestamp('shipped_at')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shippings');
    }
};