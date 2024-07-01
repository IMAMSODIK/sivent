let table = $("#basic-1").DataTable();
let table2 = $("#select-peserta").DataTable();
$(".sorting_1").addClass("text-center");

function alertModal(status, message = null) {
    if (status) {
        $("#alert-image").attr("src", '../../assets/images/gif/dashboard-8/successful.gif');
        $("#alert-message").text("Success");
        $("#alert-message").text(message);
    } else {
        $("#alert-image").attr("src", '../../assets/images/gif/danger.gif');
        $("#alert-message").text("Gagal");
        $("#alert-message").text(message);
    }

    $("#alert").modal('show');
}

$("#tambah-data").on("click", function () {
    let kategori = $(this).data('kategori');
    
    if(kategori == 'rapat' || kategori == 'lembur'){
        $.ajax({
            url: '/data-peserta/select-peserta',
            method: 'GET',
            data: {
                "id_kegiatan": $("#id_kegiatan").val()
            },
            success: function(response){
                if(response.status){
                    table2.clear();

                    let rows = [];
                    response.data.forEach(element => {
                        let row = [
                            `<input type="checkbox" name="select_pegawai" value="${element.id}">`,
                            `${element.nama} <br> <small>(${element.nip})</small>`,
                            element.jenis_kelamin,
                            element.golongan,
                            element.jabatan.nama_jabatan
                        ];
                        rows.push(row);
                    });
                    table2.rows.add(rows).draw();
                    $(".sorting_1").addClass("text-center");
                    $("#select-data-modal").modal("show");
                }else{
                    alertModal(false, response.message);
                }
            },
            error: function(){
                alertModal(false, response.message);
            }
        });
    }else{
        $("#tambah-data-modal").modal("show");
    }
    
});

$("#store").on("click", function () {
    $("#tambah-data-modal").modal("hide");
    let formData = new FormData();

    formData.append("_token", $("meta[name='csrf-token']").attr('content'));
    formData.append("id_kegiatan", $("#id_kegiatan").val());
    formData.append("nama", $("#nama").val());
    formData.append("nip", $("#nip").val());
    formData.append("golongan", $("#golongan").val());
    formData.append("jabatan", $("#jabatan").val());
    formData.append("bank", $("#bank").val());
    formData.append("no_rek", $("#no_rek").val());
    formData.append("jenis_kelamin", $("#jenis_kelamin").val());

    $.ajax({
        url: '/data-peserta/daftar-peserta/store',
        method: 'POST',
        processData: false,
        contentType: false,
        data: formData,
        success: function (response) {
            if (response.status) {
                alertModal(true, "Berhasil menambahkan data");
                setTimeout(() => {
                    location.reload();
                }, 2000);
            } else {
                alertModal(false, response.message);
            }
        },
        error: function (response) {
            alertModal(false, response.message);
        }
    })
})

$(".edit").on("click", function(){
    let id = $(this).data('id');

    $.ajax({
        url: '/data-peserta/daftar-peserta/detail',
        method: 'GET',
        data: {
            'id': id
        },
        success: function(response){
            if(response.status){
                $("#id").val(response.data.id);
                $("#edit_nama").val(response.data.nama);
                $("#edit_nip").val(response.data.nip);
                $("#edit_golongan").val(response.data.golongan);
                $("#edit_jabatan").val(response.data.jabatan);
                $("#edit_bank").val(response.data.bank);
                $("#edit_no_rek").val(response.data.no_rek);
                $("#edit_jenis_kelamin").val(response.data.jenis_kelamin);

                $("#edit-data-modal").modal("show");
            }else{
                alertModal(false, response.message);
            }
        },
        error: function(response){
            alertModal(false, response.message);
        }
    })
})

$("#update").on("click", function(){
    $("#edit-data-modal").modal("hide");
    $.ajax({
        url: '/data-peserta/daftar-peserta/update',
        method: 'POST',
        data: {
            '_token': $("meta[name='csrf-token']").attr("content"),
            'id': $("#id").val(),
            'nama': $("#edit_nama").val(),
            'nip': $("#edit_nip").val(),
            'golongan': $("#edit_golongan").val(),
            'jabatan': $("#edit_jabatan").val(),
            'bank': $("#edit_bank").val(),
            'no_rek': $("#edit_no_rek").val(),
            'jenis_kelamin': $("#edit_jenis_kelamin").val(),
        },
        success: function(response){
            if(response.status){
                alertModal(true, "Berhasil mengubah data");
                setTimeout(() => {
                    location.reload();
                }, 2000);
            }else{
                $('.modal-alert').on('hidden.bs.modal', function () {
                    $("#edit-data-modal").modal("show");
                });
                alertModal(false, response.message);
            }
        },
        error: function(response){
            alertModal(false, response.message);
        }
    })
})

