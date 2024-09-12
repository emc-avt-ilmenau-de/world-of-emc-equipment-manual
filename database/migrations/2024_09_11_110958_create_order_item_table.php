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
        Schema::create('OrderItem', function (Blueprint $table) {
            $table->bigIncrements('OrderItemID');
            $table->foreignId('OrderID');
            $table->foreignId('ProductID'); // null in case new product proposal
            $table->foreignId('ComponentValueID'); // null in case new product proposal
            $table->unsignedTinyInteger('OrderItemQuantity')->nullable();
            $table->decimal('OrderItemPrice', 8, 2)->nullable();
            $table->string('OrderItemCurrency', 10)->default('EUR')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
