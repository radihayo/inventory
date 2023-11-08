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
        Schema::table('data_barang_keluar', function (Blueprint $table) {
            // $table->unsignedBigInteger('id_barang')->unsigned()->nullable()->after('id');
            // $table->foreignUuid('id_barang')->nullable();
            // $table->foreignUuid('id_barang')->after('id');
            $table->foreignUuid('id_barang')->references('id')->on('data_barang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_barang_keluar', function (Blueprint $table) {
            $table->dropForeign(['id_barang']);
            $table->dropColumn('id_barang');
        });
    }
};
