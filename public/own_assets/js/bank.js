let table = $("#basic-1").DataTable();

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
    formData.append("nama_bank", $("#nama_bank").val());

    $.ajax({
        url: '/data-bank/store',
        method: 'POST',
        processData: false,
        contentType: false, 
        data: formData,
        success: function(response){
            if(response.status){
                alertModal(true);
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

$("#cancel-edit").on("click", function(){
    closeModal($("#edit-data-modal"));
})

$("#cancel-add").on("click", function(){
    closeModal($("#tambah-data-modal"));
})

$(document).on("click", ".edit", function(){
    let id = $(this).data('id');

    $.ajax({
        url: '/data-bank/edit',
        method: 'GET',
        data: {
            'id': id
        },
        success: function(response){
            if(response.status){
                $("#id").val(response.data.id);
                $("#edit_nama_bank").val(response.data.nama_bank);

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
        url: '/data-bank/update',
        method: 'POST',
        data: {
            '_token': $("meta[name='csrf-token']").attr("content"),
            'id': $("#id").val(),
            'nama_bank': $("#edit_nama_bank").val()
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
        url: '/data-bank/delete',
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