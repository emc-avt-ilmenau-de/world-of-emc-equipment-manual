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
        Schema::create('Order', function (Blueprint $table) {
            $table->bigIncrements('OrderID');
            $table->string('OrderCustName', 255)->nullable();
            $table->string('OrderOrgName', 255)->nullable();
            $table->string('OrderEmail', 255);
            $table->longText('OrderEmailText');
            $table->string('OrderPhone', 20)->nullable();
            $table->string('OrderAddress', 255)->nullable();
            $table->longText('OrderComment')->nullable();
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Order');
    }
};
