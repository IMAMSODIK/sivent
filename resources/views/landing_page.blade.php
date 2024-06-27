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
</head>

<body data-spy="scroll" data-target=".onpage-navigation" data-offset="60">
    <main>
        <div class="page-loader">
            <div class="loader">Loading...</div>
        </div>
        <nav class="navbar navbar-custom navbar-fixed-top navbar-transparent" style="padding-top: 40px; padding-bottom: 40px; font-size: 18px" role="navigation">
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
                        <li class="dropdown"><a class="dropdown-toggle" href="#"
                                data-toggle="dropdown">Rapat</a>
                            <ul class="dropdown-menu">
                                <li style="font-size: 15px"><a href="/absensi-peserta/rapat/front">Absensi</a></li>
                            </ul>
                        </li>
                        <li class="dropdown"><a class="dropdown-toggle" href="#"
                            data-toggle="dropdown">Meeting</a>
                            <ul class="dropdown-menu">
                                <li style="font-size: 15px"><a href="/registrasi-peserta/meeting/front">Registrasi</a></li>
                                <li style="font-size: 15px"><a href="/absensi-peserta/meeting/front">Absensi</a></li>
                                <li style="font-size: 15px"><a href="/kit-peserta/meeting/front">Seminar Kit</a></li>
                            </ul>
                        </li>
                        <li class="dropdown"><a class="dropdown-toggle" href="#"
                            data-toggle="dropdown">Lembur</a>
                            <ul class="dropdown-menu">
                                <li style="font-size: 15px"><a href="/absensi-peserta/lembur/front">Absensi</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <section class="home-section home-fade home-full-height" id="home">
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
        </section>

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
                            @foreach ($rapat as $r)
                                <div class="shop-item" style="margin-right: 10px">
                                    <div class="shop-item-image"><img
                                            src="{{ asset('storage/flayer') . '/' . $r->flayer }}"
                                            alt="Accessories Pack" />
                                        <div class="shop-item-detail"><a class="btn btn-round btn-b"><span
                                                    class="icon-basket">Detail</span></a></div>
                                    </div>
                                    <h4 class="shop-item-title font-alt"><a href="#">{{$r->nama_kegiatan}}</a></h4>{{$r->tanggal_kegiatan}}, {{$r->waktu_kegiatan}}
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <h2 class="module-title font-alt">Daftar Meeting</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="owl-carousel text-center" data-pagination="false"
                            data-navigation="false">
                            @foreach ($meeting as $r)
                                <div class="shop-item" style="margin-right: 10px">
                                    <div class="shop-item-image"><img
                                            src="{{ asset('storage/flayer') . '/' . $r->flayer }}"
                                            alt="flayer" />
                                        <div class="shop-item-detail"><a class="btn btn-round btn-b"><span
                                                    class="icon-info">Detail</span></a></div>
                                    </div>
                                    <h4 class="shop-item-title font-alt"><a href="#">{{$r->nama_kegiatan}}</a></h4>{{$r->tanggal_kegiatan}}, {{$r->waktu_kegiatan}}
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <h2 class="module-title font-alt">Daftar Lembur</h2>
                        </div>
                    </div>
                    <div class="row">
                        <div class="owl-carousel text-center" data-pagination="false"
                            data-navigation="false">
                            @foreach ($lembur as $r)
                                <div class="shop-item" style="margin-right: 10px">
                                    <div class="shop-item-image"><img
                                            src="{{ asset('storage/flayer') . '/' . $r->flayer }}"
                                            alt="flayer" />
                                        <div class="shop-item-detail"><a class="btn btn-round btn-b"><span
                                                    class="icon-info">Detail</span></a></div>
                                    </div>
                                    <h4 class="shop-item-title font-alt"><a href="#">{{$r->nama_kegiatan}}</a></h4>{{$r->tanggal_kegiatan}}, {{$r->waktu_kegiatan}}
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
</body>

</html>
