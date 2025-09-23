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
        Schema::create('change_passwords', function (Blueprint $table) {
            $table->id();
            $table->string('id_isc');
            $table->string('new_password');
            $table->string('selfie_path');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
            $table->foreign('id_isc')->references('id_isc')->on('mahasiswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('change_password');
    }
};
