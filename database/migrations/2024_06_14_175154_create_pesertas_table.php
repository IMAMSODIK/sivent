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
        Schema::create('pesertas', function (Blueprint $table) {
            $table->id();
            $table->string('peserta_id');
            $table->foreignId('event_id')->nullable();
            $table->string('nama');
            $table->string('nip')->unique();
            $table->string('golongan');
            $table->string('jabatan');
            $table->string('bank')->nullable();
            $table->string('no_rek')->unique()->nullable();
            $table->string('jenis_kelamin');
            $table->boolean('is_narsum');
            $table->boolean('status_registrasi')->default(false);
            $table->string('status_absensi')->default("Absen");
            $table->string('asal_instansi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesertas');
    }
};
