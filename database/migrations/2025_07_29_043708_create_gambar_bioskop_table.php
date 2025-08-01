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
        Schema::create('gambar_bioskop', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bioskop_id')->constrained('bioskops')->onDelete('cascade')->onUpdate('cascade');
            $table->string('gambar')->nullable();
            $table->string('tempat_gambar')->nullable();
            $table->timestamps();
            $table->index('bioskop_id');
            $table->index('bioskop_id', 'sort_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gambar_bioskop');
    }
};
