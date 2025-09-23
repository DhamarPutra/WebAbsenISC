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
        Schema::create('nomor_surat', function (Blueprint $table) {
            $table->id();
            $table->string('id_isc', 10);
            $table->foreign('id_isc')->references('id_isc')->on('mahasiswa')->onDelete('cascade');
            $table->foreignId('jenis_surat_id')->constrained('jenis_surat')->onDelete('cascade');
            $table->string('nomor_surat');
            $table->date('tanggal_pengajuan');
            $table->time('waktu_pengajuan');
            $table->enum('status', ['draft', 'valid'])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nomor_surat');
    }
};
