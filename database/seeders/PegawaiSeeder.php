<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i <= 24; $i++){
            Pegawai::create([
                'peserta_id' => 'Bank ' . $i,
                'nama' => 'Nama Pegawai ' . $i,
                'nip' => '000' . $i,
                'golongan' => 'I',
                'jabatan_id' => 1,
                'jenis_kelamin' => "Laki-laki"
            ]);
        }
    }
}
