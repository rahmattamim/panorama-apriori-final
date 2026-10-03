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
        Schema::create('parameter_aprioris', function (Blueprint $table) {
            $table->id();

            // Nilai minimum support dalam persen
            $table->decimal('min_support', 5, 2)->default(20);

            // Nilai minimum confidence dalam persen
            $table->decimal('min_confidence', 5, 2)->default(60);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parameter_aprioris');
    }
};
