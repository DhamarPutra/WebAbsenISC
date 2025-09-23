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
        Schema::create('absen_event', function (Blueprint $table) {
            $table->id();
            $table->string('id_isc', 10);
            $table->foreign('id_isc')->references('id_isc')->on('mahasiswa')->onDelete('cascade');
            $table->unsignedBigInteger('id_event');
            $table->foreign('id_event')->references('id')->on('event')->onDelete('cascade');
            $table->timestamp('absen_masuk')->nullable();
            $table->timestamp('absen_keluar')->nullable();
            $table->enum('status_kehadiran', ['hadir', 'tidak hadir'])->default('tidak hadir');
            $table->string('link_sertifikat')->nullable();
            $table->string('image_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absen_event');
    }
};