function eventCards(kategori) {
    $(".incoming").empty();
    $(".done").empty();
    const currentDate = new Date();

    $.ajax({
        url: '/data-peserta/daftar-event',
        method: 'GET',
        data: {
            'kategori': kategori
        },
        success: function (response) {
            if (response.status) {
                response.data.forEach(element => {
                    let eventDate = new Date(element.tanggal_kegiatan);
                    if (eventDate >= currentDate) {
                        let event = `
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="blog-box blog-list row">
                                    <div class="col-sm-5"><img class="img-fluid sm-100-w" src="../../storage/flayer/${element.flayer}" alt="" style="width: 600px; height: 350px"></div>
                                    <div class="col-sm-7">
                                        <div class="blog-details">
                                        <div class="blog-date"><span>${element.nama_kegiatan}</span></div>
                                        <h6><i class="fa fa-map-marker" aria-hidden="true"></i> ${element.lokasi_kegiatan} </h6>

                                        <div class="row">
                                            <div class="blog-bottom-content col-md-9 d-flex align-items-center">
                                                <ul class="blog-social">
                                                    <li><i class="fa fa-calendar" aria-hidden="true"></i> ${element.tanggal_kegiatan}, ${element.waktu_kegiatan}</li>
                                                    <li>${element.no_surat} </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-3 d-flex justify-content-end">
                                                <a href="/data-peserta/daftar-peserta?kegiatan_id=${element.event_id}"><button class="btn btn-secondary d-flex m-auto mb-2" type="button">${element.peserta_count} Peserta</button></a>
                                            </div>
                                        </div>
                                        <hr>
                                        <p class="mt-0">${element.deskripsi_kegiatan}</p>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        $(".incoming").prepend(event);
                    } else {
                        let event = `
                            <div class="col-xl-4 xl-50 col-sm-6 box-col-6">
                                <div class="card">
                                    <div class="blog-box blog-grid text-center product-box">
                                    <div class="product-img"><img class="img-fluid top-radius-blog" src="../../storage/flayer/${element.flayer}" alt="" style="height: 300px">
                                        <div class="product-hover">
                                        <ul>
                                            <li><i class="icon-link"></i></li>
                                            <li><i class="icon-import"></i></li>
                                        </ul>
                                        </div>
                                    </div>
                                    <div class="blog-details-main">
                                        <ul class="blog-social">
                                        <li><i class="fa fa-calendar" aria-hidden="true"></i> ${element.tanggal_kegiatan}</li>
                                        <li><i class="fa fa-clock-o" aria-hidden="true"></i> ${element.waktu_kegiatan}</li>
                                        <li><i class="fa fa-map-marker" aria-hidden="true"></i> ${element.lokasi_kegiatan}</li>
                                        <li><i class="fa fa-users" aria-hidden="true"></i> ${element.peserta_count}</li>
                                        </ul>
                                        <hr>
                                        <h6 class="blog-bottom-details">${element.nama_kegiatan}</h6>
                                        <p class="px-3">${element.deskripsi_kegiatan}</p>
                                        <a href="/data-peserta/daftar-peserta?kegiatan_id=${element.event_id}"><button class="btn btn-secondary d-flex m-auto mb-2" type="button">Peserta</button></a>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        $(".done").prepend(event);
                    }
                });
            } else {
                alertModal(false, response.message);
            }
        },
        error: function (response) {
            alertModal(false, response.message);
        }
    })
}

$(".rapat").on("click", function () {
    eventCards('rapat');
    $("#kategori_filter").val('rapat');
});

$(".meeting").on("click", function () {
    eventCards('meeting');
    $("#kategori_filter").val('meeting');
});

$(".lembur").on("click", function () {
    eventCards('lembur');
    $("#kategori_filter").val('lembur');
});

$("#import-data").on("click", function () {
    $("#export").modal("show");
})

$("#download-template").on("click", function () {
    $('#peserta').removeAttr('disabled');
})

