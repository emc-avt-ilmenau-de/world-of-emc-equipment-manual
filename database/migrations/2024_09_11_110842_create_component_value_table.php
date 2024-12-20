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
            $table->foreignId('ComponentID') // Foreign key referencing ComponentID
                  ->constrained('Component', 'ComponentID') // Ensure this references the correct table
                  ->onDelete('cascade')     // Delete ComponentValue if the Component is deleted
                  ->onUpdate('cascade');    // Update ComponentValue if ComponentID changes
            
            $table->string('ComponentValueName', 255);  // Default is NOT NULL
            $table->decimal('ComponentValuePrice', 8, 2)->nullable();
            $table->string('ComponentValueCurrency', 10)->default('EUR');
    
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
