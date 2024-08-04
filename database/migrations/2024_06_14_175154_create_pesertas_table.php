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
            $table->string('peserta_id')->nullable();
            $table->foreignId('event_id')->nullable();
            $table->foreignId('pegawai_id')->nullable();
            $table->string('nama')->nullable();
            $table->string('nip')->nullable();
            $table->string('golongan')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('bank')->nullable();
            $table->string('no_rek')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->boolean('is_narsum');
            $table->boolean('status_registrasi')->default(false);
            $table->boolean('status_kit')->default(false);
            $table->string('no_kamar')->default(0);
            $table->string('status_absensi')->default("Absen");
            $table->string('asal_instansi')->nullable();
            $table->string('bukti_transfer')->nullable();
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
