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
        Schema::create('data_user', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama', 30);
            $table->string('email');
            $table->enum('jenis_kelamin', ['0', '1']);
            $table->string('tempat_lahir', 20);
            $table->date('tanggal_lahir');
            $table->enum('agama', ['0', '1', '2', '3', '4']);
            $table->string('no_telp', 12);
            $table->string('alamat', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_user');
    }
};
