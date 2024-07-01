@extends('template')

@section('content')
<div class="page-body">
    <div class="container-fluid mt-5">
      <div class="page-title">
        <div class="row">
          <div class="col-6">
            <h4>User Profile</h4>
          </div>
          <div class="col-6">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.html">                                       
                  <svg class="stroke-icon">
                    <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                  </svg></a></li>
              <li class="breadcrumb-item">Users</li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
      <div class="user-profile">
        <div class="row">
          <!-- user profile first-style start-->
          <div class="col-sm-12">
            <div class="card hovercard text-center">
              <div class="cardheader"></div>
              <div class="user-image">
                <div class="avatar"><img alt="" style="width: 75px; height: 75px; cursor: pointer" src="{{($user->foto) ? asset('storage/user') . '/' . $user->foto : asset('own_assets/images/user.png')}}"></div>
                <div class="icon-wrapper"><i class="icofont icofont-pencil-alt-5 edit-image"></i></div>
              </div>
              <div class="info">
                <div class="row">
                  <div class="col-sm-6 col-lg-4 order-sm-1 order-xl-0">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="ttl-info text-start">
                          <h6><i class="fa fa-user"></i> Username</h6><span>{{$user->username}}</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-12 col-lg-4 order-sm-0 order-xl-1">
                    <div class="user-designation">
                      <div class="title"><a target="_blank" href="">{{$user->name}}</a></div>
                      <div class="desc">{{($user->role == "super_admin") ? "Super Admin" : "Admin" }}</div>
                    </div>
                  </div>
                </div>
                <hr>
                {{-- <div class="social-media">
                  <ul class="list-inline">
                    <li class="list-inline-item"><a href="https://www.facebook.com/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                    <li class="list-inline-item"><a href="https://accounts.google.com/" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                    <li class="list-inline-item"><a href="https://twitter.com/" target="_blank"><i class="fa fa-twitter"></i></a></li>
                    <li class="list-inline-item"><a href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                    <li class="list-inline-item"><a href="https://rss.app/" target="_blank"><i class="fa fa-rss"></i></a></li>
                  </ul>
                </div> --}}
                <div class="follow">
                  <div class="row">
                    <div class="col-12 text-md-center">
                      <div class="follow-num counter">{{$user->event->count()}}</div><span>Event</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="row">
            <div class="col-xl-4 col-sm-6 rapat" style="cursor: pointer">
                <div class="card o-hidden small-widget">
                    <div class="card-body total-project border-b-primary border-2">
                        <span class="f-light f-w-500 f-14">Rapat</span>
                        <div class="project-details">
                            <div class="project-counter">
                                <h2 class="f-w-600"></h2>
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
                            <li class="bubble"></li>
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
                                <h2 class="f-w-600"></h2>
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
                                <h2 class="f-w-600"></h2>
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

            <div class="row">
              {{-- <div class="incoming">
                @foreach ($event_incoming as $incoming)
                  <div class="col-xl-12 incoming-card" data-id="{{$incoming->event_id}}">
                    <div class="card">
                      <div class="blog-box blog-list row">
                        <div class="col-sm-5"><img class="img-fluid sm-100-w flayer-incoming" src="{{asset('storage/flayer') . '/' . $incoming->flayer}}" alt="" style="width: 600px; height: 350px"></div>
                        <div class="col-sm-7">
                          <div class="blog-details">
                            <div class="blog-date"><span class="nama-incoming">{{$incoming->nama_kegiatan}}</span></div>
                            <h6 class="lokasi-incoming">{{$incoming->lokasi_kegiatan}} </h6>

                            <div class="row">
                              <div class="blog-bottom-content col-md-10 d-flex align-items-center">
                                <ul class="blog-social">
                                  <li class="tanggal-incoming">{{$incoming->tanggal_kegiatan}}, {{$incoming->waktu_kegiatan}}</li>
                                  <li class="no_surat-incoming">{{$incoming->no_surat}} </li>
                                </ul>
                              </div>
                              <div class="col-md-2 d-flex justify-content-end">
                                <a href="/data-rundown/daftar-rundown?kegiatan_id={{$incoming->event_id}}"><button class="btn btn-secondary d-flex m-auto mb-2" type="button">Rundown</button></a>
                              </div>
                            </div>
                            <hr>
                            <p class="mt-0 deskripsi-incoming">{{$incoming->deskripsi_kegiatan}}</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div> --}}

              <div class="container-fluid mt-4">
                <div class="page-title">
                  <div class="row">
                    <div class="col-6">
                      <h4>Event Telah Selesai</h4>
                    </div>
                  </div>
                </div>
              </div>

              {{-- <div class="done row">
                @foreach ($event_done as $d)
                  <div class="col-xl-4 xl-50 col-sm-6 box-col-6">
                    <div class="card">
                      <div class="blog-box blog-grid text-center product-box">
                        <div class="product-img"><img class="img-fluid top-radius-blog" src="{{asset('storage/flayer') . '/' . $d->flayer}}" alt="" style="height: 300px">
                          <div class="product-hover">
                            <ul>
                              <li class="detail-flayer" data-path="{{$d->flayer}}"><i class="fa fa-eye"></i></li>
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
                          <p class="px-3">{{$d->deskripsi_kegiatan}}</p>
                          <a href="/data-rundown/daftar-rundown?kegiatan_id={{$d->event_id}}"><button class="btn btn-secondary d-flex m-auto mb-4***" type="button">Rundown</button></a>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach  
              </div> --}}
            </div>
          </div>
          <div class="col-xl-3 xl-40 box-col-12 learning-filter">
            <div class="md-sidebar"><a class="btn btn-primary email-aside-toggle md-sidebar-toggle">Filter Event</a>
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
                            <input type="hidden" id="kategori_filter">
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

    {{-- <div class="modal fade bd-example-modal-lg" id="tambah-data-modal" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myExtraLargeModal">Tambah Jabatan</h4>
                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body dark-modal">
                    <div class="card">
                        <form class="form theme-form dark-inputs">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="nama_jabatan">Nama Jabatan</label>
                                            <input class="form-control input-air-primary" id="nama_jabatan"
                                                type="text" placeholder="Nama Bank">
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

    <div class="modal fade bd-example-modal-lg" id="edit-data-modal" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myExtraLargeModal">Ubah Foto</h4>
                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body dark-modal">
                    <div class="card">
                        <form class="form theme-form dark-inputs">
                            <input type="hidden" name="" id="id">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="foto_user">Upload Foto</label>
                                            <input class="form-control input-air-primary" id="foto_user"
                                                type="file">
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

    <div class="modal fade bd-example-modal-lg" id="detail-foto" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myExtraLargeModal">Detail Foto</h4>
                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body dark-modal">
                    <div class="card">
                        <form class="form theme-form dark-inputs">
                            <input type="hidden" name="" id="id">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="mb-3">
                                            <label class="form-label" for="foto_user">Upload Foto</label>
                                            <input class="form-control input-air-primary" id="foto_user"
                                                type="file">
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

    {{-- <div class="modal fade modal-alert" id="alert" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter1"
        aria-hidden="true">
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
    </div> --}}

    {{-- <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenter1" aria-hidden="true">
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
    </div> --}}
@endsection

@section('own_script')
    <script>
        $(".edit-image").on("click", function(){
            $("#edit-data-modal").modal("show");
        })

        $(".avatar img").on("click", function(){
            $("#detail-foto").modal("show");
        })
    </script>
@endsection
