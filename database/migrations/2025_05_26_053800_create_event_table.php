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
        Schema::create('event', function (Blueprint $table) {
            $table->id();
            $table->string('id_isc', 10);
            $table->foreign('id_isc')->references('id_isc')->on('mahasiswa')->onDelete('cascade');
            $table->text('judul');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->decimal('harga', 10);
            $table->string('image_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event');
    }
};
