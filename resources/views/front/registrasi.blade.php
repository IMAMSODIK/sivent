<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--
        Document Title
        =============================================
        -->
    <title>Titan | Multipurpose HTML5 Template</title>
    <!--
        Favicons
        =============================================
        -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('landing_page/images/favicons/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('landing_page/images/favicons/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('landing_page/images/favicons/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('landing_page/images/favicons/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114"
        href="{{ asset('landing_page/images/favicons/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120"
        href="{{ asset('landing_page/images/favicons/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144"
        href="{{ asset('landing_page/images/favicons/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152"
        href="{{ asset('landing_page/images/favicons/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('landing_page/images/favicons/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"
        href="{{ asset('landing_page/images/favicons/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('landing_page/images/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96"
        href="{{ asset('landing_page/images/favicons/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('landing_page/images/favicons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('landing_page/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('landing_page/images/favicons/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        #absensi_peserta .card{
            font-size: 16px;
        }

        #absensi_peserta input{
            font-size: 20px;
        }

        #absensi_peserta select{
            font-size: 20px;
        }

        #example tbody td{
            font-size: 15px;
        }
    </style>
    <!--
        Stylesheets
        =============================================
        
        -->
    <!-- Default stylesheets-->
    <link href="{{ asset('landing_page/lib/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Template specific stylesheets-->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Volkhov:400i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="{{ asset('landing_page/lib/animate.css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('landing_page/lib/components-font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landing_page/lib/et-line-font/et-line-font.css') }}" rel="stylesheet">
    <link href="{{ asset('landing_page/lib/flexslider/flexslider.css') }}" rel="stylesheet">
    <link href="{{ asset('landing_page/lib/owl.carousel/dist/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landing_page/assets/lib/owl.carousel/dist/assets/owl.theme.default.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('landing_page/lib/magnific-popup/dist/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('landing_page/lib/simple-text-rotator/simpletextrotator.css') }}" rel="stylesheet">
    <!-- Main stylesheet and color file-->
    <link href="{{ asset('landing_page/css/style.css') }}" rel="stylesheet">
    <link id="color-scheme" href="{{ asset('landing_page/css/colors/default.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css">
    <link href="https://cdn.datatables.net/v/dt/dt-2.0.8/datatables.min.css" rel="stylesheet">
</head>

<body data-spy="scroll" data-target=".onpage-navigation" data-offset="60">
    <main>
        <div class="page-loader">
            <div class="loader">Loading...</div>
        </div>
        <nav class="navbar navbar-custom navbar-fixed-top bg-dark" style="padding-top: 40px; padding-bottom: 40px; font-size: 18px" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle" type="button" data-toggle="collapse"
                        data-target="#custom-collapse"><span class="sr-only">Toggle navigation</span><span
                            class="icon-bar"></span><span class="icon-bar"></span><span
                            class="icon-bar"></span></button><a class="navbar-brand" href="index.html">Titan</a>
                </div>
                <div class="collapse navbar-collapse" id="custom-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown"><a class="" href="/">Home</a>
                        </li>
                        {{-- <li class="dropdown"><a class="dropdown-toggle" href="#"
                                data-toggle="dropdown">Rapat</a>
                            <ul class="dropdown-menu">
                                <li style="font-size: 15px"><a href="/absensi-peserta/front">Absensi</a></li>
                            </ul>
                        </li>
                        <li class="dropdown"><a class="dropdown-toggle" href="#"
                            data-toggle="dropdown">Meeting</a>
                            <ul class="dropdown-menu">
                                <li style="font-size: 15px"><a href="/registrasi-peserta/front">Registrasi</a></li>
                                <li style="font-size: 15px"><a href="/absensi-peserta/front">Absensi</a></li>
                                <li style="font-size: 15px"><a href="/kit-peserta/front">Seminar Kit</a></li>
                            </ul>
                        </li>
                        <li class="dropdown"><a class="dropdown-toggle" href="#"
                            data-toggle="dropdown">Lembur</a>
                            <ul class="dropdown-menu">
                                <li style="font-size: 15px"><a href="documentation.html#contact">Absensi</a></li>
                            </ul>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </nav>
        {{-- <section class="home-section home-fade home-full-height" id="home">
            <div class="hero-slider">
                <ul class="slides">
                    <li class="bg-dark-30 bg-dark shop-page-header"
                        style="background-image: url('{{ asset('landing_page/images/shop/slider1.png') }}');">
                        <div class="titan-caption">
                            <div class="caption-content">
                                <div class="font-alt mb-30 titan-title-size-1">This is Titan</div>
                                <div class="font-alt mb-30 titan-title-size-4"> Summer 2017</div>
                                <div class="font-alt mb-40 titan-title-size-1">Your online fashion destination</div>
                                <a class="section-scroll btn btn-border-w btn-round" href="#latest">Learn More</a>
                            </div>
                        </div>
                    </li>
                    <li class="bg-dark-30 bg-dark shop-page-header"
                        style="background-image: url('{{ asset('landing_page/images/shop/slider3.png') }}');">
                        <div class="titan-caption">
                            <div class="caption-content">
                                <div class="font-alt mb-30 titan-title-size-1"> This is Titan</div>
                                <div class="font-alt mb-40 titan-title-size-4">Exclusive products</div>
                                <a class="section-scroll btn btn-border-w btn-round" href="#latest">Learn More</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </section> --}}

        <div class="main">
            <section class="module">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <h2 class="module-title font-alt">Daftar Rapat</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="owl-carousel text-center" data-pagination="false"
                            data-navigation="false">
                            @foreach ($meeting as $r)
                                <div class="shop-item" style="margin-right: 20px">
                                    <div class="shop-item-image"><img
                                            src="{{ asset('storage/flayer') . '/' . $r->flayer }}"
                                            alt="Accessories Pack" />
                                        <div class="shop-item-detail">
                                            <div class="bg-success" style="padding-bottom: 10px; padding-top:10px; margin-bottom: 10px">
                                                <h4 style="color: black"><i class="fa fa-calendar" aria-hidden="true"></i> {{$r->tanggal_kegiatan}}</h4>
                                                <h4 style="color: black"><i class="fa fa-clock-o" aria-hidden="true"></i> {{$r->waktu_kegiatan}}</h4>
                                                <h4 style="color: black"><i class="fa fa-map-marker" aria-hidden="true"></i> {{$r->lokasi_kegiatan}}</h4>
                                            </div>
                                            <a class="btn btn-round btn-b peserta-event" style="font-size: 15px" data-id="{{$r->id}}"><i class="fa fa-user" aria-hidden="true"> Peserta</i></a>
                                        </div>
                                    </div>
                                    <h4 class="shop-item-title font-alt" style="font-size: 20px"><a href="#">{{$r->nama_kegiatan}}</a></h4>
                                    <span style="font-size: 14px">{{$r->deskripsi_kegiatan}} </span><br>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>

            <hr class="divider-d">
            <footer class="footer bg-dark">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="copyright font-alt">&copy; 2017&nbsp;<a href="index.html">TitaN</a>, All Rights
                                Reserved</p>
                        </div>
                        <div class="col-sm-6">
                            <div class="footer-social-links"><a href="#"><i class="fa fa-facebook"></i></a><a
                                    href="#"><i class="fa fa-twitter"></i></a><a href="#"><i
                                        class="fa fa-dribbble"></i></a><a href="#"><i
                                        class="fa fa-skype"></i></a></div>
                        </div>
                    </div>
                </div>
            </footer>

        </div>
        <div class="scroll-up"><a href="#totop"><i class="fa fa-angle-double-up"></i></a></div>
    </main>

    <div class="modal fade" id="daftar_peserta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title fs-5" id="exampleModalLabel">Daftar Peserta</h3>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="card">
                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">Nama Peserta</th>
                            <th class="text-center">Jenis Kelamin</th>
                            <th class="text-center">Golongan</th>
                            <th class="text-center">Jabatan</th>
                            <th class="text-center">Status Absensi</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" id="close-daftar-peserta" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="absensi_peserta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title fs-5" id="exampleModalLabel">Absensi Peserta</h3>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="card">

                <input type="hidden" id="id_kegiatan">
                <input type="hidden" id="id">

                <div class="form-group row">
                    <label for="nama" class="col-sm-4 col-form-label">Nama Peserta</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="nama" placeholder="Nama Peserta" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nip" class="col-sm-4 col-form-label">NIP Peserta</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="nip" placeholder="NIP Peserta" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="golongan" class="col-sm-4 col-form-label">Golongan</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="golongan" placeholder="Golongan" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="jabatan" class="col-sm-4 col-form-label">Jabatan</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="jabatan" placeholder="Jabatan" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="jenis_kelamin" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="jenis_kelamin" placeholder="Jenis Kelamin" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="status_absensi" class="col-sm-4 col-form-label">Status Absensi</label>
                    <div class="col-sm-8">
                        <select name="" class="form-control" id="status_absensi">
                            <option value="Hadir">Hadir</option>
                            <option value="Absen">Absen</option>
                            <option value="Izin">Izin</option>
                        </select>
                    </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" id="close-detail" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="simpan_absensi">Simpan</button>
            </div>
          </div>
        </div>
    </div>
    <!--
    JavaScripts
    =============================================
    -->
    <script src="{{ asset('landing_page/lib/jquery/dist/jquery.js') }}"></script>
    <script src="{{ asset('landing_page/lib/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('landing_page/lib/wow/dist/wow.js') }}"></script>
    <script src="{{ asset('landing_page/lib/jquery.mb.ytplayer/dist/jquery.mb.YTPlayer.js') }}"></script>
    <script src="{{ asset('landing_page/lib/isotope/dist/isotope.pkgd.js') }}"></script>
    <script src="{{ asset('landing_page/lib/imagesloaded/imagesloaded.pkgd.js') }}"></script>
    <script src="{{ asset('landing_page/lib/flexslider/jquery.flexslider.js') }}"></script>
    <script src="{{ asset('landing_page/lib/owl.carousel/dist/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('landing_page/lib/smoothscroll.js') }}"></script>
    <script src="{{ asset('landing_page/lib/magnific-popup/dist/jquery.magnific-popup.js') }}"></script>
    <script src="{{ asset('landing_page/lib/simple-text-rotator/jquery.simple-text-rotator.min.js') }}"></script>
    <script src="{{ asset('landing_page/js/plugins.js') }}"></script>
    <script src="{{ asset('landing_page/js/main.js') }}"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-2.0.8/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

        $(".peserta-event").on("click", function(){
            let table = new DataTable('#example', {
                "columnDefs": [
                    { "className": "text-center", "targets": [2, 4, 5] }
                ]
            });

            $.ajax({
                url: '/absensi-peserta/front/daftar-peserta',
                method: 'GET',
                data: {
                    id: $(this).data('id')
                },
                success: function(response) {
                        if (response.status) {
                            table.clear();

                            let rows = [];
                            response.data.forEach(element => {
                                let row = [
                                    `${element.nama} <br> <small>(${element.nip})</small>`,
                                    element.jenis_kelamin,
                                    element.golongan,
                                    element.jabatan,
                                    element.status_absensi,
                                    `<button class="absensi" data-id="${element.id}" data-event="${element.event_id}"><i class="fa fa-sign-in" style="font-size: 25px"></i></button>`
                                ];
                                rows.push(row);
                            });
                            table.rows.add(rows).draw();
                            $("#dt-length-0").css('margin-right', '10px');
                            $("#daftar_peserta").modal("show");
                        } else {
                            Swal.fire({
                                title: "Warning",
                                text: response.message,
                                icon: "warning"
                            });
                        }
                    },
                    error: function(response) {
                        Swal.fire({
                            title: "Error",
                            text: response.message,
                            icon: "error"
                        });
                    }
            });
        })

        $(document).on("click", '.absensi', function(){
            $.ajax({
                url: '/registrasi-peserta/daftar-peserta/detail',
                method: 'GET',
                data: {
                    id: $(this).data('id'),
                    event: $(this).data('event')
                },
                success: function(response){
                    if(response.status){
                        $("#id").val(response.data.id);
                        $("#id_kegiatan").val(response.data.event_id);
                        $("#nama").val(response.data.nama);
                        $("#nip").val(response.data.nip);
                        $("#golongan").val(response.data.golongan);
                        $("#jabatan").val(response.data.jabatan);
                        $("#jenis_kelamin").val(response.data.jenis_kelamin);
                        $("#status_absensi").val(response.data.status_absensi);

                        $("#daftar_peserta").modal("hide");
                        $("#absensi_peserta").modal("show");
                    } else {
                        Swal.fire({
                            title: "Warning",
                            text: response.message,
                            icon: "warning"
                        });
                    }
                },
                error: function(response){
                    Swal.fire({
                        title: "Error",
                        text: response.message,
                        icon: "error"
                    });
                }
            });
        });

        $("#simpan_absensi").on("click", function(){
            $.ajax({
                url: '/absensi-peserta/daftar-peserta/absensi',
                method: 'POST',
                data: {
                    "id": $("#id").val(),
                    "_token": $("meta[name='csrf-token']").attr("content"),
                    "status_absensi": $("#status_absensi").val()
                },
                success: function(response){
                    if(response.status){
                        Swal.fire({
                            title: "Success",
                            text: "Berhasil mengubah data",
                            icon: "success"
                        });

                        $("#absensi_peserta").modal("show");
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    }else{
                        Swal.fire({
                            title: "Warning",
                            text: response.message,
                            icon: "warning"
                        });
                    }
                },
                error: function(response){
                    Swal.fire({
                        title: "Error",
                        text: response.message,
                        icon: "error"
                    });
                }
            });
        })

        $("#close-daftar-peserta").on("click", function(){
            $("#daftar_peserta").modal('hide');
        })

        $("#close-detail").on("click", function(){
            $("#absensi_peserta").modal('hide');
        })
    </script>
</body>

</html>
