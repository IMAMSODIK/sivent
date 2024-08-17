<html lang="en">

@php
    use Carbon\Carbon;
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Kegiatan</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <style>
        body {
            color: black;
            font-family: 'Times New Roman', Times, serif
        }

        small {
            text-align: center;
            display: block;
            margin: 0 auto;
        }

        h2 {
            font-weight: bold;
            font-size: 32px;
        }

        span {
            font-size: 25px;

        }

        .align-right {
            display: flex;
            justify-content: flex-end;
        }

        table {
            border-collapse: collapse;
            /* Menghindari border ganda */
            width: 100%;
        }

        th,
        td {
            font-size: 20px;
            border: 1px solid black;
            /* Warna dan ketebalan border */
            padding: 8px;
            /* Padding untuk celah di dalam sel */
        }

        th {
            background-color: #f2f2f2;
            /* Warna latar belakang header tabel */
        }
    </style>
</head>

<body>
    <input type="hidden" id="kategori" value="{{ $event->kategori }}">
    <div class="container mt-4 mb-4" id="content">
        <div class="satu">
            <div class="row">
                <div class="col-md-2 d-flex align-items-center">
                    <img src="{{ asset('own_assets/images/logo_uin.png') }}" alt="" width="110%">
                </div>
                <div class="col-md-10">
                    <h2 class="text-center">KEMENTRIAN AGAMA REPUBLIK INDONESIA</h2>
                    <h2 class="text-center">UNIVERSITAS ISLAM NEGERI SUMATERA UTARA MEDAN</h2>
                    <h2 class="text-center">DEWAN PENGAWAS BADAN LAYANAN UMUM</h2>
                    <small class="text-center">Jalan Willhem Iskandar Pasar V Medan Estate 2037 PO BOX 2444 Telp. (061)
                        6622925 Fax. (061) 661583</small>
                    <small class="text-center">Website: www.uinsu.ac.id Email: humas@uinsu.ac.id</small>
                </div>
            </div>
            <hr class="text-dark bg-dark" style="height: 1px" />
            <hr class="text-dark bg-dark" style="height: 3px; margin-top: -13px" />

            <div style="margin-top: 100px">
                <h3 class="text-center" style="font-weight: bold">{{ $event->nama_kegiatan }}</h3>
                <hr class="text-dark bg-dark" />
                <hr class="text-dark bg-dark" style="margin-top: -15px" />
            </div>

            <div class="row">
                <div class="col-md-4">
                    <span>Hari / Tanggal</span>
                </div>
                <div class="col-md-8">
                    @php
                        Carbon::setLocale('id');
                        $date = Carbon::parse($event->tanggal_kegiatan)->translatedFormat('l, j F Y');
                    @endphp
                    <span>: {{ $date }}</span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <span>Waktu</span>
                </div>
                <div class="col-md-8">
                    @php
                        $time = date('H.i', strtotime($event->tanggal_kegiatan));
                    @endphp
                    <span>: {{ $time }} - Selesai</span>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <span>Tempat</span>
                </div>
                <div class="col-md-8">
                    <span>: {{ $event->lokasi_kegiatan }}</span>
                </div>
            </div>

            <div class="row" style="margin-top: 50px">
                <div class="col-md-12">
                    <b><span>Materi Rapat : </span></b><br>
                    <span>{{ $event->deskripsi_kegiatan }}</span>
                </div>
            </div>

            <div class="row" style="margin-top: 50px">
                <div class="col-md-12">
                    @if ($event->kategori == 'rapat')
                        <b><span>Notulensi Rapat : </span></b><br>
                        @if ($event->notulensi)
                            <span>{!! $event->notulensi->deskripsi !!}</span>
                        @endif
                    @endif
                </div>
            </div>

            <div class="row align-right" style="margin-top: 50px">
                <div class="col-md-5">
                    @php
                        Carbon::setLocale('id');
                        $date = Carbon::parse($event->tanggal_kegiatan)->translatedFormat('j F Y');
                    @endphp
                    <b><span>Medan, {{ $date }}</span></b><br>
                    <span>{{ $event->ketua->pegawai->jabatan }}</span><br><br><br><br><br><br><br>
                    <span>{{ $event->ketua->pegawai->nama }}</span><br>
                    <hr class="text-dark bg-dark" style="margin-top: -4px; margin-bottom: -4px" />
                    <span>{{ $event->ketua->pegawai->nip }}</span>
                </div>
            </div>
        </div>

        {{-- DUA --}}

        <div class="dua">
            <div class="row">
                <div class="col-md-2 d-flex align-items-center">
                    <img src="{{ asset('own_assets/images/logo_uin.png') }}" alt="" width="110%">
                </div>
                <div class="col-md-10">
                    <h2 class="text-center">KEMENTRIAN AGAMA REPUBLIK INDONESIA</h2>
                    <h2 class="text-center">UNIVERSITAS ISLAM NEGERI SUMATERA UTARA MEDAN</h2>
                    <h2 class="text-center">DEWAN PENGAWAS BADAN LAYANAN UMUM</h2>
                    <small class="text-center">Jalan Willhem Iskandar Pasar V Medan Estate 2037 PO BOX 2444 Telp. (061)
                        6622925 Fax. (061) 661583</small>
                    <small class="text-center">Website: www.uinsu.ac.id Email: humas@uinsu.ac.id</small>
                </div>
            </div>
            <hr class="text-dark bg-dark" style="height: 1px" />
            <hr class="text-dark bg-dark" style="height: 3px; margin-top: -13px" />

            <div class="row" style="margin-top: 50px">
                <div class="col-md-12">
                    <h3 class="text-center"><b>DAFTAR PESERTA</b></h3>
                    <h3 class="text-center"><b>{{ $event->nama_kegiatan }}</b></h3>
                    @php
                        Carbon::setLocale('id');
                        $date = Carbon::parse($event->tanggal_kegiatan)->translatedFormat('l, j F Y');
                    @endphp
                    <h3 class="text-center"><b>{{ $date }}</b></h3>
                    <hr class="text-dark bg-dark" />
                    <hr class="text-dark bg-dark" style="margin-top: -15px; margin-bottom: 15px" />
                    <table border="1" style="width: 100%">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">No</th>
                                <th class="text-center">Peserta</th>
                                <th class="text-center">Jabatan</th>
                                <th class="text-center">Golongan</th>
                                <th class="text-center">Tanda Tangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $index = 1;
                            @endphp
                            @foreach ($pesertas as $p)
                                <tr>
                                    <td class="text-center">{{ $index++ }}</td>
                                    <td>
                                        @if ($p->nama)
                                            {{ $p->nama }} <br>
                                            ({{ $p->nip }})
                                        @else
                                            {{ $p->pegawai->nama }} <br>
                                            ({{ $p->pegawai->nip }})
                                        @endif
                                    </td>
                                    <td>
                                        @if ($p->nama)
                                            {{ $p->jabatan }}
                                        @else
                                            {{ $p->pegawai->jabatan }}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($p->nama)
                                            {{ $p->golongan }}
                                        @else
                                            {{ $p->pegawai->golongan }}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($event->kategori == "meeting")
                                            @if ($p->ttd_registrasi)
                                                <img src="{{asset('storage/tanda_tangan') . '/' . $p->ttd_registrasi}}" alt="" width="200px">
                                            @endif
                                        @else
                                            @if ($p->ttd_absensi)
                                                <img src="{{asset('storage/tanda_tangan_absensi') . '/' . $p->ttd_absensi}}" alt="" width="200px">
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="row align-right" style="margin-top: 50px">
                <div class="col-md-5">
                    @php
                        Carbon::setLocale('id');
                        $date = Carbon::parse($event->tanggal_kegiatan)->translatedFormat('j F Y');
                    @endphp
                    <b><span>Medan, {{ $date }}</span></b><br>
                    <span>{{ $event->ketua->pegawai->jabatan }}</span><br><br><br><br><br><br><br>
                    <span>{{ $event->ketua->pegawai->nama }}</span><br>
                    <hr class="text-dark bg-dark" style="margin-top: -4px; margin-bottom: -4px" />
                    <span>{{ $event->ketua->pegawai->nip }}</span>
                </div>
            </div>
        </div>

        @if ($event->kategori == 'meeting')
            <div class="tiga">
                <div class="row">
                    <div class="col-md-2 d-flex align-items-center">
                        <img src="{{ asset('own_assets/images/logo_uin.png') }}" alt="" width="110%">
                    </div>
                    <div class="col-md-10">
                        <h2 class="text-center">KEMENTRIAN AGAMA REPUBLIK INDONESIA</h2>
                        <h2 class="text-center">UNIVERSITAS ISLAM NEGERI SUMATERA UTARA MEDAN</h2>
                        <h2 class="text-center">DEWAN PENGAWAS BADAN LAYANAN UMUM</h2>
                        <small class="text-center">Jalan Willhem Iskandar Pasar V Medan Estate 2037 PO BOX 2444 Telp.
                            (061)
                            6622925 Fax. (061) 661583</small>
                        <small class="text-center">Website: www.uinsu.ac.id Email: humas@uinsu.ac.id</small>
                    </div>
                </div>
                <hr class="text-dark bg-dark" style="height: 1px" />
                <hr class="text-dark bg-dark" style="height: 3px; margin-top: -13px" />

                <div class="row" style="margin-top: 50px">
                    <div class="col-md-12">
                        <h3 class="text-center"><b>DAFTAR REGISTRASI PESERTA</b></h3>
                        <h3 class="text-center"><b>{{ $event->nama_kegiatan }}</b></h3>
                        @php
                            Carbon::setLocale('id');
                            $date = Carbon::parse($event->tanggal_kegiatan)->translatedFormat('l, j F Y');
                        @endphp
                        <h3 class="text-center"><b>{{ $date }}</b></h3>
                        <hr class="text-dark bg-dark" />
                        <hr class="text-dark bg-dark" style="margin-top: -15px; margin-bottom: 15px" />
                        <table border="1" style="width: 100%">
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">No</th>
                                    <th class="text-center">Peserta</th>
                                    <th class="text-center">Jabatan</th>
                                    <th class="text-center">Golongan</th>
                                    <th class="text-center">Status Registrasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $index = 1;
                                @endphp
                                @foreach ($pesertas as $p)
                                    <tr>
                                        <td class="text-center">{{ $index++ }}</td>
                                        <td>
                                            @if ($p->nama)
                                                {{ $p->nama }} <br>
                                                ({{ $p->nip }})
                                            @else
                                                {{ $p->pegawai->nama }} <br>
                                                ({{ $p->pegawai->nip }})
                                            @endif
                                        </td>
                                        <td>
                                            @if ($p->nama)
                                                {{ $p->jabatan }}
                                            @else
                                                {{ $p->pegawai->jabatan }}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($p->nama)
                                                {{ $p->golongan }}
                                            @else
                                                {{ $p->pegawai->golongan }}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            {{ $p->status_registrasi == 1 ? 'Sudah Registrasi' : 'Belum Registrasi' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

                <div class="row align-right" style="margin-top: 50px">
                    <div class="col-md-5">
                        @php
                            Carbon::setLocale('id');
                            $date = Carbon::parse($event->tanggal_kegiatan)->translatedFormat('j F Y');
                        @endphp
                        <b><span>Medan, {{ $date }}</span></b><br>
                        <span>{{ $event->ketua->pegawai->jabatan }}</span><br><br><br><br><br><br><br>
                        <span>{{ $event->ketua->pegawai->nama }}</span><br>
                        <hr class="text-dark bg-dark" style="margin-top: -4px; margin-bottom: -4px" />
                        <span>{{ $event->ketua->pegawai->nip }}</span>
                    </div>
                </div>
            </div>
        @endif

        <div class="empat">
            <div class="row">
                <div class="col-md-2 d-flex align-items-center">
                    <img src="{{ asset('own_assets/images/logo_uin.png') }}" alt="" width="110%">
                </div>
                <div class="col-md-10">
                    <h2 class="text-center">KEMENTRIAN AGAMA REPUBLIK INDONESIA</h2>
                    <h2 class="text-center">UNIVERSITAS ISLAM NEGERI SUMATERA UTARA MEDAN</h2>
                    <h2 class="text-center">DEWAN PENGAWAS BADAN LAYANAN UMUM</h2>
                    <small class="text-center">Jalan Willhem Iskandar Pasar V Medan Estate 2037 PO BOX 2444 Telp. (061)
                        6622925 Fax. (061) 661583</small>
                    <small class="text-center">Website: www.uinsu.ac.id Email: humas@uinsu.ac.id</small>
                </div>
            </div>
            <hr class="text-dark bg-dark" style="height: 1px" />
            <hr class="text-dark bg-dark" style="height: 3px; margin-top: -13px" />

            <div class="row" style="margin-top: 50px">
                <div class="col-md-12">
                    <h3 class="text-center"><b>DAFTAR ABSENSI PESERTA</b></h3>
                    <h3 class="text-center"><b>{{ $event->nama_kegiatan }}</b></h3>
                    @php
                        Carbon::setLocale('id');
                        $date = Carbon::parse($event->tanggal_kegiatan)->translatedFormat('l, j F Y');
                    @endphp
                    <h3 class="text-center"><b>{{ $date }}</b></h3>
                    <hr class="text-dark bg-dark" />
                    <hr class="text-dark bg-dark" style="margin-top: -15px; margin-bottom: 15px" />
                    <table border="1" style="width: 100%">
                        <thead>
                            <tr>
                                <th class="text-center" width="5%">No</th>
                                <th class="text-center">Peserta</th>
                                <th class="text-center">Jabatan</th>
                                <th class="text-center">Golongan</th>
                                <th class="text-center" width="20%">Status Absensi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $index = 1;
                            @endphp
                            @foreach ($pesertas as $p)
                                <tr>
                                    <td class="text-center">{{ $index++ }}</td>
                                    <td>
                                        @if ($p->nama)
                                            {{ $p->nama }} <br>
                                            ({{ $p->nip }})
                                        @else
                                            {{ $p->pegawai->nama }} <br>
                                            ({{ $p->pegawai->nip }})
                                        @endif
                                    </td>
                                    <td>
                                        @if ($p->nama)
                                            {{ $p->jabatan }}
                                        @else
                                            {{ $p->pegawai->jabatan }}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($p->nama)
                                            {{ $p->golongan }}
                                        @else
                                            {{ $p->pegawai->golongan }}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @foreach ($p->absensi as $abs)
                                            Hadir <br> ({{$abs->time}})<br>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="row align-right" style="margin-top: 50px">
                <div class="col-md-5">
                    @php
                        Carbon::setLocale('id');
                        $date = Carbon::parse($event->tanggal_kegiatan)->translatedFormat('j F Y');
                    @endphp
                    <b><span>Medan, {{ $date }}</span></b><br>
                    <span>{{ $event->ketua->pegawai->jabatan }}</span><br><br><br><br><br><br><br>
                    <span>{{ $event->ketua->pegawai->nama }}</span><br>
                    <hr class="text-dark bg-dark" style="margin-top: -4px; margin-bottom: -4px" />
                    <span>{{ $event->ketua->pegawai->nip }}</span>
                </div>
            </div>
        </div>

        @if ($event->kategori == 'meeting')
            <div class="lima">
                <div class="row">
                    <div class="col-md-2 d-flex align-items-center">
                        <img src="{{ asset('own_assets/images/logo_uin.png') }}" alt="" width="110%">
                    </div>
                    <div class="col-md-10">
                        <h2 class="text-center">KEMENTRIAN AGAMA REPUBLIK INDONESIA</h2>
                        <h2 class="text-center">UNIVERSITAS ISLAM NEGERI SUMATERA UTARA MEDAN</h2>
                        <h2 class="text-center">DEWAN PENGAWAS BADAN LAYANAN UMUM</h2>
                        <small class="text-center">Jalan Willhem Iskandar Pasar V Medan Estate 2037 PO BOX 2444 Telp.
                            (061)
                            6622925 Fax. (061) 661583</small>
                        <small class="text-center">Website: www.uinsu.ac.id Email: humas@uinsu.ac.id</small>
                    </div>
                </div>
                <hr class="text-dark bg-dark" style="height: 1px" />
                <hr class="text-dark bg-dark" style="height: 3px; margin-top: -13px" />

                <div class="row" style="margin-top: 50px">
                    <div class="col-md-12">
                        <h3 class="text-center"><b>STATUS KIT KEGIATAN PESERTA</b></h3>
                        <h3 class="text-center"><b>{{ $event->nama_kegiatan }}</b></h3>
                        @php
                            Carbon::setLocale('id');
                            $date = Carbon::parse($event->tanggal_kegiatan)->translatedFormat('l, j F Y');
                        @endphp
                        <h3 class="text-center"><b>{{ $date }}</b></h3>
                        <hr class="text-dark bg-dark" />
                        <hr class="text-dark bg-dark" style="margin-top: -15px; margin-bottom: 15px" />
                        <table border="1" style="width: 100%">
                            <thead>
                                <tr>
                                    <th class="text-center" width="5%">No</th>
                                    <th class="text-center">Peserta</th>
                                    <th class="text-center">Jabatan</th>
                                    <th class="text-center">Golongan</th>
                                    <th class="text-center">Status Kit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $index = 1;
                                @endphp
                                @foreach ($pesertas as $p)
                                    <tr>
                                        <td class="text-center">{{ $index++ }}</td>
                                        <td>
                                            @if ($p->nama)
                                                {{ $p->nama }} <br>
                                                ({{ $p->nip }})
                                            @else
                                                {{ $p->pegawai->nama }} <br>
                                                ({{ $p->pegawai->nip }})
                                            @endif
                                        </td>
                                        <td>
                                            @if ($p->nama)
                                                {{ $p->jabatan }}
                                            @else
                                                {{ $p->pegawai->jabatan }}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($p->nama)
                                                {{ $p->golongan }}
                                            @else
                                                {{ $p->pegawai->golongan }}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            {{ $p->status_kit == 1 ? 'Sudah Mengambil' : 'Belum Mengambil' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

                <div class="row align-right" style="margin-top: 50px">
                    <div class="col-md-5">
                        @php
                            Carbon::setLocale('id');
                            $date = Carbon::parse($event->tanggal_kegiatan)->translatedFormat('j F Y');
                        @endphp
                        <b><span>Medan, {{ $date }}</span></b><br>
                        <span>{{ $event->ketua->pegawai->jabatan }}</span><br><br><br><br><br><br><br>
                        <span>{{ $event->ketua->pegawai->nama }}</span><br>
                        <hr class="text-dark bg-dark" style="margin-top: -4px; margin-bottom: -4px" />
                        <span>{{ $event->ketua->pegawai->nip }}</span>
                    </div>
                </div>
            </div>
        @endif

        <div class="enam">
            <div class="row">
                <div class="col-md-2 d-flex align-items-center">
                    <img src="{{ asset('own_assets/images/logo_uin.png') }}" alt="" width="110%">
                </div>
                <div class="col-md-10">
                    <h2 class="text-center">KEMENTRIAN AGAMA REPUBLIK INDONESIA</h2>
                    <h2 class="text-center">UNIVERSITAS ISLAM NEGERI SUMATERA UTARA MEDAN</h2>
                    <h2 class="text-center">DEWAN PENGAWAS BADAN LAYANAN UMUM</h2>
                    <small class="text-center">Jalan Willhem Iskandar Pasar V Medan Estate 2037 PO BOX 2444 Telp. (061)
                        6622925 Fax. (061) 661583</small>
                    <small class="text-center">Website: www.uinsu.ac.id Email: humas@uinsu.ac.id</small>
                </div>
            </div>
            <hr class="text-dark bg-dark" style="height: 1px" />
            <hr class="text-dark bg-dark" style="height: 3px; margin-top: -13px" />

            <div class="row" style="margin-top: 50px">
                <div class="col-md-12">
                    <h3 class="text-center"><b>DAFTAR FOTO KEGIATAN</b></h3>
                    <h3 class="text-center"><b>{{ $event->nama_kegiatan }}</b></h3>
                    @php
                        Carbon::setLocale('id');
                        $date = Carbon::parse($event->tanggal_kegiatan)->translatedFormat('l, j F Y');
                    @endphp
                    <h3 class="text-center"><b>{{ $date }}</b></h3>
                    <hr class="text-dark bg-dark" />
                    <hr class="text-dark bg-dark" style="margin-top: -15px; margin-bottom: 15px" />
                </div>
            </div>

            <div class="row">
                @foreach ($fotos as $f)
                    <div class="col-md-4 mb-5">
                        <img src="{{ asset('storage/foto') . '/' . $f->foto }}" width="80%" alt="">
                    </div>
                @endforeach

            </div>

            <div class="row align-right" style="margin-top: 50px">
                <div class="col-md-5">
                    @php
                        Carbon::setLocale('id');
                        $date = Carbon::parse($event->tanggal_kegiatan)->translatedFormat('j F Y');
                    @endphp
                    <b><span>Medan, {{ $date }}</span></b><br>
                    <span>{{ $event->ketua->pegawai->jabatan }}</span><br><br><br><br><br><br><br>
                    <span>{{ $event->ketua->pegawai->nama }}</span><br>
                    <hr class="text-dark bg-dark" style="margin-top: -4px; margin-bottom: -4px" />
                    <span>{{ $event->ketua->pegawai->nip }}</span>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf-lib/1.17.1/pdf-lib.min.js"></script>
    <script>
        const {
            jsPDF
        } = window.jspdf;
        const {
            PDFDocument
        } = PDFLib;

        // Function to create PDF from an HTML element
        const createPdfFromElement = async (element) => {
            if (!element) {
                console.error('Element not found');
                throw new Error('Element not found');
            }

            console.log('Creating PDF for element:', element);

            return new Promise((resolve, reject) => {
                html2canvas(element).then(canvas => {
                    const imgData = canvas.toDataURL('image/png');
                    const pdf = new jsPDF();

                    const pdfWidth = pdf.internal.pageSize.getWidth();
                    const pdfHeight = pdf.internal.pageSize.getHeight();
                    const imgWidth = pdfWidth - 40; // 20 margin on each side
                    const imgHeight = canvas.height * imgWidth / canvas.width;
                    const pageHeight = pdfHeight - 40; // 20 margin on top and bottom
                    const imgHeightOnPage = pdfWidth * imgHeight / imgWidth;

                    let heightLeft = imgHeight;
                    let position = 20;

                    pdf.addImage(imgData, 'PNG', 20, position, imgWidth, imgHeightOnPage);

                    heightLeft -= pageHeight;

                    while (heightLeft > 0) {
                        pdf.addPage();
                        position = heightLeft - imgHeightOnPage + 20;
                        pdf.addImage(imgData, 'PNG', 20, position, imgWidth, imgHeightOnPage);
                        heightLeft -= pageHeight;
                    }

                    resolve(pdf.output('arraybuffer'));
                }).catch(error => {
                    console.error('Error in html2canvas:', error);
                    reject(error);
                });
            });
        };

        // Function to combine PDFs using pdf-lib
        const combineAndSavePdf = async () => {
            const kategori = document.getElementById("kategori").value;

            const elements = {
                satu: document.querySelector('.satu'),
                dua: document.querySelector('.dua'),
                tiga: document.querySelector('.tiga'),
                empat: document.querySelector('.empat'),
                lima: document.querySelector('.lima'),
                enam: document.querySelector('.enam')
            };

            const pdfPromises = [];

            console.log('Selected category:', kategori);

            // Validate elements before creating PDFs
            for (const [key, element] of Object.entries(elements)) {
                if (element) {
                    console.log(`Creating PDF for element: ${key}`);
                    pdfPromises.push(createPdfFromElement(element));
                } else {
                    console.error(`Element with class ${key} not found`);
                }
            }

            try {
                // Await all PDFs to be created
                const pdfBuffers = await Promise.all(pdfPromises);
                const pdfDocs = await Promise.all(pdfBuffers.map(buffer => PDFDocument.load(buffer)));

                // Create a new PDF document to combine all pages
                const combinedPdf = await PDFDocument.create();

                // Copy pages from each PDF into the combined PDF
                for (const pdfDoc of pdfDocs) {
                    const copiedPages = await combinedPdf.copyPages(pdfDoc, pdfDoc.getPageIndices());
                    copiedPages.forEach(page => combinedPdf.addPage(page));
                }

                // Serialize the combined PDF document to bytes
                const combinedPdfBytes = await combinedPdf.save();

                // Create a Blob and use jsPDF to save it
                const combinedBlob = new Blob([combinedPdfBytes], {
                    type: 'application/pdf'
                });
                const combinedPdfUrl = URL.createObjectURL(combinedBlob);

                const link = document.createElement('a');
                link.href = combinedPdfUrl;
                link.download = 'combined.pdf';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            } catch (error) {
                console.error('Error creating or combining PDFs:', error);
            }
        };

        combineAndSavePdf();
    </script>

</body>

</html>
