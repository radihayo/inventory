<script>
$(document).ready(function() {   
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 5000
    });

    var table = $('#table_merek').DataTable({
        stateSave: true,
        ajax: "{{ route('merek.read') }}",
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
            data: 'merek',
        }, {
            render: function(data, type, row) {                
                return '<div class="project-actions"><button type="button" class="btn btn-primary" id="btn_edit_merek"' +
                    'data-id="' + row['id'] +
                    '"><i class="fas fa-edit"></i></button>' +
                    '<button type="button" class="btn btn-danger" id="btn_delete_merek"' +
                    'data-id="' + row['id'] + '"data-nama="' + row['merek'] +
                    '"><i class="fas fa-trash"></i></button></div>'                    
            },
        }],
        columnDefs: [{
            "defaultContent": "-",
            "targets": "_all"
        }]
    });

    $('body').on('click', '#btn_add_merek', function () {
        $('#add_merek').modal('show');
    });

    $('body').on('click', '#btn_edit_merek', function() {
        let id = $(this).data('id');
        $.get('merek/' + id + '/edit', function(data) {
            $('#edit_merek').modal('show');
            $('#id').val(data.id);
            $('#merek_edit').val(data.merek); 
        })
    });

    function remove_message_alert(param){
        $("#edit_merek").on("hidden.bs.modal",function(){
            $('#'+param).removeClass('is-invalid');
            $('#'+param+"-error").html("");
        })
    }

    $('#store_data_merek').click(function() { 
        let merek_add = $('#merek_add').val(); 
        let token = $("meta[name='csrf-token']").attr("content");
        $.ajax({
            url:`/merek`,
            type: "POST",
            cache: false,
            data: {
                "merek_add":merek_add,
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
                        title: 'Data Dengan Merek Barang '+merek_add+' Berhasil Ditambahkan'
                    });
                    $("#quickForm")[0].reset();
                    $('#add_merek').modal('hide');
                    table.ajax.reload();
                }                
            },
        });
    });

    $('#update_data_merek').click(function() {
        let id = $('#id').val();
        let merek_edit = $('#merek_edit').val();
        let token = $("meta[name='csrf-token']").attr("content");        
        $.ajax({
            url: `/merek/${id}`,
            type: "PUT",
            cache: false,
            data: {
                "id": id,
                "merek_edit":merek_edit,
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
                        title: 'Data Dengan Merek Barang ' + merek_edit + ' Berhasil Diubah'
                    });
                    $('#edit_merek').modal('hide');
                    table.ajax.reload(null, false);
                }
            },
        });
    });

    $('body').on('click', '#btn_delete_merek', function () {
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
                        url: `/merek/${id}`,
                        cache: false,
                        data: {
                            "id": id,
                            "_token": token
                        },
                        success:function(response){
                            Toast.fire({
                                icon: 'success',
                                title: 'Data Dengan Merek Barang '+nama_hapus+' Berhasil Dihapus'
                            });
                            table.ajax.reload(); 
                        }
                    });  
                }
            })
    });    
});      
</script>