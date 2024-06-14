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