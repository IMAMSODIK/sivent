<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jabatan::create([
            'jabatan_id' => '123123',
            'nama_jabatan' => 'Jabatan 1'
        ]);

        Jabatan::create([
            'jabatan_id' => '123123',
            'nama_jabatan' => 'Jabatan 2'
        ]);

        Jabatan::create([
            'jabatan_id' => '123123',
            'nama_jabatan' => 'Jabatan 3'
        ]);
    }
}
