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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('id_isc', 10);
            $table->string('nama_mahasiswa', 100);
            $table->string('password');
            $table->boolean('has_access_mobile')->default(0);
            $table->enum('role', ['admin', 'koor', 'user'])->default('user');
            $table->foreign('id_isc')->references('id_isc')->on('mahasiswa')->onDelete('cascade');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
