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
            $table->foreignUuid('id_satuan')->nullable()->after('id_merek');
            $table->foreign('id_satuan')->references('id')->on('data_satuan')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_barang', function (Blueprint $table) {
            $table->dropForeign(['id_satuan']);
            $table->dropColumn('id_satuan');
        });
    }
};
