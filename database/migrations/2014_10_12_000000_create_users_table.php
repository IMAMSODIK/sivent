<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('role');
            $table->string('foto')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        $path = public_path('assets/mst_bank.sql');
        if (File::exists($path)) {
            $sql = File::get($path);
            DB::unprepared($sql);
        } else {
            throw new \Exception("File SQL tidak ditemukan di path: {$path}");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
