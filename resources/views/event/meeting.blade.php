@extends('template')

@section('content')
<div class="page-body" style="margin-top: 150px">
    <!-- Container-fluid starts-->
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-9 xl-60 order-xl-0 order-1 box-col-12">
          <div class="row">
            <div class="container-fluid">
              <div class="page-title">
                <div class="row">
                  <div class="col-6">
                    <h4>Meeting Akan Datang</h4>
                  </div>
                </div>
              </div>
            </div>
            <div class="incoming">
              @foreach ($event_incoming as $done)
                <div class="col-xl-12 incoming-card" data-id="{{$done->event_id}}">
                  <div class="card">
                    <div class="blog-box blog-list row">
                      <div class="col-sm-5"><img class="img-fluid sm-100-w flayer-incoming" src="{{asset('storage/flayer') . '/' . $done->flayer}}" alt="" style="width: 600px; height: 350px"></div>
                      <div class="col-sm-7">
                        <div class="blog-details">
                          <div class="blog-date"><span class="nama-incoming">{{$done->nama_kegiatan}}</span></div>
                          <h6 class="lokasi-incoming">{{$done->lokasi_kegiatan}} </h6>

                          <div class="row">
                            <div class="blog-bottom-content col-md-10 d-flex align-items-center">
                              <ul class="blog-social">
                                <li class="tanggal-incoming">{{$done->tanggal_kegiatan}}, {{$done->waktu_kegiatan}}</li>
                                <li class="no_surat-incoming">{{$done->no_surat}} </li>
                              </ul>
                            </div>
                            <div class="col-md-2 d-flex justify-content-end">
                              <button class="btn btn-danger delete-event" data-id="{{$done->event_id}}" style="margin-right: 5px"><i class="fa fa-trash text-white"></i></button>
                              <button class="btn btn-info edit-event" data-id="{{$done->event_id}}"><i class="fa fa-pencil text-white"></i></button>
                            </div>
                          </div>
                          <hr>
                          <p class="mt-0 deskripsi-incoming">{{$done->deskripsi_kegiatan}}</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>

            <div class="container-fluid mt-4">
              <div class="page-title">
                <div class="row">
                  <div class="col-6">
                    <h4>Meeting Telah Selesai</h4>
                  </div>
                </div>
              </div>
            </div>

            <div class="done row">
              @foreach ($event_done as $d)
                <div class="col-xl-4 xl-50 col-sm-6 box-col-6">
                  <div class="card">
                    <div class="blog-box blog-grid text-center product-box">
                      <div class="product-img"><img class="img-fluid top-radius-blog" src="{{asset('storage/flayer') . '/' . $d->flayer}}" alt="" style="height: 300px">
                        {{-- <div class="product-hover">
                          <ul>
                            <li class="bg-danger"><i class="fa fa-trash text-white"></i></li>
                            <li class="bg-info"><i class="fa fa-pencil text-white"></i></li>
                          </ul>
                        </div> --}}
                      </div>
                      <div class="blog-details-main">
                        <ul class="blog-social">
                          <li>{{$d->tanggal_kegiatan}}</li>
                          <li>{{$d->waktu_kegiatan}}</li>
                          <li>{{$d->lokasi_kegiatan}}</li>
                        </ul>
                        <hr>
                        <h6 class="blog-bottom-details">{{$d->nama_kegiatan}}</h6>
                        <button type="button" class="download_laporan btn btn-primary mb-4" data-id="{{$d->event_id}}" class="btn btn-primary mb-4">Cetak Laporan</button>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach  
            </div>
          </div>
        </div>
        <div class="col-xl-3 xl-40 box-col-12 learning-filter">
          <div class="md-sidebar"><a class="btn btn-primary email-aside-toggle md-sidebar-toggle">Filter Event</a>
            <div class="md-sidebar-aside job-sidebar">
              <div class="default-according style-1 faq-accordion job-accordion" id="accordionoc">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <button class="btn btn-primary text-center" id="tambah-rapat" type="button">Tambah Meeting</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                  <div class="col-xl-12">
                    <div class="card">
                      <div class="card-header">
                        <h5 class="mb-0">
                          <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapseicon" aria-expanded="true" aria-controls="collapseicon">Filter Event</button>
                        </h5>
                      </div>
                      <div class="collapse show" id="collapseicon" aria-labelledby="collapseicon" data-bs-parent="#accordion">
                        <div class="card-body filter-cards-view animate-chk">
                          <div class="job-filter">
                            <div class="faq-form">
                              <input class="form-control" type="text" placeholder="Search.."><i class="search-icon" data-feather="search"></i>
                            </div>
                          </div>
                          <input type="hidden" id="kategori_filter" value="meeting">
                          <div class="checkbox-animated">
                            <div class="learning-header"><span class="f-w-600">Unit Kerja</span></div>
                            @foreach ($unit_kerja as $u)
                              <label class="d-block" for="chk-ani">
                                <input class="unit_kerja_filter checkbox_animated" id="chk-ani" type="checkbox" value="{{$u->id}}">
                                {{$u->nama_unit}}
                              </label>
                            @endforeach
                          </div>
                          <div class="checkbox-animated mt-0">
                            <div class="learning-header"><span class="f-w-600">Status Event</span></div>
                            <label class="d-block" for="chk-ani3">
                              <input class="status_event_filter radio_animated" name="status_event_filter" id="chk-ani3" type="radio" value="1">
                              Hari ini
                            </label>
                            <label class="d-block" for="chk-ani4">
                              <input class="status_event_filter radio_animated" name="status_event_filter" id="chk-ani4" type="radio" value="2">
                              Event Mendatang
                            </label>
                            <label class="d-block" for="chk-ani5">
                              <input class="status_event_filter radio_animated" name="status_event_filter" id="chk-ani5" type="radio" value="3">
                              Event Selesai
                            </label>
                          </div>
                          <button class="btn btn-primary text-center" id="submit-filter" type="button">Filter</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  {{-- <div class="col-xl-12">
                    <div class="card">
                      <div class="card-header">
                        <h5 class="mb-0">
                          <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapseicon1" aria-expanded="true" aria-controls="collapseicon1">Categories</button>
                        </h5>
                      </div>
                      <div class="collapse card-body px-0 show" id="collapseicon1" aria-labelledby="collapseicon1" data-bs-parent="#accordion">
                        <div class="categories">
                          <div class="learning-header"><span class="f-w-600">Design</span></div>
                          <ul>
                            <li><a href="#">UI Design </a><span class="badge badge-primary pull-right">28</span></li>
                            <li><a href="#">UX Design </a><span class="badge badge-primary pull-right">35</span></li>
                            <li><a href="#">Interface Design </a><span class="badge badge-primary pull-right">17</span></li>
                            <li><a href="#">User Experience </a><span class="badge badge-primary pull-right">26</span></li>
                          </ul>
                        </div>
                        <div class="categories pt-0 pb-0">
                          <div class="learning-header"><span class="f-w-600">Development</span></div>
                          <ul>
                          <li><a href="#">Frontend Development</a><span class="badge badge-primary pull-right">48</span></li>
                            <li><a href="#">Backend Development</a><span class="badge badge-primary pull-right">19</span></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div> --}}
                  {{-- <div class="col-xl-12">
                    <div class="card">
                      <div class="card-header">
                        <h5 class="mb-0">
                          <button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#collapseicon2" aria-expanded="true" aria-controls="collapseicon2">Upcoming Courses</button>
                        </h5>
                      </div>
                      <div class="collapse show" id="collapseicon2" aria-labelledby="collapseicon2" data-bs-parent="#accordion">
                        <div class="upcoming-course card-body">
                          <div class="media common-space">
                            <div class="media-body"><span class="f-w-600">UX Development</span><span class="d-block">Course By <a href="#"> Lorem ipsum</a></span><span class="d-block"><i class="fa fa-star font-warning"></i><i class="fa fa-star font-warning"></i><i class="fa fa-star font-warning"></i><i class="fa fa-star font-warning"></i><i class="fa fa-star-half-o font-warning"></i></span></div>
                            <div>
                              <h5 class="mb-0 font-primary">18</h5><span class="d-block">Dec</span>
                            </div>
                          </div>
                          <div class="media common-space">
                            <div class="media-body"><span class="f-w-600">Business Analyst</span><span class="d-block">Course By <a href="#">Lorem ipsum </a></span><span class="d-block"><i class="fa fa-star font-warning"></i><i class="fa fa-star font-warning"></i><i class="fa fa-star font-warning"></i><i class="fa fa-star font-warning"></i><i class="fa fa-star font-warning"></i></span></div>
                            <div>
                              <h5 class="mb-0 font-primary">28</h5><span class="d-block">Dec</span>
                            </div>
                          </div>
                          <div class="media common-space">
                            <div class="media-body"><span class="f-w-600">Web Development</span><span class="d-block">Course By <a href="#">Lorem ipsum </a></span><span class="d-block"><i class="fa fa-star font-warning"></i><i class="fa fa-star font-warning"></i><i class="fa fa-star font-warning"></i><i class="fa fa-star font-warning"></i><i class="fa fa-star-o font-warning"></i></span></div>
                            <div>
                              <h5 class="mb-0 font-primary">5</h5><span class="d-block">Jan</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div> --}}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Container-fluid Ends-->
  </div>

  <div class="modal fade bd-example-modal-lg" id="tambah-rapat-modal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myExtraLargeModal">Tambah Meeting</h4>
          <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body dark-modal"> 
          <div class="card">
            <form class="form theme-form dark-inputs">
              <input type="hidden" id="kategori" value="meeting">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <div class="mb-3">
                      <label class="form-label" for="nama_kegiatan">Nama Kegiatan</label>
                      <input class="form-control input-air-primary h-100" id="nama_kegiatan" type="text" placeholder="Nama Kegiatan">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="mb-3">
                      <label class="form-label" for="unit_kerja">Unit Kerja</label>
                      <select class="form-control input-air-primary h-100" id="unit_kerja">
                          @foreach ($unit_kerja as $u)
                              <option value="{{$u->id}}">{{$u->nama_unit}}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="mb-3">
                      <label class="form-label" for="lokasi_kegiatan">Lokasi Kegiatan</label>
                      <input class="form-control input-air-primary h-100" id="lokasi_kegiatan" type="text" placeholder="Lokasi Kegiatan">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="mb-3">
                      <label class="form-label" for="exampleInputPassword16">Waktu Kegiatan</label>
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
                      <label class="form-label" for="deskripsi_kegiatan">Deskripsi Kegiatan</label>
                      <textarea class="form-control input-air-primary h-100" id="deskripsi_kegiatan" rows="3"></textarea>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="mb-3">
                      <label class="form-label" for="no_surat">Nomor Surat Undangan</label>
                      <input class="form-control input-air-primary h-100" id="no_surat" type="text" placeholder="Nomor Surat Undangan">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="mb-3">
                      <label class="form-label" for="flayer">File Flayer Kegiatan</label>
                      <input class="form-control input-air-primary h-100" id="flayer" type="file">
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer text-end">
                <input class="btn btn-light close-modal" type="reset" value="Cancel">
                <button class="btn btn-primary me-3" type="button" id="store">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade bd-example-modal-lg" id="edit-rapat-modal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myExtraLargeModal">Edit Meeting</h4>
          <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body dark-modal"> 
          <div class="card">
            <form class="form theme-form dark-inputs">
              <input type="hidden" id="edit_kategori" value="meeting">
              <input type="hidden" id="id_event">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <div class="mb-3">
                      <label class="form-label" for="edit_nama_kegiatan">Nama Kegiatan</label>
                      <input class="form-control input-air-primary h-100" id="edit_nama_kegiatan" type="text" placeholder="Nama Kegiatan">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="mb-3">
                      <label class="form-label" for="edit_unit_kerja">Unit Kerja</label>
                      <select class="form-control input-air-primary h-100" id="edit_unit_kerja">
                          @foreach ($unit_kerja as $u)
                              <option value="{{$u->id}}">{{$u->nama_unit}}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="mb-3">
                      <label class="form-label" for="edit_lokasi_kegiatan">Lokasi Kegiatan</label>
                      <input class="form-control input-air-primary h-100" id="edit_lokasi_kegiatan" type="text" placeholder="Lokasi Kegiatan">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="mb-3">
                      <label class="form-label" for="exampleInputPassword16">Waktu Kegiatan</label>
                      <div class="row">
                        <div class="col-sm-6">
                          <input class="form-control digits" id="edit_tanggal_kegiatan" type="date" value="2018-01-01">
                        </div>
                        <div class="col-sm-6">
                          <input class="form-control digits" id="edit_waktu_kegiatan" type="time" value="21:45:00">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="mb-3">
                      <label class="form-label" for="edit_deskripsi_kegiatan">Deskripsi Kegiatan</label>
                      <textarea class="form-control input-air-primary h-100" id="edit_deskripsi_kegiatan" rows="3"></textarea>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="mb-3">
                      <label class="form-label" for="edit_no_surat">Nomor Surat Undangan</label>
                      <input class="form-control input-air-primary h-100" id="edit_no_surat" type="text" placeholder="Nomor Surat Undangan">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="mb-3">
                      <label class="form-label" for="edit_flayer">File Flayer Kegiatan</label>
                      <input class="form-control input-air-primary h-100" id="edit_flayer" type="file">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="mb-3">
                      <label class="form-label">Flayer Event</label>
                      <img alt="Flayer Event" id="gambar_flayer" width="100%">
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer text-end">
                <input class="btn btn-light close-modal" type="reset" value="Cancel">
                <button class="btn btn-primary me-3" type="button" id="update">Submit</button>
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

  <div class="modal fade bd-example-modal-lg" id="laporan-rapat-modal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myExtraLargeModal">Laporan Rapat</h4>
          <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body dark-modal"> 
          <div class="card">
            <form class="form theme-form dark-inputs">
              <input type="hidden" id="id_event">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <div class="mb-3">
                      <label class="form-label">Laporan</label>
                      <textarea class="summernote" name="description" id="laporan"></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer text-end">
                <input class="btn btn-light close-modal" type="button" id="close-download" value="Cancel">
                <button class="btn btn-primary" type="button" id="submit-laporan">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade bd-example-modal-lg" id="ketua-rapat-modal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myExtraLargeModal">Data Rapat</h4>
          <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body dark-modal"> 
          <div class="card">
            <form class="form theme-form dark-inputs">
              <input type="hidden" id="edit_kategori" value="rapat">
              <input type="hidden" id="id_event_ketua">
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <div class="mb-3">
                      <label class="form-label" for="ketua_kegiatan">Ketua Event</label>
                      <select name="" id="ketua_kegiatan" class="form-control h-100">
                        <option value="0" data-nip="NIP" data-jabatan="Jabatan">:: Pilih Pegawai ::</option>
                        @foreach ($pegawais as $p)
                          <option value="{{$p->id}}" data-nip="{{$p->nip}}" data-jabatan="{{$p->jabatan}}">{{$p->nama}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="mb-3">
                      <label class="form-label" for="jabatan_ketua">Jabatan</label>
                      <input class="form-control input-air-primary h-100" id="jabatan_ketua" type="text" placeholder="Jabatan" readonly>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="mb-3">
                      <label class="form-label" for="nip_ketua">NIP</label>
                      <input class="form-control input-air-primary h-100" id="nip_ketua" type="text" placeholder="NIP" readonly>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="mb-3">
                      <label class="form-label" for="tanggal">Tanggal</label>
                      <input class="form-control input-air-primary h-100" id="tanggal" type="date">
                    </div>
                  </div>
                </div>
              <div class="card-footer text-end">
                <input class="btn btn-light close-modal" type="button" id="cancel-ketua" value="Cancel">
                <button class="btn btn-primary me-3" type="button" id="submit-ketua">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('own_script')
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script><script src="{{ asset('dashboard_assets/js/script.bundle.js') }}"></script>
    <script src="{{asset('own_assets/js/rapat.js')}}"></script>
    <script type="text/javascript">
      $(document).ready(function() {
          $('.summernote').summernote();
      });
  </script>
@endsection