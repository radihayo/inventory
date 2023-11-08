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
            $table->foreignUuid('id_merek')->nullable()->after('id_jenis');
            $table->foreign('id_merek')->references('id')->on('data_merek')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_barang', function (Blueprint $table) {
            $table->dropForeign(['id_merek']);
            $table->dropColumn('id_merek');
        });
    }
};