$("#submit-filter").on("click", function(){
    var unitKerjaSelected = [];
    var statusEventSelected = $('.status_event_filter:checked').val();

    $('.unit_kerja_filter:checked').each(function() {
        unitKerjaSelected.push($(this).val());
    });

    $.ajax({
        url: '/event/filter',
        method: 'GET',
        data: {
            'unit_kerja': unitKerjaSelected,
            'status_event': statusEventSelected,
            'kategori': $("#kategori_filter").val()
        },
        success: function(response){
            if(response.status){
                $(".incoming").empty();
                $(".done").empty();
                const currentDate = new Date();

                response.data.forEach(element => {
                    let eventDate = new Date(element.tanggal_kegiatan);
                    if(eventDate >= currentDate){
                        let event = `
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="blog-box blog-list row">
                                    <div class="col-sm-5"><img class="img-fluid sm-100-w" src="../../storage/flayer/${element.flayer}" alt="" style="width: 600px; height: 350px"></div>
                                    <div class="col-sm-7">
                                        <div class="blog-details">
                                        <div class="blog-date"><span>${element.nama_kegiatan}</span></div>
                                        <h6><i class="fa fa-map-marker" aria-hidden="true"></i> ${element.lokasi_kegiatan} </h6>

                                        <div class="row">
                                            <div class="blog-bottom-content col-md-9 d-flex align-items-center">
                                                <ul class="blog-social">
                                                    <li><i class="fa fa-calendar" aria-hidden="true"></i> ${element.tanggal_kegiatan}, ${element.waktu_kegiatan}</li>
                                                    <li>${element.no_surat} </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-3 d-flex justify-content-end">
                                                <a href="/data-peserta/daftar-peserta?kegiatan_id=${element.event_id}"><button class="btn btn-secondary d-flex m-auto mb-2" type="button">${element.peserta_count} Peserta</button></a>
                                            </div>
                                        </div>
                                        <hr>
                                        <p class="mt-0">${element.deskripsi_kegiatan}</p>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        $(".incoming").prepend(event);
                    }else{
                        let event = `
                            <div class="col-xl-4 xl-50 col-sm-6 box-col-6">
                                <div class="card">
                                    <div class="blog-box blog-grid text-center product-box">
                                    <div class="product-img"><img class="img-fluid top-radius-blog" src="../../storage/flayer/${element.flayer}" alt="" style="height: 300px">
                                        <div class="product-hover">
                                        <ul>
                                            <li><i class="icon-link"></i></li>
                                            <li><i class="icon-import"></i></li>
                                        </ul>
                                        </div>
                                    </div>
                                    <div class="blog-details-main">
                                        <ul class="blog-social">
                                        <li><i class="fa fa-calendar" aria-hidden="true"></i> ${element.tanggal_kegiatan}</li>
                                        <li><i class="fa fa-clock-o" aria-hidden="true"></i> ${element.waktu_kegiatan}</li>
                                        <li><i class="fa fa-map-marker" aria-hidden="true"></i> ${element.lokasi_kegiatan}</li>
                                        <li><i class="fa fa-users" aria-hidden="true"></i> ${element.peserta_count}</li>
                                        </ul>
                                        <hr>
                                        <h6 class="blog-bottom-details">${element.nama_kegiatan}</h6>
                                        <p class="px-3">${element.deskripsi_kegiatan}</p>
                                        <a href="/data-peserta/daftar-peserta?kegiatan_id=${element.event_id}"><button class="btn btn-secondary d-flex m-auto mb-2" type="button">Peserta</button></a>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    $(".done").prepend(event);
                    }
                });
            }else{
                alertModal(false, response.message);
            }
        },
        error: function(response){
            alertModal(false, response.message);
        }
    })
})

$(".detail-flayer").on("click", function(){
    $("#detail-flayer-image").attr("src", `../../storage/flayer/${$(this).data('path')}`);
    $("#detail-flayer-modal").modal("show");
})

$("#selected_peserta").on("click", function(){
    $("#select-data-modal").modal("hide");
    var selectedPeserta = [];
    $('input[name="select_pegawai"]:checked').each(function() {
        selectedPeserta.push($(this).val());
    });
    let formData = new FormData();

    formData.append("_token", $("meta[name='csrf-token']").attr('content'));
    formData.append("id_kegiatan", $("#id_kegiatan").val());
    formData.append("selected_id", selectedPeserta);

    $.ajax({
        url: '/data-peserta/daftar-peserta/store',
        method: 'POST',
        processData: false,
        contentType: false,
        data: formData,
        success: function (response) {
            if (response.status) {
                alertModal(true, "Berhasil menambahkan data");
                setTimeout(() => {
                    location.reload();
                }, 2000);
            } else {
                alertModal(false, response.message);
            }
        },
        error: function (response) {
            alertModal(false, response.message);
        }
    })
})

$(".delete").on("click", function(){
    $("#delete-confirmed").attr("data-id", $(this).data('id'));
    $("#confirm").modal("show");
})

$("#delete-confirmed").on("click", function(){
    $.ajax({
        url: '/data-peserta/daftar-peserta/delete',
        method: 'POST',
        data: {
            '_token': $("meta[name='csrf-token']").attr("content"),
            'id': $(this).data("id"),
        },
        success: function(response){
            if(response.status){
                alertModal(true, "Berhasil menghapus data");
                setTimeout(() => {
                    location.reload();
                }, 2000);
            }else{
                alertModal(false, response.message);
            }
        },
        error: function(response){
            alertModal(false, response.message);
        }
    })
})