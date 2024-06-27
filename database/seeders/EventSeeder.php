<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::create([
            'event_id' => Str::random(8),
            'nama_kegiatan' => "Kegiatan 1",
            'lokasi_kegiatan' => "Sutomo",
            'tanggal_kegiatan' => "2024-06-30",
            'waktu_kegiatan' => "12:00:00",
            'deskripsi_kegiatan' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat.",
            'no_surat' => "01/R-2024",
            'flayer' => "flayer.jpg",
            'kategori' => "rapat",
            'unit_kerja_id' => 2
        ]);

        Event::create([
            'event_id' => Str::random(8),
            'nama_kegiatan' => "Kegiatan 2",
            'lokasi_kegiatan' => "Medan Pancing",
            'tanggal_kegiatan' => "2024-09-22",
            'waktu_kegiatan' => "10:00:00",
            'deskripsi_kegiatan' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat.",
            'no_surat' => "02/R-2024",
            'flayer' => "flayer.jpg",
            'kategori' => "rapat",
            'unit_kerja_id' => 1
        ]);

        Event::create([
            'event_id' => Str::random(8),
            'nama_kegiatan' => "Kegiatan 3",
            'lokasi_kegiatan' => "Medan Sutomo",
            'tanggal_kegiatan' => "2024-05-22",
            'waktu_kegiatan' => "09:00:00",
            'deskripsi_kegiatan' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat.",
            'no_surat' => "03/R-2024",
            'flayer' => "flayer.jpg",
            'kategori' => "rapat",
            'unit_kerja_id' => 3
        ]);

        Event::create([
            'event_id' => Str::random(8),
            'nama_kegiatan' => "Kegiatan Meeting 1",
            'lokasi_kegiatan' => "Medan Sutomo",
            'tanggal_kegiatan' => "2024-10-22",
            'waktu_kegiatan' => "09:00:00",
            'deskripsi_kegiatan' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat.",
            'no_surat' => "01/M-2024",
            'flayer' => "flayer.jpg",
            'kategori' => "meeting",
            'unit_kerja_id' => 3
        ]);

        Event::create([
            'event_id' => Str::random(8),
            'nama_kegiatan' => "Kegiatan Meeting 2",
            'lokasi_kegiatan' => "Pancing",
            'tanggal_kegiatan' => "2024-07-22",
            'waktu_kegiatan' => "09:00:00",
            'deskripsi_kegiatan' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat.",
            'no_surat' => "02/M-2024",
            'flayer' => "flayer.jpg",
            'kategori' => "meeting",
            'unit_kerja_id' => 2
        ]);

        Event::create([
            'event_id' => Str::random(8),
            'nama_kegiatan' => "Kegiatan Meeting 3",
            'lokasi_kegiatan' => "Medan Tembung",
            'tanggal_kegiatan' => "2024-05-22",
            'waktu_kegiatan' => "09:00:00",
            'deskripsi_kegiatan' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat.",
            'no_surat' => "03/M-2024",
            'flayer' => "flayer.jpg",
            'kategori' => "meeting",
            'unit_kerja_id' => 1
        ]);

        Event::create([
            'event_id' => Str::random(8),
            'nama_kegiatan' => "Kegiatan Lembur 1",
            'lokasi_kegiatan' => "Medan Tembung",
            'tanggal_kegiatan' => "2024-10-22",
            'waktu_kegiatan' => "09:00:00",
            'deskripsi_kegiatan' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat.",
            'no_surat' => "01/L-2024",
            'flayer' => "flayer.jpg",
            'kategori' => "lembur",
            'unit_kerja_id' => 1
        ]);

        Event::create([
            'event_id' => Str::random(8),
            'nama_kegiatan' => "Kegiatan Lembur 2",
            'lokasi_kegiatan' => "Medan Tuntungan",
            'tanggal_kegiatan' => "2024-12-22",
            'waktu_kegiatan' => "09:00:00",
            'deskripsi_kegiatan' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat.",
            'no_surat' => "02/L-2024",
            'flayer' => "flayer.jpg",
            'kategori' => "lembur",
            'unit_kerja_id' => 3
        ]);

        Event::create([
            'event_id' => Str::random(8),
            'nama_kegiatan' => "Kegiatan Lembur 3",
            'lokasi_kegiatan' => "Medan Tembung",
            'tanggal_kegiatan' => "2024-05-22",
            'waktu_kegiatan' => "09:00:00",
            'deskripsi_kegiatan' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat.",
            'no_surat' => "03/L-2024",
            'flayer' => "flayer.jpg",
            'kategori' => "lembur",
            'unit_kerja_id' => 1
        ]);
    }
}
