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
        Schema::create('Component', function (Blueprint $table) {
            $table->mediumIncrements('ComponentID');
            $table->string('ComponentName', 255);             // by dafault not null
            $table->string('ComponentMultimediaPath')->nullable();     // Store image path
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Component');
    }
};
