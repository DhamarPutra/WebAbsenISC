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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->string('id_isc', 10)->primary();
            $table->string('nama_mahasiswa', 100);
            $table->string('nim', 15);
            $table->enum('peminatan', ['Data Science', 'Website Development', 'UI/UX Design'])->nullable();
            $table->enum('english_class', ['false', 'true'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
