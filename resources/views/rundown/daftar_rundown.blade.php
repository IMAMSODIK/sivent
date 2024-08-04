@extends('template')

@section('own_style')
    <style>
        .modal-body-export {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .d-flex {
            display: flex;
        }

        .justify-content-center {
            justify-content: center;
        }

        .mx-2 {
            margin-left: 0.5rem;
            margin-right: 0.5rem;
        }

        .mb-3 {
            margin-bottom: 1rem;
        }

        .btn {
            margin: 0.5rem; /* Optional: Add some spacing around the buttons */
        }

    </style>
@endsection

@section('content')
    <div class="page-body">
        <div class="container-fluid mt-4">
            <div class="page-title">
                <div class="row mt-4">
                    <div class="col-6">
                        <h4>Daftar Rundown</h4>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <button class="btn btn-info" id="tambah-data">Tambah Data</button>
                        <button class="btn btn-success" style="margin-right: 5px" id="export-rundown"><i class="fa fa-table text-white" aria-hidden="true"></i> Export Rundown</button>
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
                                            <th style="width: 10%; font-size: 18px" class="text-center">Tanggal</th>
                                            <th style="width: 10%; font-size: 18px" class="text-center">Waktu</th>
                                            <th style="width: 40%; font-size: 18px" class="text-center">Keterangan</th>
                                            <th style="width: 20%; font-size: 18px" class="text-center">Pembawa Acara</th>
                                            <th style="width: 5%; font-size: 18px" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $index = 0; ?>
                                        @foreach ($rundown as $p)
                                        <tr>
                                            <td style="font-size: 18px" class="text-center">{{++$index}}</td>
                                            <td style="font-size: 18px" class="text-center">{{$p->tanggal_kegiatan}}</small></td>
                                            <td style="font-size: 18px" class="text-center">{{$p->waktu_kegiatan}}</td>
                                            <td style="font-size: 18px">{{$p->keterangan_kegiatan}}</td>
                                            <td style="font-size: 18px">{{$p->aktor}}</td>
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
                    <h4 class="modal-title" id="myExtraLargeModal">Tambah Rundown</h4>
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
                                            <label class="form-label" for="waktu">Waktu</label>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input class="form-control digits" id="tanggal_kegiatan" type="date">
                                                </div>
                                                <div class="col-sm-6">
                                                    <input class="form-control digits" id="waktu_kegiatan" type="time" value="00:00:00">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="keterangan">Keterangan</label>
                                            <textarea class="form-control input-air-primary" id="keterangan" cols="30" rows="10" placeholder="Keterangan"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="aktor">Pembawa Acara</label>
                                            <input class="form-control input-air-primary" id="aktor"
                                                type="text" placeholder="Pembawa Acara">
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
                    <h4 class="modal-title" id="myExtraLargeModal">Edit Rundown</h4>
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
                                            <label class="form-label">Waktu</label>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <input class="form-control digits" id="edit_tanggal_kegiatan" type="date">
                                                </div>
                                                <div class="col-sm-6">
                                                    <input class="form-control digits" id="edit_waktu_kegiatan" type="time" value="00:00:00">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="edit_keterangan">Keterangan</label>
                                            <textarea class="form-control input-air-primary" id="edit_keterangan" cols="30" rows="10" placeholder="Keterangan"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="edit_aktor">Pembawa Acara</label>
                                            <input class="form-control input-air-primary" id="edit_aktor"
                                                type="text" placeholder="Pembawa Acara">
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

    <div class="modal fade" id="export" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body modal-body-export">
                    <div class="modal-toggle-wrapper">
                        <ul class="modal-img">
                            <li> <img id="alert-image" src="{{asset("own_assets/icon/download.gif")}}" width="300px"></li>
                        </ul>
                        <h4 class="text-center pb-2" id="alert-title">Download Template</h4>
                        <p class="text-center" id="alert-message">
                            <a href="{{asset('own_assets/document/rundown.xlsx')}}" class="btn btn-info" id="download-template" download>
                                <i class="fa fa-download text-white" aria-hidden="true"></i> Download Template
                            </a>
                        </p>
                        <p class="text-center" id="alert-message">
                            Download dan isi data pada file template. <br> Setelah selesai, upload file tersebut ke form di bawah ini.
                        </p>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label" for="rundown">Upload data rundown</label>
                                    <input class="form-control input-air-primary" id="rundown" type="file">
                                </div>
                            </div>
                        </div>
                        <!-- Container for buttons to align them horizontally -->
                        <div class="d-flex justify-content-center">
                            <button class="btn btn-primary mx-2" id="upload" type="button">Upload</button>
                            <button class="btn btn-secondary mx-2" type="button" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('own_script')
    <script src="{{asset('own_assets/js/rundown.js')}}"></script>
@endsection
