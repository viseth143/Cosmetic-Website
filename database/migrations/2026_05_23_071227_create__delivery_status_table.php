<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('_delivery_status', function (Blueprint $table) {
            $table->id('delivery_status_id');
            $table->unsignedBigInteger('shipping_id')->nullable();
            $table->string('status', 250)->nullable();
            $table->string('description', 250)->nullable();
            $table->timestamps(); // ← this already adds created_at AND updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('_delivery_status');
    }
};