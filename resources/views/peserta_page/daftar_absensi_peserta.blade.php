@extends('template')

@section('own_style')
<style>
    .border-canvas {
        border: 2px solid #000;
        border-radius: 5px;
    }
</style>
@endsection

@section('content')
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row mt-4">
                    <div class="col-6">
                        <h4>Daftar Peserta</h4>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">
                <!-- Zero Configuration  Starts-->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive custom-scrollbar">
                                <table class="display" id="basic-1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Peserta</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Golongan</th>
                                            <th>Jabatan</th>
                                            {{-- <th>Status Absensi</th> --}}
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            @if ($pesertas->nama)
                                                <td>{{$pesertas->nama}} <br> <small>({{$pesertas->nip}})</small></td>
                                                <td>{{$pesertas->jenis_kelamin}}</td>
                                                <td>{{$pesertas->golongan}}</td>
                                                <td>{{$pesertas->jabatan}}</td>
                                            @else
                                                <td>{{$pesertas->pegawai->nama}} <br> <small>({{$pesertas->pegawai->nip}})</small></td>
                                                <td>{{$pesertas->pegawai->jenis_kelamin}}</td>
                                                <td>{{$pesertas->pegawai->golongan}}</td>
                                                <td>{{$pesertas->pegawai->jabatan}}</td>
                                            @endif
                                            <td>{{($pesertas->status_registrasi) ? "Sudah Registrasi" : "Belum Registrasi"}}</td>
                                            <td>
                                                <ul class="action">
                                                    <li><button class="btn btn-primary ttd-aksi" data-id="{{$pesertas->id}}"><i class="fa fa-sign-in"></i></button></li>
                                                </ul>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="ttd-modal" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myExtraLargeModal">Tanda tangan digital</h4>
                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body dark-modal">
                    <div class="card">
                        <form class="form theme-form dark-inputs">
                            <input type="hidden" id="id_kegiatan" value="{{$id_event}}">
                            <input type="hidden" id="id">
                            <div class="card-body">
                                <div class="row">
                                    <div class="border-canvas">
                                        <canvas width="850" height="400" id="signature-pad"
                                            class="signature-pad"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button id="reset-canvas" class="btn btn-danger mr-1" type="button">Hapus
                                    TTD</button>
                                <button class="btn btn-primary me-3" type="button" id="simpan-ttd">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-alert" id="alert" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body"> 
              <div class="modal-toggle-wrapper">  
                <ul class="modal-img">
                  <li> <img id="alert-image"></li>
                </ul>
                <h4 class="text-center pb-2" id="alert-title"></h4>
                <p class="text-center" id="alert-message"></p>
                <button class="btn btn-secondary d-flex m-auto" type="button" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection

@section('own_script')
    <script src="{{asset('own_assets/js/registrasi.js')}}"></script>
@endsection
