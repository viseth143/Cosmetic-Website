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
        Schema::create('customer_addresses', function (Blueprint $table) {
        $table->id('address_id');
        $table->unsignedBigInteger('customer_id')->nullable();
        $table->string('address', 250)->nullable();
        $table->string('city', 100)->nullable();
        $table->string('phone', 20)->nullable();
        $table->boolean('is_default')->default(false);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_addresses');
    }
};