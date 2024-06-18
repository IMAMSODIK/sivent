function alertModal(status, message = null){
    if(status){
        $("#alert-image").attr("src", '../../assets/images/gif/dashboard-8/successful.gif');
        $("#alert-message").text("Success");
        $("#alert-message").text("Berhasil menambahkan data");
    }else{
        $("#alert-image").attr("src", '../../assets/images/gif/danger.gif');
        $("#alert-message").text("Gagal");
        $("#alert-message").text(message);
    }
    
    $("#alert").modal('show');
}

$("#tambah-data").on("click", function(){
    $("#tambah-data-modal").modal("show");
});

$("#store").on("click", function(){
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
        success: function(response){
            if(response.status){
                alertModal(true)
            }else{
                alertModal(false, response.message);
            }
        },
        error: function(response){
            alertModal(false, response.message);
        }
    })
})

function eventCards(kategori){
    $(".done").empty();
    $.ajax({
        url: '/data-peserta/daftar-event',
        method: 'GET',
        data: {
            'kategori': kategori
        },
        success: function(response){
            if(response.status){
                response.data.forEach(element => {
                    let card = `
                            <div class="col-xl-4 xl-50 col-sm-6 box-col-6">
                                <div class="card">
                                    <div class="blog-box blog-grid text-center product-box">
                                    <div class="product-img"><img class="img-fluid top-radius-blog" src="../../storage/flayer/${element.flayer}" alt="" style="width: 350px; height: 350px">
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
                                        <p>${element.deskripsi_kegiatan}</p>
                                        <a href="/data-peserta/daftar-peserta?kegiatan_id=${element.event_id}"><button class="btn btn-secondary d-flex m-auto mb-2" type="button">Peserta</button></a>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        `
                    $(".done").append(card);
                });
            }else{
                alertModal(false, response.message);
            }
        },
        error: function(response){
            alertModal(false, response.message);
        }
    })
}

$(".rapat").on("click", function(){
    eventCards('rapat')
});

$(".meeting").on("click", function(){
    eventCards('meeting')
});

$(".lembur").on("click", function(){
    eventCards('lembur')
});

$("#import-data").on("click", function(){
    $("#export").modal("show");
})

$("#download-template").on("click", function(){
    $('#peserta').removeAttr('disabled');
})