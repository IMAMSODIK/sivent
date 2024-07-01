@extends('template')

@section('content')
    <div class="page-body">
        <div class="container-fluid mt-4">
            <div class="page-title">
                <div class="row mt-4">
                    <div class="col-6">
                        <h4>Daftar Laporan</h4>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <button class="btn btn-success" id="tambah-data">Tambah Data</button>
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
                                            <th style="width: 10%; font-size: 18px" class="text-center">No. </th>
                                            <th style="width: 25%; font-size: 18px" class="text-center">Nama Laporan</th>
                                            <th style="width: 40%; font-size: 18px" class="text-center">Deskripsi Laporan
                                            </th>
                                            <th style="width: 15%; font-size: 18px" class="text-center">File Laporan</th>
                                            <th style="width: 10%; font-size: 18px" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $index = 0; ?>
                                        @foreach ($laporans as $p)
                                            <tr>
                                                <td style="font-size: 18px" class="text-center">{{ ++$index }}</td>
                                                <td style="font-size: 18px">{{ $p->nama }}</td>
                                                <td style="font-size: 18px">{{ $p->deskripsi }}</td>
                                                <td style="font-size: 18px" class="text-center"><a href="{{asset('storage/laporan') . '/' . $p->file}}" download>Lihat Laporan</a></td>
                                                <td class="text-center">
                                                    <ul class="action">
                                                        <li class="edit" data-id="{{ $p->id }}"> <a
                                                                href="#"><i class="icon-pencil-alt"
                                                                    style="font-size: 25px"></i></a></li>
                                                        <li class="delete" data-id="{{ $p->id }}"><a
                                                                href="#"><i class="icon-trash"
                                                                    style="font-size: 25px"></i></a></li>
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

    <!-- Tambah Dokumen Modal -->
    <div class="modal fade bd-example-modal-lg" id="tambah-data-modal" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myExtraLargeModal">Tambah Laporan</h4>
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
                                            <label class="form-label" for="nama">Nama Laporan</label>
                                            <input class="form-control input-air-primary" id="nama"
                                                type="text" placeholder="Nama Laporan">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="deskripsi">Deskripsi Laporan</label>
                                            <textarea class="form-control input-air-primary" id="deskripsi" cols="30" rows="10" placeholder="Deksripsi Laporan"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="dokumen">Upload Laporan</label>
                                            <input class="form-control input-air-primary" id="dokumen" type="file">
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
                    <h4 class="modal-title" id="myExtraLargeModal">Edit Dokumen</h4>
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
                                            <label class="form-label" for="edit_nama">Nama Dokumen</label>
                                            <input class="form-control input-air-primary" id="edit_nama"
                                                type="text" placeholder="Nama Dokumen">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="edit_deskripsi">Deskripsi Dokumen</label>
                                            <textarea class="form-control input-air-primary" id="edit_deskripsi" cols="30" rows="10" placeholder="Deksripsi Dokumen"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="mb-3">
                                                    <label class="form-label" for="edit_dokumen">Upload Dokumen</label>
                                                    <input class="form-control input-air-primary" id="edit_dokumen" type="file">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label" for="">Dokumen Sebelumnya</label>
                                                    <a href="" class="btn btn-primary" download id="dokumen_sebelumnya">Lihat Dokumen</a>
                                                </div>
                                            </div>
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

    <!-- Alert Modal -->
    <div class="modal fade modal-alert" id="alert" tabindex="-1" role="dialog" aria-labelledby=""
        aria-hidden="true" style="z-index: 1060;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-toggle-wrapper">
                        <ul class="modal-img">
                            <li> <img id="alert-image"></li>
                        </ul>
                        <h4 class="text-center pb-2" id="alert-title"></h4>
                        <p class="text-center" id="alert-message"></p>
                        <button class="btn btn-secondary d-flex m-auto" type="button"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirm Modal -->
    <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true"
        style="z-index: 1070;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-toggle-wrapper">
                        <ul class="modal-img">
                            <li> <img id="alert-image" src="{{ asset('own_assets/icon/confirm.gif') }}" width="300px">
                            </li>
                        </ul>
                        <h4 class="text-center pb-2" id="alert-title">Hapus Data</h4>
                        <p class="text-center" id="alert-message">Apakah anda yakin ingin menghapus data?</p>
                        <div class="row">
                            <div class="col-md-6 d-flex justify-content-end">
                                <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Cancel</button>
                            </div>
                            <div class="col-md-6 d-flex justify-content-start">
                                <button class="btn btn-danger" id="delete-confirmed" type="button"
                                    data-bs-dismiss="modal">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('own_script')
    <script src="{{ asset('own_assets/js/laporan.js') }}"></script>
@endsection
