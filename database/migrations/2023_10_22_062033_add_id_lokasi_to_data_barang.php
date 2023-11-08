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
        Schema::table('data_barang', function (Blueprint $table) {
            $table->foreignUuid('id_lokasi')->nullable()->after('id_satuan');
            $table->foreign('id_lokasi')->references('id')->on('data_lokasi')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_barang', function (Blueprint $table) {
            $table->dropForeign(['id_lokasi']);
            $table->dropColumn('id_lokasi');
        });
    }
};
