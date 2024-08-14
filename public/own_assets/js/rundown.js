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

$("#close-flayer").on("click", function(){
    closeModal($("#detail-flayer-modal"));
})

$("#cancel-add").on("click", function(){
    closeModal($("#tambah-data-modal"));
})

$("#cancel-edit").on("click", function(){
    closeModal($("#edit-data-modal"));
})

$("#tambah-data").on("click", function(){
    $.ajax({
        url: '/data-peserta/daftar-peserta/import-peserta/check',
        type: 'GET',
        data: {
            'id_kegiatan': $("#id_kegiatan").val()
        },
        success: function(response) {
            if(response.status){
                $("#tambah-data-modal").modal("show");
            }else{
                alertModal(false, response.message);    
            }
        },
        error: function(response) {
            alertModal(false, response.message);
        }
    });
});

$("#store").on("click", function(){
    $("#tambah-data-modal").modal("hide");
    let formData = new FormData();

    formData.append("_token", $("meta[name='csrf-token']").attr('content'));
    formData.append("id_kegiatan", $("#id_kegiatan").val());
    formData.append("tanggal_kegiatan", $("#tanggal_kegiatan").val());
    formData.append("waktu_kegiatan", $("#waktu_kegiatan").val());
    formData.append("keterangan", $("#keterangan").val());
    formData.append("aktor", $("#aktor").val());

    $.ajax({
        url: '/data-rundown/daftar-rundown/store',
        method: 'POST',
        processData: false,
        contentType: false, 
        data: formData,
        success: function(response){
            if(response.status){
                alertModal(true, "Berhasil menambahkan data");
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

$(document).on("click", ".edit", function(){
    let id = $(this).data('id');

    $.ajax({
        url: '/data-rundown/daftar-rundown/edit',
        method: 'GET',
        data: {
            'id': id
        },
        success: function(response){
            if(response.status){
                $("#id").val(response.data.id);
                $("#edit_tanggal_kegiatan").val(response.data.tanggal_kegiatan);
                $("#edit_waktu_kegiatan").val(response.data.waktu_kegiatan);
                $("#edit_keterangan").val(response.data.keterangan_kegiatan);
                $("#edit_aktor").val(response.data.aktor);

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
        url: '/data-rundown/daftar-rundown/update',
        method: 'POST',
        data: {
            '_token': $("meta[name='csrf-token']").attr("content"),
            'id': $("#id").val(),
            'tanggal_kegiatan': $("#edit_tanggal_kegiatan").val(),
            'waktu_kegiatan': $("#edit_waktu_kegiatan").val(),
            'keterangan': $("#edit_keterangan").val(),
            'aktor': $("#edit_aktor").val(),
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

$(document).on("click", ".delete", function(){
    $("#delete-confirmed").attr("data-id", $(this).data('id'));
    $("#confirm").modal("show");
})

$("#delete-confirmed").on("click", function(){
    $.ajax({
        url: '/data-rundown/daftar-rundown/delete',
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
                                                <a href="/data-rundown/daftar-rundown?kegiatan_id=${element.event_id}"><button class="btn btn-secondary d-flex m-auto mb-2" type="button">Rundown</button></a>
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
                                        <a href="/data-rundown/daftar-rundown?kegiatan_id=${element.event_id}"><button class="btn btn-secondary d-flex m-auto mb-2" type="button">Rundown</button></a>
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
                    currentDate.setDate(currentDate.getDate() - 1);
                    if (eventDate >= currentDate) {
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
                                                <a href="/data-rundown/daftar-rundown?kegiatan_id=${element.event_id}"><button class="btn btn-secondary d-flex m-auto mb-2" type="button">Rundown</button></a>
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
                                        <li>${element.tanggal_kegiatan}</li>
                                        <li>${element.waktu_kegiatan}</li>
                                        <li>${element.lokasi_kegiatan}</li>
                                        </ul>
                                        <hr>
                                        <h6 class="blog-bottom-details">${element.nama_kegiatan}</h6>
                                        <p class="px-3">${element.deskripsi_kegiatan}</p>
                                        <a href="/data-rundown/daftar-rundown?kegiatan_id=${element.event_id}"><button class="btn btn-secondary d-flex m-auto mb-2" type="button">Rundown</button></a>
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

$("#export-rundown").on("click", function(){
    $.ajax({
        url: '/data-peserta/daftar-peserta/import-peserta/check',
        type: 'GET',
        data: {
            'id_kegiatan': $("#id_kegiatan").val()
        },
        success: function(response) {
            if(response.status){
                $("#export").modal("show");
            }else{
                alertModal(false, response.message);    
            }
        },
        error: function(response) {
            alertModal(false, response.message);
        }
    });
})

$("#upload").on("click", function(){
    $("#export").modal("hide");
    var fileInput = $("#rundown")[0];
    var file = fileInput.files[0];
    
    if (!file) {
        alertModal(false, "Upload file terlebih dahulu");
    }

    var formData = new FormData();
    formData.append('_token', $("meta[name='csrf-token']").attr("content"),)
    formData.append("file", file);
    formData.append('id_kegiatan', $("#id_kegiatan").val());

    $.ajax({
        url: '/data-rundown/daftar-rundown/import-rundown',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            if(response.status){
                fileInput.value = "";
                alertModal(true, "Berhasil menambahkan peserta");
                setTimeout(() => {
                    location.reload();
                }, 2000);
            }
        },
        error: function(response) {
            alertModal(false, response.message);
        }
    });
})