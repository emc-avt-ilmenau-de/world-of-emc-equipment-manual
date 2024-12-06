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
        Schema::create('ProductComponent', function (Blueprint $table) {
            $table->foreignId('ProductID')
                ->constrained('Product', 'ProductID') // Ensure correct reference for the foreign key
                ->onDelete('cascade'); // Automatically remove ProductComponent rows if the referenced Product is deleted

            $table->foreignId('ComponentID')
                ->constrained('Component', 'ComponentID') // Ensure correct reference for the foreign key
                ->onDelete('cascade'); // Automatically remove ProductComponent rows if the referenced Component is deleted

            $table->timestamps();

            // Composite primary key to prevent duplicate records of the same Product and Component
            $table->primary(['ProductID', 'ComponentID']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ProductComponent');
    }
};
