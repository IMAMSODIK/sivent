let table = $("#basic-1").DataTable();

function alertModal(status, message = null){
    if(status){
        $("#alert-image").attr("src", '../../assets/images/gif/dashboard-8/successful.gif');
        $("#alert-message").text("Success");
        $("#alert-message").text(message);
    }else{
        $("#alert-image").attr("src", '../../assets/images/gif/danger.gif');
        $("#alert-message").text("Gagal");
        $("#alert-message").text(message);
    }
    
    $("#alert").modal('show');
}

$(".registrasi").on("click", function(){
    let id = $(this).data('id');
    let event = $(this).data('event');

    $.ajax({
        url: '/data-kamar/daftar-peserta/edit',
        method: 'GET',
        data: {
            'id': id,
            'event': event,
        },
        success: function(response){
            if(response.status){
                response.kamar.forEach(element => {
                    var newOption = $('<option>', {
                        value: element.no_kamar,
                        text: element.no_kamar
                    });

                    $("#nomor_kamar").append(newOption);
                });
                $("#id").val(response.data.id);
                $("#nama").val(response.data.nama);
                $("#nip").val(response.data.nip);
                $("#asal_instansi").val(response.data.asal_instansi);
                $("#golongan").val(response.data.golongan);
                $("#jabatan").val(response.data.jabatan);
                $("#jenis_kelamin").val(response.data.jenis_kelamin);
                $("#nomor_kamar").val(response.data.no_kamar);

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
                                        <h6>${element.lokasi_kegiatan} </h6>

                                        <div class="row">
                                            <div class="blog-bottom-content col-md-10 d-flex align-items-center">
                                                <ul class="blog-social">
                                                    <li>${element.tanggal_kegiatan}, ${element.waktu_kegiatan}</li>
                                                    <li>${element.no_surat} </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-2 d-flex justify-content-end">
                                                <a href="/data-kamar/daftar-peserta?kegiatan_id=${element.event_id}"><button class="btn btn-secondary d-flex m-auto mb-2" type="button">Data Kamar</button></a>
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
                                        <li>${element.tanggal_kegiatan}</li>
                                        <li>${element.waktu_kegiatan}</li>
                                        <li>${element.lokasi_kegiatan}</li>
                                        </ul>
                                        <hr>
                                        <h6 class="blog-bottom-details">${element.nama_kegiatan}</h6>
                                        <p class="px-3">${element.deskripsi_kegiatan}</p>
                                        <a href="/data-kamar/daftar-peserta?kegiatan_id=${element.event_id}"><button class="btn btn-secondary d-flex m-auto mb-2" type="button">Data Kamar</button></a>
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

$("#update").on("click", function(){
    $("#edit-data-modal").modal("hide");
    $.ajax({
        url: '/data-kamar/daftar-peserta/update',
        method: 'POST',
        data: {
            "_token": $("meta[name='csrf-token']").attr("content"),
            "id": $("#id").val(),
            "nomor_kamar": $("#nomor_kamar").val(),
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

$("#absensi").on("click", function(){
    $("#edit-data-modal").modal("hide");
    $.ajax({
        url: '/absensi-peserta/daftar-peserta/absensi',
        method: 'POST',
        data: {
            "_token": $("meta[name='csrf-token']").attr("content"),
            "id": $("#id").val(),
            "status_absensi": $("#status_absensi").val()
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

$("#tambah-data").on("click", function(){
    $.ajax({
        url: '/kunci-kamar/daftar-kamar/peserta',
        method: 'GET',
        data: {
            "_token": $("meta[name='csrf-token']").attr("content"),
            "id_event": $(this).data("id"),
        },
        success: function(response){
            if(response.status){
                response.data.forEach(element => {
                    var newOption = $('<option>', {
                        value: element.nama,
                        text: element.nama,
                        'data-id': element.id
                    });

                    $("#pemegang").append(newOption);
                });
                $("#tambah-data-modal").modal("show");
            }else{
                alertModal(false, response.message);
            }
        },
        error: function(response){
            alertModal(false, response.message);
        }
    })
})

$("#store").on("click", function(){
    var selectedOption = $("#pemegang").find('option:selected');
    var dataId = selectedOption.data('id');
    $("#tambah-data-modal").modal("hide");
    $.ajax({
        url: '/kunci-kamar/daftar-kamar/store',
        method: 'POST',
        data: {
            "_token": $("meta[name='csrf-token']").attr("content"),
            "id_event": $("#id_kegiatan").val(),
            "no_kamar": $("#no_kamar").val(),
            "pemegang": $("#pemegang").val(),
            "pemegang_id": dataId
        },
        success: function(response){
            if(response.status){
                alertModal(true, "Berhasil mengubah data");
                setTimeout(() => {
                    location.reload();
                }, 2000);
            }else{
                $('.modal-alert').on('hidden.bs.modal', function () {
                    $("#tambah-data-modal").modal("show");
                });
                alertModal(false, response.message);
            }
        },
        error: function(response){
            alertModal(false, response.message);
        }
    })
})

