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
                                            <th>Nama Peserta</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Golongan</th>
                                            <th>Jabatan</th>
                                            <th>Bank</th>
                                            <th>Status Pengambilan Kit</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pesertas as $p)
                                        <tr>
                                            <td>{{$p->nama}} <br> <small>({{$p->nip}})</small></td>
                                            <td>{{$p->jenis_kelamin}}</td>
                                            <td>{{$p->golongan}}</td>
                                            <td>{{$p->jabatan}}</td>
                                            <td>{{$p->no_rek}} <br> <small>({{$p->bank}})</small></td>
                                            <td>{{($p->status_kit) ? "Sudah Diambil" : "Belum Diambil"}}</td>
                                            <td>
                                                <ul class="action">
                                                    <li class="registrasi" data-id="{{$p->id}}" style="margin-left: 5px"><a href="#"><i class="fa fa-sign-in"></i></a></li>
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
                    <h4 class="modal-title" id="myExtraLargeModal">Status Pengambilan Kit</h4>
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
                                                type="text" placeholder="Nama Peserta" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="nip">NIP Peserta</label>
                                            <input class="form-control input-air-primary" id="nip"
                                                type="text" placeholder="NIP Peserta" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="golongan">Golongan</label>
                                            <input class="form-control input-air-primary" id="golongan"
                                                type="text" placeholder="Golongan" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="jabatan">Jabatan Peserta</label>
                                            <input class="form-control input-air-primary" id="jabatan"
                                                type="text" placeholder="Jabatan Peserta" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="jenis_kelamin">Jenis Kelamin</label>
                                            <input class="form-control input-air-primary" id="jenis_kelamin"
                                                type="text" placeholder="Jenis Kelamin" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="status_kit">Status Kit</label>
                                            <select name="" class="form-control input-air-primary" id="status_kit">
                                                <option value="1">Sudah Mengambil</option>
                                                <option value="0">Belum Mengambil</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <input class="btn btn-light" type="reset" value="Cancel">
                                <button class="btn btn-primary me-3" type="button" id="update">Simpan</button>
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
    <script src="{{asset('own_assets/js/seminar_kit.js')}}"></script>
@endsection
