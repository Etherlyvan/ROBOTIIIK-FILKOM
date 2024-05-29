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
        Schema::create('tableorderprint', function (Blueprint $table) {
            $table->id('id_orderprint');
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->string('nama');
            $table->string('kontak');
            $table->string('file_name');
            $table->string('material');
            $table->string('status')->default('queue');
            $table->date('tanggal_pesan');
            $table->time('jam_pesan');
            $table->timestamps();
        });

        Schema::create('tableorderdesign', function (Blueprint $table) {
            $table->id('id_orderdesign');
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->string('nama');
            $table->string('kontak');
            $table->text('penjelasan');
            $table->string('file_name');
            $table->string('status')->default('queue');
            $table->date('tanggal_pesan');
            $table->time('jam_pesan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tableorderprint');
    }
};
