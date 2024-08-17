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

$("#update").on("click", function(){
    $("#edit-data-modal").modal("hide");
    $.ajax({
        url: '/kit-seminar/daftar-kit/update',
        method: 'POST',
        data: {
            "_token": $("meta[name='csrf-token']").attr("content"),
            "id": $("#id").val(),
            "status_kit": $("#status_kit").val()
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

$(".registrasi").on("click", function(){
    let id = $(this).data('id');

    $.ajax({
        url: '/kit-seminar/daftar-kit/edit',
        method: 'GET',
        data: {
            'id': id,
        },
        success: function(response){
            if(response.status){
                $("#id").val(response.data.id);
                console.log(response.data);
                if(response.data.nama){
                    $("#nama").val(response.data.nama);
                    $("#nip").val(response.data.nip);
                    $("#golongan").val(response.data.golongan);
                    $("#jabatan").val(response.data.jabatan);
                    $("#jenis_kelamin").val(response.data.jenis_kelamin);
                }else{
                    $("#nama").val(response.data.pegawai.nama);
                    $("#nip").val(response.data.pegawai.nip);
                    $("#golongan").val(response.data.pegawai.golongan);
                    $("#jabatan").val(response.data.pegawai.jabatan);
                    $("#jenis_kelamin").val(response.data.pegawai.jenis_kelamin);
                }
                
                $("#status_kit").val(response.data.status_kit);

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