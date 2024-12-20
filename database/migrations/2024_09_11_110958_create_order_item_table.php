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
        $table->foreignId('OrderID')->constrained('Order', 'OrderID')->onDelete('cascade'); // Assumes 'orders' table exists
        $table->foreignId('ProductID')->nullable()->constrained('Product', 'ProductID')->onDelete('set null'); // Assumes 'products' table exists
        $table->json('Components')->nullable(); // JSON column to store grouped components
        $table->unsignedSmallInteger('OrderItemQuantity')->nullable(); // Adjusted to Small Integer for flexibility
        $table->decimal('OrderItemPrice', 8, 2)->nullable(); // Total price for the product and its components
        $table->string('OrderItemCurrency', 10)->default('EUR');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('OrderItem');
        
    }
};
