<script>
$(document).ready(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 5000
    });

    var table = $('#table_lokasi').DataTable({
        stateSave: true,
        ajax: "{{ route('lokasi.read') }}",
        paging: true,
        lengthChange: true,         
        autoWidth: false,
        responsive: {
            details: true
        },
        lengthMenu: [5, 10, 15, 20],  
        columns: [{
            render: function(data, type, row, meta) {
                return meta.row + 1;
            }
        }, {
            data: 'lokasi',
        }, {
            render: function(data, type, row) {                
                return '<div class="project-actions"><button type="button" class="btn btn-primary" id="btn_edit_lokasi"' +
                    'data-id="' + row['id'] +
                    '"><i class="fas fa-edit"></i></button>' +
                    '<button type="button" class="btn btn-danger" id="btn_delete_lokasi"' +
                    'data-id="' + row['id'] + '"data-nama="' + row['lokasi'] +
                    '"><i class="fas fa-trash"></i></button></div>'                    
            },
        }],
        columnDefs: [{
            "defaultContent": "-",
            "targets": "_all"
        }]
    });

    $('body').on('click', '#btn_add_lokasi', function () {
        $('#add_lokasi').modal('show');
    });

    $('body').on('click', '#btn_edit_lokasi', function() {
        let id = $(this).data('id');
        $.get('lokasi/' + id + '/edit', function(data) {
            $('#edit_lokasi').modal('show');
            $('#id').val(data.id);
            $('#lokasi_edit').val(data.lokasi); 
        })
    });

    function remove_message_alert(param){
        $("#edit_lokasi").on("hidden.bs.modal",function(){
            $('#'+param).removeClass('is-invalid');
            $('#'+param+"-error").html("");
        })
    }

    $('#store_data_lokasi').click(function() { 
        let lokasi_add = $('#lokasi_add').val(); 
        let token = $("meta[name='csrf-token']").attr("content");
        $.ajax({
            url:`/lokasi`,
            type: "POST",
            cache: false,
            data: {
                "lokasi_add":lokasi_add,
                "_token": token
            },
            success:function(response){
                if (response.status == "error") {
                    $.each(response.message, function(key, value) {
                        $("." + key + "-error").remove();
                        $('#' + key).removeClass('is-invalid');
                        $('#' + key).addClass('is-invalid');
                        $("#" + key + '-error').addClass('invalid-feedback');
                        $("#" + key + '-error').text(response.message[key][0]);
                    });
                }else{
                    Toast.fire({
                        icon: 'success',
                        title: 'Data Dengan Lokasi Barang '+lokasi_add+' Berhasil Ditambahkan'
                    });
                    $("#quickForm")[0].reset();
                    $('#add_lokasi').modal('hide');
                    table.ajax.reload();
                }                
            },
        });
    });

    $('#update_data_lokasi').click(function() {
        let id = $('#id').val();
        let lokasi_edit = $('#lokasi_edit').val();
        let token = $("meta[name='csrf-token']").attr("content");        
        $.ajax({
            url: `/lokasi/${id}`,
            type: "PUT",
            cache: false,
            data: {
                "id": id,
                "lokasi_edit":lokasi_edit,
                "_token": token
            },
            success: function(data) {                
                if (data.status == "error") {            
                    $.each(data.message, function(key, value) {
                        $("." + key + "-error").remove();
                        $('#' + key).removeClass('is-invalid');                    
                        $('#' + key).addClass('is-invalid');
                        $("#" + key + '-error').addClass('invalid-feedback');
                        $("#" + key + '-error').text(data.message[key][0]);
                        remove_message_alert(key);
                    });
                }else{
                    Toast.fire({
                        icon: 'success',
                        title: 'Data Dengan Lokasi Barang ' + lokasi_edit + ' Berhasil Diubah'
                    });
                    $('#edit_lokasi').modal('hide');
                    table.ajax.reload(null, false);
                }
            },
        });
    });

    $('body').on('click', '#btn_delete_lokasi', function () {
        let id = $(this).data("id");
        let nama_hapus = $(this).data("nama");
        let token = $("meta[name='csrf-token']").attr("content");
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Ingin Menghapus Data "+nama_hapus+" ?",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Tidak',
            confirmButtonText: 'Ya'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: `/lokasi/${id}`,
                        cache: false,
                        data: {
                            "id": id,
                            "_token": token
                        },
                        success:function(response){
                            Toast.fire({
                                icon: 'success',
                                title: 'Data Dengan Lokasi Barang '+nama_hapus+' Berhasil Dihapus'
                            });
                            table.ajax.reload(); 
                        }
                    });  
                }
            })
    });     
});      
</script>        