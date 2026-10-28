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
        Schema::create('koleksi_jam', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('brand');
            $table->unsignedBigInteger('harga');
            $table->integer('tahun_rilis');
            $table->enum('tipe_gerakan', ['Automatic', 'Manual', 'Quartz']);
            $table->string('material');
            $table->enum('status', ['tersedia', 'terjual'])->default('tersedia');
            $table->text('foto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('koleksi_jam');
    }
};
