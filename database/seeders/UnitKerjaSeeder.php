<?php

namespace Database\Seeders;

use App\Models\UnitKerja;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UnitKerja::create([
            'kode_unit' => 'A',
            'nama_unit' => 'Unit Kerja 1'
        ]);

        UnitKerja::create([
            'kode_unit' => 'B',
            'nama_unit' => 'Unit Kerja 2'
        ]);

        UnitKerja::create([
            'kode_unit' => 'C',
            'nama_unit' => 'Unit Kerja 3'
        ]);

        UnitKerja::create([
            'kode_unit' => 'D',
            'nama_unit' => 'Unit Kerja 4'
        ]);
    }
}
