@extends('template')

@section('content')
    <div class="page-body">
        <div class="container-fluid mt-4">
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
                                            <th width="15%">Status Absensi</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $index = 1; ?>
                                        @foreach ($pesertas as $p)
                                        <tr>
                                            <td>{{$index++}}</td>
                                            @if ($p->nama)
                                                <td>{{$p->nama}} <br> <small>({{$p->nip}})</small></td>
                                                <td>{{$p->jenis_kelamin}}</td>
                                                <td>{{$p->golongan}}</td>
                                                <td>{{$p->jabatan}}</td>
                                            @else
                                                <td>{{$p->pegawai->nama}} <br> <small>({{$p->pegawai->nip}})</small></td>
                                                <td>{{$p->pegawai->jenis_kelamin}}</td>
                                                <td>{{$p->pegawai->golongan}}</td>
                                                <td>{{$p->pegawai->jabatan}}</td>
                                            @endif
                                            <td>
                                                @foreach ($p->absensi as $abs)
                                                    <p>Hadir <br> ({{$abs->time}})</p>
                                                @endforeach
                                            </td>
                                            <td>
                                                <ul class="action">
                                                    <li><button class="btn btn-primary absensi" data-id="{{$p->id}}"><i class="fa fa-sign-in"></i></button></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="edit-data-modal" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myExtraLargeModal">Status Registrasi Peserta</h4>
                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body dark-modal">
                    <div class="card">
                        <form class="form theme-form dark-inputs">
                            <input type="hidden" id="id_kegiatan" value="{{$id_event}}">
                            <input type="hidden" id="id">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="nama">Nama Peserta</label>
                                            <input class="form-control input-air-primary" id="nama"
                                                type="text" placeholder="Nama Peserta">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="nip">NIP Peserta</label>
                                            <input class="form-control input-air-primary" id="nip"
                                                type="text" placeholder="NIP Peserta">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="golongan">Golongan</label>
                                            <select name="" class="form-control input-air-primary" id="golongan">
                                                <option value="I">I</option>
                                                <option value="II">II</option>
                                                <option value="III">III</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="jabatan">Jabatan Peserta</label>
                                            <input class="form-control input-air-primary" id="jabatan"
                                                type="text" placeholder="Jabatan Peserta">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                                            <select name="" class="form-control input-air-primary" id="jenis_kelamin">
                                                <option value="Laki-laki">Laki-laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="status_absensi">Status Absensi</label>
                                            <select name="" class="form-control input-air-primary" id="status_absensi">
                                                <option value="Hadir">Hadir</option>
                                                <option value="Absen">Absen</option>
                                                <option value="Izin">Izin</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <input class="btn btn-light" type="reset" value="Cancel">
                                <button class="btn btn-primary me-3" type="button" id="absensi">Absensi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="absensi-modal" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModal" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myExtraLargeModal">Registrasi Peserta</h4>
                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body dark-modal">
                    <div class="card">
                        <form class="form theme-form dark-inputs">
                            <input type="hidden" id="id_kegiatan" value="{{$id_event}}">
                            <input type="hidden" id="id_pegawai">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="tanggal">Tanggal Registrasi</label>
                                            <input class="form-control input-air-primary" id="tanggal"
                                                type="date">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <button class="btn btn-primary" type="button" id="submit_absensi">Submit Absen</button>
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
