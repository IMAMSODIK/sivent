const FLAYER = '../../storage/flayer/'

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

$("#tambah-rapat").on("click", function(){
    $("#tambah-rapat-modal").modal("show");
})

$("#store").on("click", function(){
    $("#tambah-rapat-modal").modal("hide");
    let formData = new FormData();

    formData.append("_token", $("meta[name='csrf-token']").attr('content'));
    formData.append("nama_kegiatan", $("#nama_kegiatan").val());
    formData.append("lokasi_kegiatan", $("#lokasi_kegiatan").val());
    formData.append("tanggal_kegiatan", $("#tanggal_kegiatan").val());
    formData.append("waktu_kegiatan", $("#waktu_kegiatan").val());
    formData.append("deskripsi_kegiatan", $("#deskripsi_kegiatan").val());
    formData.append("no_surat", $("#no_surat").val());
    formData.append("kategori", $("#kategori").val());
    formData.append('flayer', $("#flayer")[0].files[0]);

    $.ajax({
        url: '/rapat/store',
        method: 'POST',
        processData: false,
        contentType: false, 
        data: formData,
        success: function(response){
            if(response.status){
                const givenDate = new Date(response.data.tanggal_kegiatan);
                const currentDate = new Date();
                
                if(givenDate >= currentDate){
                    let event = `
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="blog-box blog-list row">
                                <div class="col-sm-5"><img class="img-fluid sm-100-w" src="../../storage/flayer/${response.data.flayer}" alt="" style="width: 600px; height: 350px"></div>
                                <div class="col-sm-7">
                                    <div class="blog-details">
                                    <div class="blog-date"><span>${response.data.nama_kegiatan}</span></div>
                                    <h6>${response.data.lokasi_kegiatan} </h6>

                                    <div class="row">
                                        <div class="blog-bottom-content col-md-10 d-flex align-items-center">
                                            <ul class="blog-social">
                                                <li>${response.data.tanggal_kegiatan}, ${response.data.waktu_kegiatan}</li>
                                                <li>${response.data.no_surat} </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-2 d-flex justify-content-end">
                                            <button class="btn btn-danger delete-event" data-id="{{$done->event_id}}" style="margin-right: 5px"><i class="fa fa-trash text-white"></i></button>
                                            <button class="btn btn-info edit-event" data-id="{{$done->event_id}}"><i class="fa fa-pencil text-white"></i></button>
                                        </div>
                                    </div>
                                    <hr>
                                    <p class="mt-0">${response.data.deskripsi_kegiatan}</p>
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
                                    <div class="product-img"><img class="img-fluid top-radius-blog" src="../../storage/flayer/${response.data.flayer}" alt="">
                                        <div class="product-hover">
                                        <ul>
                                            <li><i class="icon-link"></i></li>
                                            <li><i class="icon-import"></i></li>
                                        </ul>
                                        </div>
                                    </div>
                                    <div class="blog-details-main">
                                        <ul class="blog-social">
                                        <li>${response.data.tanggal_kegiatan}</li>
                                        <li>${response.data.waktu_kegiatan}</li>
                                        <li>${response.data.lokasi_kegiatan}</li>
                                        </ul>
                                        <hr>
                                        <h6 class="blog-bottom-details">${response.data.nama_kegiatan}</h6>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    $(".done").prepend(event);
                }

                alertModal(true, "Berhasil menambahkan data");
            }else{
                alertModal(false, response.message);
            }
        },
        error: function(response){
            alertModal(false, response.message);
        }
    })
})

$(document).on("click", ".edit-event", function(){
    let id = $(this).data('id');

    $.ajax({
        url: '/event/edit',
        method: 'GET',
        data: {
            'id': id
        },
        success: function(response){
            if(response.status){
                $("#id_event").val(response.data.event_id);
                $("#edit_nama_kegiatan").val(response.data.nama_kegiatan);
                $("#edit_lokasi_kegiatan").val(response.data.lokasi_kegiatan);
                $("#edit_tanggal_kegiatan").val(response.data.tanggal_kegiatan);
                $("#edit_waktu_kegiatan").val(response.data.waktu_kegiatan);
                $("#edit_deskripsi_kegiatan").val(response.data.deskripsi_kegiatan);
                $("#edit_no_surat").val(response.data.no_surat);
                $("#gambar_flayer").attr("src", FLAYER + response.data.flayer);
                $("#edit-rapat-modal").modal('show');
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
    $("#edit-rapat-modal").modal("hide");
    let formData = new FormData();

    formData.append("_token", $("meta[name='csrf-token']").attr('content'));
    formData.append("nama_kegiatan", $("#edit_nama_kegiatan").val());
    formData.append("lokasi_kegiatan", $("#edit_lokasi_kegiatan").val());
    formData.append("tanggal_kegiatan", $("#edit_tanggal_kegiatan").val());
    formData.append("waktu_kegiatan", $("#edit_waktu_kegiatan").val());
    formData.append("deskripsi_kegiatan", $("#edit_deskripsi_kegiatan").val());
    formData.append("no_surat", $("#edit_no_surat").val());
    formData.append("kategori", $("#edit_kategori").val());
    formData.append("id_event", $("#id_event").val());
    formData.append('flayer', $("#edit_flayer")[0].files[0]);

    $.ajax({
        url: '/event/update',
        method: 'POST',
        processData: false,
        contentType: false, 
        data: formData,
        success: function(response){
            if(response.status){
                const givenDate = new Date(response.data.tanggal_kegiatan);
                const currentDate = new Date();
                
                // if(givenDate >= currentDate){
                //     let event = `
                //         <div class="col-xl-12">
                //             <div class="card">
                //                 <div class="blog-box blog-list row">
                //                 <div class="col-sm-5"><img class="img-fluid sm-100-w" src="../../storage/flayer/${response.data.flayer}" alt="" style="width: 600px; height: 350px"></div>
                //                 <div class="col-sm-7">
                //                     <div class="blog-details">
                //                     <div class="blog-date"><span>${response.data.nama_kegiatan}</span></div>
                //                     <h6>${response.data.lokasi_kegiatan} </h6>

                //                     <div class="row">
                //                         <div class="blog-bottom-content col-md-10 d-flex align-items-center">
                //                             <ul class="blog-social">
                //                                 <li>${response.data.tanggal_kegiatan}, ${response.data.waktu_kegiatan}</li>
                //                                 <li>${response.data.no_surat} </li>
                //                             </ul>
                //                         </div>
                //                         <div class="col-md-2 d-flex justify-content-end">
                //                             <button class="btn btn-danger delete-event" data-id="{{$done->event_id}}" style="margin-right: 5px"><i class="fa fa-trash text-white"></i></button>
                //                             <button class="btn btn-info edit-event" data-id="{{$done->event_id}}"><i class="fa fa-pencil text-white"></i></button>
                //                         </div>
                //                     </div>
                //                     <hr>
                //                     <p class="mt-0">${response.data.deskripsi_kegiatan}</p>
                //                     </div>
                //                 </div>
                //                 </div>
                //             </div>
                //         </div>
                //     `;
                //     $(".incoming").prepend(event);
                // }else{
                //     let event = `
                //             <div class="col-xl-4 xl-50 col-sm-6 box-col-6">
                //                 <div class="card">
                //                     <div class="blog-box blog-grid text-center product-box">
                //                     <div class="product-img"><img class="img-fluid top-radius-blog" src="../../storage/flayer/${response.data.flayer}" alt="">
                //                         <div class="product-hover">
                //                         <ul>
                //                             <li><i class="icon-link"></i></li>
                //                             <li><i class="icon-import"></i></li>
                //                         </ul>
                //                         </div>
                //                     </div>
                //                     <div class="blog-details-main">
                //                         <ul class="blog-social">
                //                         <li>${response.data.tanggal_kegiatan}</li>
                //                         <li>${response.data.waktu_kegiatan}</li>
                //                         <li>${response.data.lokasi_kegiatan}</li>
                //                         </ul>
                //                         <hr>
                //                         <h6 class="blog-bottom-details">${response.data.nama_kegiatan}</h6>
                //                     </div>
                //                     </div>
                //                 </div>
                //             </div>
                //         `;
                //     $(".done").prepend(event);
                // }

                console.log(response.data);

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

$(document).on("click", ".delete-event", function(){
    $("#delete-confirmed").attr("data-id", $(this).data('id'));
    $("#confirm").modal("show");
})

$(document).on("click", "#delete-confirmed", function(){
    let id = $(this).data('id');

    $.ajax({
        url: '/event/delete',
        method: 'POST',
        data: {
            "_token": $("meta[name='csrf-token']").attr('content'),
            "id": id,
        },
        success: function(response){
            if(response.status){
                alertModal(true, "Berhasil menghapus data!");
            }else{
                alertModal(false, response.message);
            }
        },
        error: function(response){
            alertModal(false, response.message);
        }
    })
})

$(".close-modal").on("click", function(){
    $("#edit-rapat-modal").modal("hide");
    $("#tambah-rapat-modal").modal("hide");
})