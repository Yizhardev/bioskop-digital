<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('films', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->text('sinopsis');
        $table->string('genre');
        $table->year('tahun');
        $table->string('poster')->nullable(); 
        $table->timestamps();
    });
}

    public function down(): void
{
    Schema::dropIfExists('films');
    }
};
