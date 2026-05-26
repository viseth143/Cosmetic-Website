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
        Schema::create('product_option_value', function (Blueprint $table) {
        $table->id('product_option_value_id');
        $table->unsignedBigInteger('product_option_id');
        $table->string('option_value', 250)->nullable();
        $table->decimal('price_modifier', 10, 2)->default(0);
        $table->boolean('is_active')->default(true);
        $table->timestamps();

        $table->foreign('product_option_id')->references('product_option_id')->on('product_option')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_option_value');
    }
};