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
       Schema::create('shipping_methods', function (Blueprint $table) {
        $table->id('shipping_method_id');
        $table->string('method_name', 250)->nullable();
        $table->string('description', 250)->nullable();
        $table->decimal('cost', 10, 2)->nullable();
        $table->integer('estimated_day')->nullable();
        $table->boolean('is_active')->default(true);
        $table->timestamps();
    });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_methods');
    }
};