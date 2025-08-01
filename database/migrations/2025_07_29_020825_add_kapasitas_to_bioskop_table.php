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
        Schema::table('bioskops', function (Blueprint $table) {
            $table->integer('kapasitas')->nullable()->after('alamat');
            $table->decimal('harga_sewa', 10, 2)->nullable()->after('kapasitas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bioskops', function (Blueprint $table) {
            $table->dropColumn(['kapasitas', 'harga_sewa']);
        });
    }
};
