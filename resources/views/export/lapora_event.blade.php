<!DOCTYPE html>
<html>
<head>
    <title>Event Report</title>
    <style>
        <style>
        * {
            box-sizing: border-box;
        }

        body {
            background-color: #fafafa;
        }

        .report-container {
            font-family: "Open Sans";
            margin-top: 25px;
            max-width: 1240px;
            margin: 25px auto 25px auto;
            background-color: #fff;
            min-height: 20px;
            border: 1px solid #eaeaea;
            font-size: 0.9rem;
        }

        .report-controls {
            display: flex;
            flex: 1 1 auto;
            background-color: #f1f6fb;
            padding: 0px;
            width: 100%;
            border-bottom: 1px solid #e4e4e4;
        }

        .controls-left {
            margin-right: auto;
        }

        .controls-right {
            margin-left: auto;
        }

        .report-controls .report-dropdown {
            display: inline-block;
        }

        .report-controls button.report-button {
            padding: 10px;
            background-color: transparent;
            border: none;
            color: #666;
        }

        .report-controls button.report-button:hover,
        .report-controls button.report-button:focus {
            background-color: rgba(0, 0, 170, 0.05);
        }

        .report-dropdown {
            position: relative;
        }

        .report-dropdown .report-dropdown-menu {
            display: none;
            position: absolute;
            z-index: 1;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 2px 10px 0px rgba(0, 0, 0, 0.1);
            border: 1px solid #e4e4e4;
            border-radius: 4px;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
            overflow: hidden;
        }

        .report-controls .controls-right .report-dropdown .report-dropdown-menu {
            right: 0;
        }

        .report-dropdown .report-dropdown-menu .report-dropdown-item {
            display: block;
            text-decoration: none;
            padding: 6px 12px;
            color: #444;
            font-size: 0.9em;
        }

        .report-dropdown .report-dropdown-menu .report-dropdown-item:first-child {
            padding-top: 8px;
        }

        .report-dropdown .report-dropdown-menu .report-dropdown-item:last-child {
            padding-bottom: 8px;
        }

        .report-dropdown .report-dropdown-menu .report-dropdown-item:hover,
        .report-dropdown .report-dropdown-menu .report-dropdown-item:focus {
            background-color: #d0e2f4;
        }

        .report-dropdown:hover .report-dropdown-menu,
        .report-dropdown:focus .report-dropdown-menu {
            display: block;
        }

        .report-container .color-red {
            color: red;
        }

        .report-container .color-green {
            color: green;
        }

        .report-container .color-blue {
            color: blue;
        }

        .report-container .color-orange {
            color: orange;
        }

        .report-container .f-right {
            float: right;
        }

        .report-header {
            color: #555;
        }

        .report-title {
            text-align: center;
            font-weight: 300;
        }

        .report-name {
            text-align: center;
            text-transform: uppercase;
            font-size: 1.1em;
            color: #555;
            letter-spacing: 1px;
        }

        .report-name small {
            font-size: .9em;
            font-weight: 400;
            display: block;
            margin-top: 15px;
            text-transform: none;
        }

        .report-body {
            padding: 10px 15px;
            ;
        }

        .report-body table {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
        }

        .report-body table thead th {
            font-weight: bold;
            border-top: 1px solid #444;
            border-bottom: 1px solid #444;
            padding: 6px 10px;
            border-right: 1px dotted #bbb;
        }

        .report-body table thead th:last-child {
            border-right: none;
        }

        .report-body table tbody tr td {
            font-size: .9em;
            padding: 8px 6px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .report-body table tbody tr.tr-primary td {
            padding-bottom: 10px;
        }

        .report-body table tbody tr.tr-primary td:hover {
            background-color: rgba(0, 0, 0, 0.05)
        }

        .report-body table tbody tr.tr-primary.open+.tr-secondary,
        .report-body table tbody tr.tr-primary.open+.tr-secondary+.tr-total {
            display: table-row;
        }

        .report-body table tbody tr.tr-primary.open .report-collapse-trigger i {
            transform: rotate(45deg);
        }

        .report-body table tbody tr.tr-secondary,
        .report-body table tbody tr.tr-total {
            display: none;
        }

        .report-body table tbody tr.tr-secondary td {
            border-bottom: 1px solid #ddd;
        }

        .report-body table tbody tr.tr-secondary td:first-child {
            padding-left: 30px;
        }

        .report-collapse-trigger {
            padding: 0px;
            cursor: pointer;
            margin-right: .25rem;
            background: none;
            border: none;
            text-decoration: none;
            color: #999;

        }

        .report-collapse-trigger i {
            transition: all .3s ease;
            transform: rotate(0deg);
        }

        .report-collapse-trigger:hover,
        .report-collapse-trigger:focus {
            color: blue;
        }


        .report-body table tbody tr.tr-total {
            font-weight: bold;
            color: #444;
        }

        .report-body table tbody tr.tr-total td {
            padding-bottom: 14px;
        }

        .report-body table tfoot th {
            padding: 8px 6px;
            border-top: 1px solid #999;
            border-bottom: 2px solid #555;
        }

        .text-left {
            text-align: left;
        }


        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .report-timestamp {
            margin: 20px 0px 30px;
        }
    </style>
    </style>
</head>
<body>
    <div class="report-container" id="content">
        {{-- <div class="report-content">
            <div class="report-header">
                <h1 class="report-title">{{ $event->nama_kegiatan }}</h1>
                <h3 class="report-name">Data Rundown</h3>
            </div>

            <div class="report-body">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 8%">No</th>
                            <th style="width:20%;">Tanggal</th>
                            <th class="text-center" style="width:10%;">Waktu</th>
                            <th class="text-center">Pembawa Acara</th>
                            <th style="width:40%;">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rundowns as $index => $rundown)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center">{{ $rundown->tanggal_kegiatan }}</td>
                                <td class="text-center">{{ $rundown->waktu_kegiatan }}</td>
                                <td>{{ $rundown->aktor }}</td>
                                <td>{{ $rundown->keterangan_kegiatan }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No Rundown Data Available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div> --}}

        <div style="margin: 20px">
            {!! $laporans->laporan !!}
        </div>
        <hr>

        @if ($event->kategori == 'meeting')
        {{-- <div class="report-content">
            <div class="report-header">
                <h3 class="report-name">Data Narasumber</h3>
            </div>

            <div class="report-body">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 5%">No</th>
                            <th>Narasumber</th>
                            <th class="text-center" style="width:10%;">Jenis Kelamin</th>
                            <th class="text-center">Asal Instansi</th>
                            <th style="width:10%;">Golongan</th>
                            <th style="width:20%;">Jabatan</th>
                            <th style="width:10%;">Bank</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($narasumbers as $index => $narasumber)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $narasumber->nama }} <br> <small>{{ $narasumber->nip }}</small></td>
                                <td class="text-center">{{ $narasumber->jenis_kelamin }}</td>
                                <td>{{ $narasumber->asal_instansi }}</td>
                                <td class="text-center">{{ $narasumber->golongan }}</td>
                                <td>{{ $narasumber->jabatan }}</td>
                                <td class="text-center">{{ $narasumber->bank }} <br> <small>{{ $narasumber->no_rek }}</small></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No Narasumber Data Available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div> --}}
        @endif

        <div class="report-content" style="margin-bottom: 50px; margin-top: 50px">
            <div class="report-header">
                <h3 class="report-name">Data Peserta</h3>
            </div>

            <div class="report-body">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 5%">No</th>
                            <th>Peserta</th>
                            <th class="text-center" style="width:10%;">Jenis Kelamin</th>
                            <th style="width:10%;">Golongan</th>
                            <th style="width:20%;">Jabatan</th>
                            <th style="width:20%;">Bank</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pesertas as $index => $peserta)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                @if (!$peserta->nama)
                                    <td>{{ $peserta->pegawai->nama }} <br> <small>({{ $peserta->pegawai->nip }})</small></td>
                                    <td class="text-center">{{ $peserta->pegawai->jenis_kelamin }}</td>
                                    <td class="text-center">{{ $peserta->pegawai->golongan }}</td>
                                    <td>{{ $peserta->pegawai->jabatan->nama_jabatan }}</td>
                                    {{-- <td class="text-center">{{ $peserta->bank }} <br> <small>{{ $peserta->no_rek }}</small></td> --}}
                                    <td class="text-center">- <br> <small>-</small></td>
                                @else
                                    <td>{{ $peserta->nama }} <br> <small>({{ $peserta->nip }})</small></td>
                                    <td class="text-center">{{ $peserta->jenis_kelamin }}</td>
                                    <td class="text-center">{{ $peserta->golongan }}</td>
                                    <td>{{ $peserta->jabatan }}</td>
                                    <td class="text-center">{{ $peserta->bank }} <br> <small>{{ $peserta->no_rek }}</small></td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No Peserta Data Available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <hr>
            </div>
        </div>

        @if ($event->kategori == 'meeting')
            <div class="report-content" style="margin-bottom: 50px">
                <div class="report-header">
                    <h3 class="report-name">Data Registrasi Peserta</h3>
                </div>

                <div class="report-body">
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th>Peserta</th>
                                <th class="text-center" style="width:10%;">Jenis Kelamin</th>
                                <th style="width:8%;">Golongan</th>
                                <th style="width:15%;">Jabatan</th>
                                {{-- <th style="width:20%;">Bank</th> --}}
                                <th style="width:10%;">Registrasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pesertas as $index => $peserta)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    @if (!$peserta->nama)
                                        <td>{{ $peserta->pegawai->nama }} <br> <small>({{ $peserta->pegawai->nip }})</small></td>
                                        <td class="text-center">{{ $peserta->pegawai->jenis_kelamin }}</td>
                                        <td class="text-center">{{ $peserta->pegawai->golongan }}</td>
                                        <td>{{ $peserta->pegawai->jabatan->nama_jabatan }}</td>
                                        {{-- <td class="text-center">{{ $peserta->bank }} <br> <small>{{ $peserta->no_rek }}</small></td> --}}
                                        {{-- <td class="text-center">- <br> <small>-</small></td> --}}
                                    @else
                                        <td>{{ $peserta->nama }} <br> <small>({{ $peserta->nip }})</small></td>
                                        <td class="text-center">{{ $peserta->jenis_kelamin }}</td>
                                        <td class="text-center">{{ $peserta->golongan }}</td>
                                        <td>{{ $peserta->jabatan }}</td>
                                        {{-- <td class="text-center">{{ $peserta->bank }} <br> <small>{{ $peserta->no_rek }}</small></td> --}}
                                    @endif
                                    <td class="text-center">{{ ($peserta->status_registrasi == 0) ? "Belum Registrasi" : "Sudah Registrasi" }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No Peserta Data Available</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <hr>
            </div>
        @endif

        {{-- data absensi --}}
        
        <div class="report-content" style="margin-bottom: 50px">
            <div class="report-header">
                <h3 class="report-name">Data Absensi Peserta</h3>
            </div>

            <div class="report-body">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 5%">No</th>
                            <th>Peserta</th>
                            <th class="text-center" style="width:10%;">Jenis Kelamin</th>
                            <th style="width:8%;">Golongan</th>
                            <th style="width:15%;">Jabatan</th>
                            {{-- <th style="width:20%;">Bank</th> --}}
                            <th style="width:10%;">Absensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pesertas as $index => $peserta)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                @if (!$peserta->nama)
                                    <td>{{ $peserta->pegawai->nama }} <br> <small>({{ $peserta->pegawai->nip }})</small></td>
                                    <td class="text-center">{{ $peserta->pegawai->jenis_kelamin }}</td>
                                    <td class="text-center">{{ $peserta->pegawai->golongan }}</td>
                                    <td>{{ $peserta->pegawai->jabatan->nama_jabatan }}</td>
                                    {{-- <td class="text-center">{{ $peserta->bank }} <br> <small>{{ $peserta->no_rek }}</small></td> --}}
                                    {{-- <td class="text-center">- <br> <small>-</small></td> --}}
                                @else
                                    <td>{{ $peserta->nama }} <br> <small>({{ $peserta->nip }})</small></td>
                                    <td class="text-center">{{ $peserta->jenis_kelamin }}</td>
                                    <td class="text-center">{{ $peserta->golongan }}</td>
                                    <td>{{ $peserta->jabatan }}</td>
                                    {{-- <td class="text-center">{{ $peserta->bank }} <br> <small>{{ $peserta->no_rek }}</small></td> --}}
                                @endif
                                <td class="text-center">{{ $peserta->status_absensi }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No Peserta Data Available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <hr>
        </div>

        {{-- data kit --}}

        @if ($event->kategori == 'meeting')
            <div class="report-content" style="margin-bottom: 50px">
                <div class="report-header">
                    <h3 class="report-name">Data Kit Seminar</h3>
                </div>

                <div class="report-body">
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th>Peserta</th>
                                <th class="text-center" style="width:10%;">Jenis Kelamin</th>
                                <th style="width:10%;">Golongan</th>
                                <th style="width:15%;">Jabatan</th>
                                <th style="width:25%;">Status Kit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pesertas as $index => $peserta)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    @if (!$peserta->nama)
                                        <td>{{ $peserta->pegawai->nama }} <br> <small>({{ $peserta->pegawai->nip }})</small></td>
                                        <td class="text-center">{{ $peserta->pegawai->jenis_kelamin }}</td>
                                        <td class="text-center">{{ $peserta->pegawai->golongan }}</td>
                                        <td>{{ $peserta->pegawai->jabatan->nama_jabatan }}</td>
                                    @else
                                        <td>{{ $peserta->nama }} <br> <small>({{ $peserta->nip }})</small></td>
                                        <td class="text-center">{{ $peserta->jenis_kelamin }}</td>
                                        <td class="text-center">{{ $peserta->golongan }}</td>
                                        <td>{{ $peserta->jabatan }}</td>
                                    @endif
                                    <td class="text-center">{{ ($peserta->status_kit == 0) ? "Belum Mengambil" : "Sudah Mengambil" }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No Peserta Data Available</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <hr>
            </div>
        @endif

        {{-- data foto --}}
        
        <div class="report-content">
            <div class="report-header" style="margin-bottom: 50px">
                <h3 class="report-name">Data Foto Kegiatan</h3>
            </div>

            <div class="report-body">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 5%">No</th>
                            <th>Keterangan</th>
                            <th class="text-center" style="width:60%;">Foto</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($fotos as $index => $foto)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center">{{ $foto->keterangan }}</td>
                                <td class="text-center">
                                    <img src="{{asset('storage/foto') . '/' . $foto->foto}}" width="100%" alt="">
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No Peserta Data Available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <hr>
        </div>

        {{-- <div class="report-content">
            <div class="report-header">
                <h3 class="report-name">Data Foto Event</h3>
            </div>

            <div class="report-body">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 10%">No</th>
                            <th>Foto</th>
                            <th class="text-center" style="width:50%;">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($fotos as $index => $foto)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center">
                                    <img src="{{asset('storage/foto') . '/' . $foto->foto }}" alt="" style="width: 100%">
                                </td>
                                <td>{{ $foto->keterangan }}</small></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No Foto Data Available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="report-footer">
                <div class="report-timestamp text-center">
                    {{ now()->format('l F j, Y h:i A') }}
                </div>
            </div>
        </div> --}}
    </div>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script> --}}
    <script>
         window.addEventListener('load', function() {
            window.print();
        });
    </script>
</body>
</html>
