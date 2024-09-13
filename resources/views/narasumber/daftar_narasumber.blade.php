@extends('template')

@section('content')
    <div class="page-body">
        <div class="container-fluid mt-4">
            <div class="page-title">
                <div class="row mt-4">
                    <div class="col-6">
                        <h4>Daftar Narasumber</h4>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <button class="btn btn-success" id="tambah-data" data-id="{{$id_event}}">Tambah Data</button>
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
                                            <th style="width: 5%; font-size: 18px" class="text-center">No. </th>
                                            <th style="width: 30%; font-size: 18px" class="text-center">Nama Narasumber</th>
                                            <th style="width: 10%; font-size: 18px" class="text-center">Jenis Kelamin</th>
                                            <th style="width: 10%; font-size: 18px" class="text-center">Asal Instansi</th>
                                            <th style="width: 5%; font-size: 18px" class="text-center">Golongan</th>
                                            <th style="width: 20%; font-size: 18px" class="text-center">Jabatan</th>
                                            <th style="width: 15%; font-size: 18px" class="text-center">Bank</th>
                                            <th style="width: 5%; font-size: 18px" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $index = 0; ?>
                                        @foreach ($narasumbers as $p)
                                        <tr>
                                            <td style="font-size: 18px" class="text-center">{{++$index}}</td>
                                            <td style="font-size: 18px">{{$p->nama}} <br> <small>({{$p->nip}})</small></td>
                                            <td style="font-size: 18px" class="text-center">{{$p->jenis_kelamin}}</td>
                                            <td style="font-size: 18px">{{$p->asal_instansi}}</td>
                                            <td style="font-size: 18px" class="text-center">{{$p->golongan}}</td>
                                            <td style="font-size: 18px">{{$p->jabatan}}</td>
                                            <td style="font-size: 18px">{{$p->no_rek}} <br> <small>({{$p->bank}})</small></td>
                                            <td class="text-center">
                                                <ul class="action">
                                                    <li class="edit" data-id="{{$p->id}}"> <a href="#"><i
                                                                class="icon-pencil-alt" style="font-size: 25px"></i></a></li>
                                                    <li class="delete" data-id="{{$p->id}}"><a href="#"><i class="icon-trash" style="font-size: 25px"></i></a></li>
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

    <div class="modal fade bd-example-modal-lg" id="tambah-data-modal" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myExtraLargeModal">Tambah Narasumber</h4>
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
                                            <label class="form-label" for="nama">Nama Narasumber</label>
                                            <input class="form-control input-air-primary" id="nama"
                                                type="text" placeholder="Nama Narasumber">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="nip">NIP Narasumber</label>
                                            <input class="form-control input-air-primary" id="nip"
                                                type="text" placeholder="NIP Narasumber">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="asal_instansi">Asal Instansi</label>
                                            <input class="form-control input-air-primary" id="asal_instansi"
                                                type="text" placeholder="Asal Instansi">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="golongan">Golongan</label>
                                            <select name="" class="form-control input-air-primary" id="golongan">
                                                <option value="II/a">II/A</option>
                                                <option value="II/b">II/B</option>
                                                <option value="II/v">II/C</option>
                                                <option value="II/d">II/D</option>
                                                <option value="III/a">III/A</option>
                                                <option value="III/b">III/B</option>
                                                <option value="III/c">III/C</option>
                                                <option value="III/d">III/D</option>
                                                <option value="IV/a">IV/A</option>
                                                <option value="IV/b">IV/B</option>
                                                <option value="IV/c">IV/C</option>
                                                <option value="IV/d">IV/D</option>
                                                <option value="IV/e">IV/E</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="jabatan">Jabatan Narasumber</label>
                                            <select class="form-control input-air-primary" id="jabatan">
                                                @foreach ($jabatan as $j)
                                                    <option value="{{$j->nama_jabatan}}">{{$j->nama_jabatan}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="bank">Bank</label>
                                            <select class="form-control input-air-primary" id="bank">
                                                @foreach ($banks as $bank)
                                                    <option value="{{$bank->nama_bank}}">{{$bank->nama_bank}}</option>
                                                @endforeach
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
                                <input class="btn btn-light" type="button" id="cancel-add" value="Cancel">
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
                    <h4 class="modal-title" id="myExtraLargeModal">Edit Narasumber</h4>
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
                                            <label class="form-label" for="edit_nama">Nama Narasumber</label>
                                            <input class="form-control input-air-primary" id="edit_nama"
                                                type="text" placeholder="Nama Narasumber">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="edit_nip">NIP Narasumber</label>
                                            <input class="form-control input-air-primary" id="edit_nip"
                                                type="text" placeholder="NIP Narasumber">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="edit_asal_instansi">Asal Instansi</label>
                                            <input class="form-control input-air-primary" id="edit_asal_instansi"
                                                type="text" placeholder="Asal Instansi">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="edit_golongan">Golongan</label>
                                            <select name="" class="form-control input-air-primary" id="edit_golongan">
                                                <option value="II/a">II/A</option>
                                                <option value="II/b">II/B</option>
                                                <option value="II/v">II/C</option>
                                                <option value="II/d">II/D</option>
                                                <option value="III/a">III/A</option>
                                                <option value="III/b">III/B</option>
                                                <option value="III/c">III/C</option>
                                                <option value="III/d">III/D</option>
                                                <option value="IV/a">IV/A</option>
                                                <option value="IV/b">IV/B</option>
                                                <option value="IV/c">IV/C</option>
                                                <option value="IV/d">IV/D</option>
                                                <option value="IV/e">IV/E</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="edit_jabatan">Jabatan Narasumber</label>
                                            <select class="form-control input-air-primary" id="edit_jabatan">
                                                @foreach ($jabatan as $j)
                                                    <option value="{{$j->nama_jabatan}}">{{$j->nama_jabatan}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="edit_bank">Bank</label>
                                            <select class="form-control input-air-primary" id="edit_bank">
                                                @foreach ($banks as $bank)
                                                    <option value="{{$bank->nama_bank}}">{{$bank->nama_bank}}</option>
                                                @endforeach
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
                                <input class="btn btn-light" type="button" id="cancel-edit" value="Cancel">
                                <button class="btn btn-primary me-3" type="button" id="update">Update</button>
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
@endsection

@section('own_script')
    <script src="{{asset('own_assets/js/narsum.js')}}"></script>
@endsection
