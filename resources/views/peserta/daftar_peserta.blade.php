@extends('template')

@section('content')
    <div class="page-body">
        <div class="container-fluid mt-4">
            <div class="page-title">
                <div class="row mt-4">
                    <div class="col-6">
                        <h4>Daftar Peserta</h4>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        {{-- <button class="btn btn-success" style="margin-right: 5px" id="import-data"><i class="fa fa-upload text-white" aria-hidden="true"></i> Import Data</button> --}}
                        <button class="btn btn-info" id="tambah-data" data-kategori="{{$kategori_event}}"><i class="fa fa-plus-square text-white" aria-hidden="true"></i> Tambah Data</button>
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
                                            @if ($kategori_event == 'meeting')
                                                <th>Bank</th>
                                            @endif
                                            <th>Status Absensi</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $index = 1; ?>
                                        @foreach ($pesertas as $p)
                                            @if ($kategori_event == 'rapat' || $kategori_event == 'lembur')
                                                <tr>
                                                    <td>{{$index++}}</td>
                                                    <td>{{$p->pegawai->nama}} <br> <small>({{$p->pegawai->nip}})</small></td>
                                                    <td>{{$p->pegawai->jenis_kelamin}}</td>
                                                    <td>{{$p->pegawai->golongan}}</td>
                                                    <td>{{$p->pegawai->jabatan->nama_jabatan}}</td>
                                                    <td>{{$p->status_absensi}}</td>
                                                    <td class="text-center">
                                                        <ul class="action">
                                                            <li class="delete" data-id="{{$p->id}}"><a href="#"><i class="icon-trash" style="font-size: 25px"></i></a></li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @else
                                                <tr>
                                                    <td>{{$index++}}</td>
                                                    <td>{{$p->nama}} <br> <small>({{$p->nip}})</small></td>
                                                    <td>{{$p->jenis_kelamin}}</td>
                                                    <td>{{$p->golongan}}</td>
                                                    <td>{{$p->jabatan}}</td>
                                                    <td>{{$p->no_rek}} <br> <small>({{$p->bank}})</small></td>
                                                    <td>{{$p->status_absensi}}</td>
                                                    <td class="text-center">
                                                        <ul class="action">
                                                            <li class="edit" data-id="{{$p->id}}"> <a href="#"><i
                                                                        class="icon-pencil-alt" style="font-size: 25px"></i></a></li>
                                                            <li class="delete" data-id="{{$p->id}}"><a href="#"><i class="icon-trash" style="font-size: 25px"></i></a></li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endif
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

    <div class="modal fade bd-example-modal-lg" id="tambah-data-modal" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myExtraLargeModal">Tambah Peserta</h4>
                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body dark-modal">
                    <div class="card">
                        <form class="form theme-form dark-inputs">
                            <input type="hidden" id="id_kegiatan" value="{{$id_event}}">
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
                                            <label class="form-label" for="bank">Bank</label>
                                            <select name="" class="form-control input-air-primary" id="bank">
                                                <option value="MEGA">MEGA</option>
                                                <option value="BRI">BRI</option>
                                                <option value="BCA">BCA</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="no_rek">Nomor Rekening</label>
                                            <input class="form-control input-air-primary" id="no_rek"
                                                type="text" placeholder="Nomor Rekening">
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
                            </div>
                            <div class="card-footer text-end">
                                <input class="btn btn-light" type="reset" value="Cancel">
                                <button class="btn btn-primary me-3" type="button" id="store">Submit</button>
                            </div>
                        </form>
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
                    <h4 class="modal-title" id="myExtraLargeModal">Tambah Peserta</h4>
                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body dark-modal">
                    <div class="card">
                        <form class="form theme-form dark-inputs">
                            <input type="hidden" id="id">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="edit_nama">Nama Peserta</label>
                                            <input class="form-control input-air-primary" id="edit_nama"
                                                type="text" placeholder="Nama Peserta">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="edit_nip">NIP Peserta</label>
                                            <input class="form-control input-air-primary" id="edit_nip"
                                                type="text" placeholder="NIP Peserta">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="edit_golongan">Golongan</label>
                                            <select name="" class="form-control input-air-primary" id="edit_golongan">
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
                                            <label class="form-label" for="edit_jabatan">Jabatan Peserta</label>
                                            <input class="form-control input-air-primary" id="edit_jabatan"
                                                type="text" placeholder="Jabatan Peserta">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="edit_bank">Bank</label>
                                            <select name="" class="form-control input-air-primary" id="edit_bank">
                                                <option value="MEGA">MEGA</option>
                                                <option value="BRI">BRI</option>
                                                <option value="BCA">BCA</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="edit_no_rek">Nomor Rekening</label>
                                            <input class="form-control input-air-primary" id="edit_no_rek"
                                                type="text" placeholder="Nomor Rekening">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="edit_jenis_kelamin">Jenis Kelamin</label>
                                            <select name="" class="form-control input-air-primary" id="edit_jenis_kelamin">
                                                <option value="Laki-laki">Laki-laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <input class="btn btn-light" type="reset" value="Cancel">
                                <button class="btn btn-primary me-3" type="button" id="update">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-xl" id="select-data-modal" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModal" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myExtraLargeModal">Pilih Peserta</h4>
                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body dark-modal">
                    <div class="card">
                        <div class="table-responsive custom-scrollbar">
                            <table class="display" id="select-peserta">
                                <thead>
                                    <tr>
                                        <th class="text-center"><input type="checkbox" name="" id=""></th>
                                        <th>Nama Peserta</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Golongan</th>
                                        <th>Jabatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input class="btn btn-light" type="reset" value="Cancel">
                    <button class="btn btn-primary me-3" type="button" id="selected_peserta">Submit</button>
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
    
      <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body"> 
              <div class="modal-toggle-wrapper">  
                <ul class="modal-img">
                  <li> <img id="alert-image" src="{{asset('own_assets/icon/confirm.gif')}}" width="300px"></li>
                </ul>
                <h4 class="text-center pb-2" id="alert-title">Hapus Data</h4>
                <p class="text-center" id="alert-message">Apakah anda yakin ingin menghapus data?</p>
                <div class="row">
                  <div class="col-md-6 d-flex justify-content-end">
                    <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                  </div>
                  <div class="col-md-6 d-flex justify-content-start">
                    <button class="btn btn-danger" id="delete-confirmed" type="button" data-bs-dismiss="modal">Delete</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    <div class="modal fade" id="export" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-toggle-wrapper">
                        <ul class="modal-img">
                            <li> <img id="alert-image" src="{{asset("own_assets/icon/download.gif")}}" width="300px"></li>
                        </ul>
                        <h4 class="text-center pb-2" id="alert-title">Download Template</h4>
                        <p class="text-center" id="alert-message"><a href="{{asset('own_assets/document/peserta.xlsx')}}" class="btn btn-info" id="download-template" download><i class="fa fa-download text-white" aria-hidden="true"></i> Download Template</a></p>
                        <p class="text-center" id="alert-message">Download dan isi data pada file template. <br>Setelah selesai, upload file tersebut ke form di bawah ini.</p>
                        <hr>
                        <div class="row">
                            <div class="col">
                              <div class="mb-3">
                                <label class="form-label" for="peserta">Upload data peserta</label>
                                <input class="form-control input-air-primary" id="peserta" type="file" disabled>
                              </div>
                            </div>
                        </div>
                        <button class="btn btn-secondary d-flex m-auto" type="button"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('own_script')
    <script src="{{asset('own_assets/js/peserta.js')}}"></script>
@endsection
