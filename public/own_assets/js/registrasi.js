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

$(document).on("click", ".registrasi", function(){
    $("#id_pegawai").val($(this).data('id'));
    $("#registrasi-modal").modal("show");
});

$("#submit_registrasi").on("click", function(){
    $("#registrasi-modal").modal("hide");
    let btn = $(this);
    btn.prop('disabled', true);
    var signatureData = getSignatureData();

    let formData = new FormData();
    let token = $('meta[name="csrf-token"]').attr("content");

    formData.append("_token", token);
    formData.append("signature", signatureData);
    formData.append("id", $("#id_pegawai").val());
    formData.append("tanggal", $("#tanggal").val());

    $.ajax({
        url: '/registrasi-peserta/daftar-peserta/register',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response){
            if(response.status){
                alertModal(true, "Registrasi berhasil");
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

$(document).on("click", ".absensi", function(){
    $("#id_pegawai").val($(this).data('id'));
    $("#absensi-modal").modal("show");
});

$("#submit_absensi").on("click", function(){
    $("#absensi-modal").modal("hide");
    let id = $("#id_pegawai").val();

    $.ajax({
        url: '/absensi-peserta/daftar-peserta/absensi-admin',
        method: 'POST',
        data: {
            "_token": $("meta[name='csrf-token']").attr("content"),
            'id': id,
            'date': $("#tanggal").val()
        },
        success: function(response){
            if(response.status){
                alertModal(true, "Registrasi berhasil");
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
                                                <a href="/registrasi-peserta/daftar-peserta?kegiatan_id=${element.event_id}"><button class="btn btn-secondary d-flex m-auto mb-2" type="button">Registrasi</button></a>
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
                                        <a href="/registrasi-peserta/daftar-peserta?kegiatan_id=${element.event_id}"><button class="btn btn-secondary d-flex m-auto mb-4" type="button">Registrasi</button></a>
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

$("#registered").on("click", function(){
    $("#edit-data-modal").modal("hide");
    $.ajax({
        url: '/registrasi-peserta/daftar-peserta/registrasi',
        method: 'POST',
        data: {
            "_token": $("meta[name='csrf-token']").attr("content"),
            "id": $("#id").val()
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


//aksi ttd

$(document).on("click", '.ttd-aksi', function(){
    $("#id").val($(this).data('id'));
    $("#ttd-modal").modal("show");
});

document.addEventListener("DOMContentLoaded", function () {
    var canvas = document.getElementById("signature-pad");
    var context = canvas.getContext("2d");

    var drawing = false;
    var lastPos = null;

    function getMousePos(canvas, evt) {
        var rect = canvas.getBoundingClientRect();
        return {
            x: evt.clientX - rect.left,
            y: evt.clientY - rect.top,
        };
    }

    function drawLine(context, x1, y1, x2, y2) {
        context.beginPath();
        context.moveTo(x1, y1);
        context.lineTo(x2, y2);
        context.stroke();
    }

    function mouseDownHandler(e) {
        drawing = true;
        lastPos = getMousePos(canvas, e);
    }

    function mouseMoveHandler(e) {
        if (drawing) {
            var mousePos = getMousePos(canvas, e);
            drawLine(context, lastPos.x, lastPos.y, mousePos.x, mousePos.y);
            lastPos = mousePos;
        }
    }

    function endDrawing() {
        drawing = false;
    }

    canvas.addEventListener("mousedown", mouseDownHandler);
    canvas.addEventListener("mousemove", mouseMoveHandler);
    canvas.addEventListener("mouseup", endDrawing);
    canvas.addEventListener("mouseleave", endDrawing);

    canvas.addEventListener(
        "touchstart",
        function (e) {
            mouseDownHandler(e.touches[0]);
        },
        false
    );

    canvas.addEventListener(
        "touchmove",
        function (e) {
            mouseMoveHandler(e.touches[0]);
            e.preventDefault();
        },
        false
    );

    canvas.addEventListener("touchend", endDrawing, false);

    document
        .getElementById("reset-canvas")
        .addEventListener("click", function () {
            context.clearRect(0, 0, canvas.width, canvas.height);
        });
});

// fungsi untuk mendapatkan tanda tangan
function getSignatureData() {
    var canvas = document.getElementById("signature-pad");
    return canvas.toDataURL("image/png");
}

// fungsi untuk mengirim seluruh form beserta tanda tangan
$("#simpan-ttd").click(function () {
    $("#ttd-modal").modal("hide");
    let btn = $(this);
    btn.prop('disabled', true);
    var signatureData = getSignatureData();

    let formData = new FormData();
    let token = $('meta[name="csrf-token"]').attr("content");

    formData.append("_token", token);
    formData.append("signature", signatureData);
    formData.append("id", $("#id").val());

    $.ajax({
        url: "/absensi-peserta/daftar-peserta/ttd",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            if(response.status){
                alertModal(true, "Berhasil mengubah data");
                setTimeout(() => {
                    location.reload();
                }, 2000);
            }else{
                $('.modal-alert').on('hidden.bs.modal', function () {
                    $("#ttd-modal").modal("show");
                });
                alertModal(false, response.message);
            }
        },
        error: function (response) {
            alertModal(false, response.message);
        },
    });
});