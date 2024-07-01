@extends('template')

@section('content')
<div class="page-body">
    <div class="container-fluid" style="margin-top: 50px">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Project Management</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ asset('index.html') }}">
                                <svg class="stroke-icon">
                                    <use
                                        xlink:href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}">
                                    </use>
                                </svg>
                            </a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row size-column">
            <div class="col-xxl-9 box-col-12">
                <div class="row">

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-3 col-sm-6">
                                <div class="card o-hidden small-widget">
                                    <div class="card-body total-project border-b-primary border-2">
                                        <span class="f-light f-w-500 f-14">Total Event</span>
                                        <div class="project-details">
                                            <div class="project-counter">
                                                <h2 class="f-w-600">{{$count_event}}</h2>
                                                <span class="f-12 f-w-400">(Event)</span>
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
                            <div class="col-xl-3 col-sm-6">
                                <div class="card o-hidden small-widget">
                                    <div class="card-body total-Progress border-b-warning border-2">
                                        <span class="f-light f-w-500 f-14">Event Hari Ini</span>
                                        <div class="project-details">
                                            <div class="project-counter">
                                                <h2 class="f-w-600">{{$count_event_today}}</h2>
                                                <span class="f-12 f-w-400">(Event)</span>
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
                            <div class="col-xl-3 col-sm-6">
                                <div class="card o-hidden small-widget">
                                    <div class="card-body total-Complete border-b-secondary border-2">
                                        <span class="f-light f-w-500 f-14">Event Mendatang</span>
                                        <div class="project-details">
                                            <div class="project-counter">
                                                <h2 class="f-w-600">{{$count_event_incoming}}</h2>
                                                <span class="f-12 f-w-400">(Event)</span>
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
                            <div class="col-xl-3 col-sm-6">
                                <div class="card o-hidden small-widget">
                                    <div class="card-body total-upcoming">
                                        <span class="f-light f-w-500 f-14">Event Selesai</span>
                                        <div class="project-details">
                                            <div class="project-counter">
                                                <h2 class="f-w-600">{{$count_event_done}}</h2>
                                                <span class="f-12 f-w-400">(Event)</span>
                                            </div>
                                            <div class="product-sub bg-light-light">
                                                <svg class="invoice-icon">
                                                    <use
                                                        xlink:href="{{ asset('assets/svg/icon-sprite.svg#edit-2') }}">
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
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header card-no-border total-revenue">
                                <h4>Event Statistics</h4>
                                <div class="sales-chart-dropdown-select">
                                    <div class="card-header-right-icon">
                                        <div class="dropdown">
                                            <button class="btn dropdown-toggle dropdown-toggle-store"
                                                id="dropdownMenuButtonStore" data-bs-toggle="dropdown"
                                                aria-expanded="false">This Week</button>
                                            <div class="dropdown-menu dropdown-menu-end"
                                                aria-labelledby="dropdownMenuButtonStore"><a
                                                    class="dropdown-item" href="#">This Day</a><a
                                                    class="dropdown-item" href="#">This
                                                    Month</a><a class="dropdown-item"
                                                    href="#">This year</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="statistics">
                                    <div id="statisticschart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header card-no-border total-revenue">
                                <h4>Today Event</h4><a href="product.html">View All </a>
                            </div>
                            <div class="card-body pt-0">
                                <div class="today-work-table table-responsive custom-scrollbar">
                                    <table class="today-working-table w-100">
                                        <tbody>
                                            @foreach ($event_today as $e)
                                                <tr>
                                                    <td><span class="f-w-500 f-light d-block f-12 mb-1">Kegiatan</span><a class="f-w-500 f-14"
                                                            href="product.html">{{$e->nama_kegiatan}}</a></td>
                                                    <td> <span
                                                            class="f-w-500 f-light d-block f-12 mb-1">Unit Kerja</span><a class="f-w-500 f-14"
                                                            href="product.html">{{$e->unit_kerja}}</a></td>
                                                    <td><span class="f-w-500 f-light d-block f-12 mb-1">Jumlah Peserta</span><a class="f-w-500 f-14"
                                                            href="product.html">02</a></td>
                                                    <td class="text-end">
                                                        @if ($e->kategori === 'rapat')
                                                            <div class="badge-light-primary product-sub badge rounded-pill ">
                                                                <span>{{$e->kategori}}</span></div>
                                                        @elseif($e->kategori === 'meeting')
                                                            <div class="badge-light-info product-sub badge rounded-pill ">
                                                                <span>{{$e->kategori}}</span></div>
                                                        @elseif($e->kategori === 'lembur')
                                                            <div class="badge-light-danger product-sub badge rounded-pill ">
                                                                <span>{{$e->kategori}}</span></div>
                                                        @endif
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
            <div class="col-xxl-3 d-xxl-block d-none activity-group box-col-none">
                <div class="card add-project-link">
                    <div class="categories"></div>
                    <div class="categories-content"> <span
                            class="text-truncate col-8 f-12 d-block mb-2">Tambah Event baru disini
                            <ul class="mt-2">
                                <li><a href="/rapat">+ Tambah Rapat </a></li>
                                <li><a href="/meeting">+ Tambah Meeting </a></li>
                                <li><a href="/lembur">+ Tambah Lembur </a></li>
                            </ul>
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-sm-12">
                        <div class="card o-hidden small-widget">
                            <div class="card-body total-project border-b-primary border-2">
                                <span class="f-light f-w-500 f-14">Laporan Rapat</span>
                                <div class="project-details">
                                    <div class="project-counter">
                                        <h2 class="f-w-600">30%</h2>
                                        <span class="f-12 f-w-400">(Laporan Event Terkirim)</span>
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
                    <div class="col-xl-12 col-sm-12">
                        <div class="card o-hidden small-widget">
                            <div class="card-body total-Progress border-b-warning border-2">
                                <span class="f-light f-w-500 f-14">Laporan Meeting</span>
                                <div class="project-details">
                                    <div class="project-counter">
                                        <h2 class="f-w-600">75%</h2>
                                        <span class="f-12 f-w-400">(Laporan Meeting Terkirim)</span>
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
                    <div class="col-xl-12 col-sm-12">
                        <div class="card o-hidden small-widget">
                            <div class="card-body total-Progress border-b-warning border-2">
                                <span class="f-light f-w-500 f-14">Laporan Lembur</span>
                                <div class="project-details">
                                    <div class="project-counter">
                                        <h2 class="f-w-600">50%</h2>
                                        <span class="f-12 f-w-400">(Laporan Lembur Terkirim)</span>
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
                </div>
                {{-- <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header card-no-border total-revenue">
                                <h4>Activity Log </h4>
                                <div class="sales-chart-dropdown-select">
                                    <div class="card-header-right-icon online-store">
                                        <div class="dropdown">
                                            <button class="btn dropdown-toggle dropdown-toggle-store"
                                                id="dropdownMenuButtondown" data-bs-toggle="dropdown"
                                                aria-expanded="false">Employee </button>
                                            <div class="dropdown-menu dropdown-menu-end"
                                                aria-labelledby="dropdownMenuButtondown"><a
                                                    class="dropdown-item" href="#">All </a><a
                                                    class="dropdown-item" href="#">Employee</a><a
                                                    class="dropdown-item" href="#">Client </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body pt-0">
                                <div class="activity-log-card">
                                    <ul>
                                        <li class="activity-log">
                                            <div class="d-flex align-items-start gap-2"><img
                                                    class="activity-log-img rounded-circle img-fluid me-2"
                                                    src="{{ asset('assets/images/user/26.png') }}"
                                                    alt="user" />
                                                <div>
                                                    <div class="common-space user-id">
                                                        <h6> <a class="f-w-500 f-12"
                                                                href="user-profile.html">Jenny Wilson</a>
                                                        </h6><span class="f-light f-w-500 f-12">Today
                                                            10:45 AM</span>
                                                    </div>
                                                    <div class="d-flex mb-2"><span
                                                            class="f-light f-w-500 f-12">Commented on :
                                                        </span><a class="f-w-500 f-12" href="blog.html">
                                                            NFT App</a></div><span
                                                        class="f-light f-w-500 f-12 d-block">This smithe
                                                        design looks great!! but this page as i mention
                                                        belove.</span><a class="f-12 f-w-500 username"
                                                        href="user-profile.html"></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="activity-log">
                                            <div class="d-flex align-items-start gap-2"><img
                                                    class="activity-log-img rounded-circle img-fluid me-2"
                                                    src="{{ asset('assets/images/user/34.png') }}"
                                                    alt="user" />
                                                <div>
                                                    <div class="common-space user-id">
                                                        <h6> <a class="f-w-500 f-12"
                                                                href="user-profile.html">Darlene
                                                                Robertson</a></h6><span
                                                            class="f-light f-w-500 f-12">Today 10:43
                                                            AM</span>
                                                    </div>
                                                    <div class="d-flex mb-2"><span
                                                            class="f-light f-w-500 f-12">Shared File to :
                                                        </span><a class="f-w-500 f-12"
                                                            href="blog.html">Barkha</a></div><span
                                                        class="f-light f-w-500 f-12 d-block">Food Delivery
                                                        App figma &amp; Ai file shared to a .zip file to
                                                        make it easier to send.</span><a
                                                        class="f-12 f-w-500 username"
                                                        href="user-profile.html"></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="activity-log">
                                            <div class="d-flex align-items-start gap-2"><img
                                                    class="activity-log-img rounded-circle img-fluid me-2"
                                                    src="{{ asset('assets/images/user/35.png') }}"
                                                    alt="user" />
                                                <div>
                                                    <div class="common-space user-id">
                                                        <h6> <a class="f-w-500 f-12"
                                                                href="user-profile.html">Seema Joshi</a>
                                                        </h6><span class="f-light f-w-500 f-12">Today
                                                            10:42 AM</span>
                                                    </div>
                                                    <div class="d-flex mb-2"><span
                                                            class="f-light f-w-500 f-12">Meeting :
                                                        </span><a class="f-w-500 f-12"
                                                            href="blog.html">Eva Website</a></div><span
                                                        class="f-light f-w-500 f-12 d-block">You can send
                                                        the AI file as attachment service and share a
                                                        download link.</span><a
                                                        class="f-12 f-w-500 username"
                                                        href="user-profile.html">@barkha_singh</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="activity-log">
                                            <div class="d-flex align-items-start gap-2"><img
                                                    class="activity-log-img rounded-circle img-fluid me-2"
                                                    src="{{ asset('assets/images/user/44.png') }}"
                                                    alt="user" />
                                                <div>
                                                    <div class="common-space user-id">
                                                        <h6> <a class="f-w-500 f-12"
                                                                href="user-profile.html">Elara Winter</a>
                                                        </h6><span class="f-light f-w-500 f-12">Today
                                                            06:45 AM</span>
                                                    </div>
                                                    <div class="d-flex mb-2"><span
                                                            class="f-light f-w-500 f-12">Meeting :
                                                        </span><a class="f-w-500 f-12"
                                                            href="blog.html">Eva Website</a></div><span
                                                        class="f-light f-w-500 f-12 d-block">Metting about
                                                        next page design of eva website.</span><a
                                                        class="f-12 f-w-500 username"
                                                        href="user-profile.html"></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="activity-log">
                                            <div class="d-flex align-items-start gap-2"><img
                                                    class="activity-log-img rounded-circle img-fluid me-2"
                                                    src="{{ asset('assets/images/user/38.png') }}"
                                                    alt="user" />
                                                <div>
                                                    <div class="common-space user-id">
                                                        <h6> <a class="f-w-500 f-12"
                                                                href="user-profile.html">Arya Shwanno</a>
                                                        </h6><span class="f-light f-w-500 f-12">Today
                                                            05:51 AM</span>
                                                    </div>
                                                    <div class="d-flex mb-2"><span
                                                            class="f-light f-w-500 f-12">Add new screen
                                                            :</span><a class="f-w-500 f-12"
                                                            href="blog.html">Pet App</a></div><span
                                                        class="f-light f-w-500 f-12 d-block">Make sure
                                                        your AI file is cloud storage like Google Drive or
                                                        Dropbox.</span><a class="f-12 f-w-500 username"
                                                        href="user-profile.html"></a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-12 col-md-6">
                        <div class="card overflow-hidden">
                            <div class="card-body pt-0 project-ideas-card">
                                <div class="project-card">
                                    <div><span class="f-22 f-w-500 text-center">Get more ideas for your
                                            important project</span>
                                        <div class="btn-showcase text-center"> <a href="pricing.html">
                                                <button
                                                    class="btn btn-pill btn-outline-primary-2x b-r-8 active">Upgrade
                                                    Now</button></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
@endsection