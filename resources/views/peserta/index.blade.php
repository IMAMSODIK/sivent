@extends('template')

@section('content')
<div class="page-body">
    <div class="container-fluid mt-4">
      <div class="page-title">
        <div class="row">
          <div class="col-6">
            <h4>Daftar Kegiatan</h4>
          </div>
        </div>
      </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">

        <div class="row">
            <div class="col-xl-4 col-sm-6 rapat" style="cursor: pointer">
                <div class="card o-hidden small-widget">
                    <div class="card-body total-project border-b-primary border-2">
                        <span class="f-light f-w-500 f-14">Rapat</span>
                        <div class="project-details">
                            <div class="project-counter">
                                <h2 class="f-w-600">{{$count_rapat}}</h2>
                                <span class="f-12 f-w-400">(Kegiatan)</span>
                            </div>
                            <div class="product-sub bg-primary-light">
                                <svg class="invoice-icon">
                                    <use
                                        xlink:href="{{ asset('assets/svg/icon-sprite.svg#color-swatch') }}">
                                    </use>
                                </svg>
                            </div>
                        </div>
                        <ul class="bubbles">
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li clPesertaass="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 meeting" style="cursor: pointer">
                <div class="card o-hidden small-widget">
                    <div class="card-body total-Progress border-b-warning border-2">
                        <span class="f-light f-w-500 f-14">Meeting</span>
                        <div class="project-details">
                            <div class="project-counter">
                                <h2 class="f-w-600">{{$count_meeting}}</h2>
                                <span class="f-12 f-w-400">(Kegiatan)</span>
                            </div>
                            <div class="product-sub bg-warning-light">
                                <svg class="invoice-icon">
                                    <use
                                        xlink:href="{{ asset('assets/svg/icon-sprite.svg#tick-circle') }}">
                                    </use>
                                </svg>
                            </div>
                        </div>
                        <ul class="bubbles">
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 lembur" style="cursor: pointer">
                <div class="card o-hidden small-widget">
                    <div class="card-body total-Complete border-b-secondary border-2">
                        <span class="f-light f-w-500 f-14">Lembur</span>
                        <div class="project-details">
                            <div class="project-counter">
                                <h2 class="f-w-600">{{$count_lembur}}</h2>
                                <span class="f-12 f-w-400">(Kegiatan)</span>
                            </div>
                            <div class="product-sub bg-secondary-light">
                                <svg class="invoice-icon">
                                    <use
                                        xlink:href="{{ asset('assets/svg/icon-sprite.svg#add-square') }}">
                                    </use>
                                </svg>
                            </div>
                        </div>
                        <ul class="bubbles">
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

      <div class="row">
        <div class="col-xl-9 xl-60 order-xl-0 order-1 box-col-12">
            <div class="done row">
              @foreach ($event_incoming as $d)
                <div class="col-xl-4 xl-50 col-sm-6 box-col-6">
                  <div class="card">
                    <div class="blog-box blog-grid text-center product-box">
                      <div class="product-img"><img class="img-fluid top-radius-blog" src="{{asset('storage/flayer') . '/' . $d->flayer}}" alt="" style="width: 350px; height: 350px">
                        <div class="product-hover">
                          <ul>
                            <li><i class="icon-link"></i></li>
                            <li><i class="icon-import"></i></li>
                          </ul>
                        </div>
                      </div>
                      <div class="blog-details-main">
                        <ul class="blog-social">
                          <li>{{$d->tanggal_kegiatan}}</li>
                          <li>{{$d->waktu_kegiatan}}</li>
                          <li>{{$d->lokasi_kegiatan}}</li>
                        </ul>
                        <hr>
                        <h6 class="blog-bottom-details">{{$d->nama_kegiatan}}</h6>
                        <p>{{$d->deskripsi_kegiatan}}</p>
                        <a href="/data-peserta/daftar-peserta?kegiatan_id={{$d->event_id}}"><button class="btn btn-secondary d-flex m-auto mb-2" type="button">Peserta</button></a>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach  
            </div>
        </div>
        <div class="col-xl-3 xl-40 box-col-12 learning-filter">
          <div class="md-sidebar"><a class="btn btn-primary email-aside-toggle md-sidebar-toggle">Learning filter</a>
            <div class="md-sidebar-aside job-sidebar">
              <div class="default-according style-1 faq-accordion job-accordion" id="accordionoc">
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
                          <div class="checkbox-animated">
                            <div class="learning-header"><span class="f-w-600">Unit Kerja</span></div>
                            <label class="d-block" for="chk-ani">
                              <input class="checkbox_animated" id="chk-ani" type="checkbox">                      Accounting
                            </label>
                            <label class="d-block" for="chk-ani0">
                              <input class="checkbox_animated" id="chk-ani0" type="checkbox">                            Design
                            </label>
                            <label class="d-block" for="chk-ani1">
                              <input class="checkbox_animated" id="chk-ani1" type="checkbox">                            Development
                            </label>
                            <label class="d-block" for="chk-ani2">
                              <input class="checkbox_animated" id="chk-ani2" type="checkbox">                            Management
                            </label>
                          </div>
                          <div class="checkbox-animated mt-0">
                            <div class="learning-header"><span class="f-w-600">Status Event</span></div>
                            <label class="d-block" for="chk-ani3">
                              <input class="checkbox_animated" id="chk-ani3" type="checkbox">                            Registration
                            </label>
                            <label class="d-block" for="chk-ani4">
                              <input class="checkbox_animated" id="chk-ani4" type="checkbox">                            Progress
                            </label>
                            <label class="d-block" for="chk-ani5">
                              <input class="checkbox_animated" id="chk-ani5" type="checkbox">                            Completed
                            </label>
                          </div>
                          <button class="btn btn-primary text-center" type="button">Filter</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Container-fluid Ends-->
  </div>

  {{-- <div class="modal fade bd-example-modal-lg" id="tambah-rapat-modal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModal" aria-hidden="true">
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
                      <input class="form-control input-air-primary" id="nama_kegiatan" type="text" placeholder="Nama Kegiatan">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="mb-3">
                      <label class="form-label" for="lokasi_kegiatan">Lokasi Kegiatan</label>
                      <input class="form-control input-air-primary" id="lokasi_kegiatan" type="text" placeholder="Lokasi Kegiatan">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="mb-3">
                      <label class="form-label" for="exampleInputPassword16">Waktu Kegiatan</label>
                      <div class="row">
                        <div class="col-sm-6">
                          <input class="form-control digits" id="tanggal_kegiatan" type="date" value="2018-01-01">
                        </div>
                        <div class="col-sm-6">
                          <input class="form-control digits" id="waktu_kegiatan" type="time" value="21:45:00">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="mb-3">
                      <label class="form-label" for="deskripsi_kegiatan">Deskripsi Kegiatan</label>
                      <textarea class="form-control input-air-primary" id="deskripsi_kegiatan" rows="3"></textarea>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="mb-3">
                      <label class="form-label" for="no_surat">Nomor Surat Undangan</label>
                      <input class="form-control input-air-primary" id="no_surat" type="text" placeholder="Lokasi Kegiatan">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="mb-3">
                      <label class="form-label" for="flayer">File Flayer Kegiatan</label>
                      <input class="form-control input-air-primary" id="flayer" type="file">
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
  </div> --}}

  {{-- <div class="modal fade" id="alert" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter1" aria-hidden="true">
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
  </div> --}}
@endsection

@section('own_script')
    <script src="{{asset('own_assets/js/peserta.js')}}"></script>
@endsection