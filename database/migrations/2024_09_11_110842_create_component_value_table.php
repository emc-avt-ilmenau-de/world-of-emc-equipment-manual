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
        Schema::create('ComponentValue', function (Blueprint $table) {
            $table->mediumIncrements('ComponentValueID');
            $table->foreignId('ComponentID')->nullable()->constrained('Component');
            $table->string('ComponentValueName', 255);             // by dafault not null
            $table->decimal('ComponentValuePrice', 8, 2)->nullable();
            $table->string('ComponentValueCurrency', 10)->default('EUR')->nullable();
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ComponentValue');
    }
};
