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
        Schema::create('Product', function (Blueprint $table) {
            $table->mediumIncrements('ProductID');
            $table->string('ProductName', 255);             // by dafault not null
            $table->longText('ProductMiniDescription')->nullable();
            $table->longText('ProductDescription')->nullable();
            $table->decimal('ProductPrice', 8, 2)->nullable();
            $table->string('ProductCurrency', 10)->default('EUR')->nullable();
            $table->string('ProductHomeImagePath')->nullable();     // Store image path
            $table->string('ProductMultimediaPath')->nullable();     // Store image path
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
