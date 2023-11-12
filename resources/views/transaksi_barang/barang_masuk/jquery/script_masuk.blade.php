<script>
$(document).ready(function() { 
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 5000
    });

    var table = $('#table_masuk').DataTable({
        stateSave: true,
        ajax: "{{ route('masuk.read') }}",
        paging: true,
        lengthChange: true,         
        autoWidth: false,
        responsive: {
            details: true
        },
        lengthMenu: [5, 10, 15, 20],  
        buttons: [
            { 
                extend: 'print',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            }
        ],
        columns: [{
            render: function(data, type, row, meta) {
                return meta.row + 1;
            }
        }, {
            data: 'tanggal_masuk',
            render: function(data) {
                let new_tanggal_masuk = moment(data).format('DD/MM/YYYY');
                return new_tanggal_masuk                
            }
        }, {
            data: 'barang.nama',
        },{
            data: 'jumlah',
        },{
            data: 'keterangan',
        },{
            render: function(data, type, row, meta) {  
                let nama_barang = table.column(2).data();
                return '<div class="project-actions"><button type="button" class="btn btn-primary" id="btn_edit_masuk"' +
                    'data-id="' + row['id'] +
                    '"><i class="fas fa-edit"></i></button>' +
                    '<button type="button" class="btn btn-danger" id="btn_delete_masuk"' +
                    'data-id="' + row['id'] + '"data-nama="' + nama_barang[meta.row] + '"data-jumlah="' + row['jumlah'] + '"data-id_barang="' + row['id_barang'] +
                    '"><i class="fas fa-trash"></i></button></div>'                    
            },
        }],
        columnDefs: [{
            "defaultContent": "-",
            "targets": "_all"
        }]
    });

    $("#btn_print").on("click", function() {
        table.button( '.buttons-print' ).trigger();
    });

    $('body').on('click', '#btn_add_masuk', function () {
        $('#add_masuk').modal('show');
    });

    $('body').on('click', '#btn_edit_masuk', function() {
        let id = $(this).data('id');
        $.get('masuk/' + id + '/edit', function(data) {
            $('#edit_masuk').modal('show');
            $('#id').val(data.id);
            $('#tanggal_masuk_edit').val(moment(data.tanggal_masuk).format('DD/MM/YYYY'));; 
            $('#id_barang_edit').val(data.id_barang); 
            $('#jumlah_edit').val(data.jumlah); 
            $('#keterangan_edit').val(data.keterangan); 
        })
    });

    function remove_message_alert(param){
        $("#edit_masuk").on("hidden.bs.modal",function(){
            $('#'+param).removeClass('is-invalid');
            $('#'+param+"-error").html("");
        })
    }

    $('#store_data_masuk').click(function() { 
        let tanggal_masuk_add = "";
        let nama_tambah = $(this).data("nama");
        if(moment($('#tanggal_masuk_add').val(), 'DD/MM/YYYY').format('YYYY-MM-DD') == "Invalid date"){
            tanggal_masuk_add = "";
        }else{
            tanggal_masuk_add = moment($('#tanggal_masuk_add').val(), 'DD/MM/YYYY').format('YYYY-MM-DD');
        }
        let id_barang_add = $('#id_barang_add').val(); 
        let jumlah_add = $('#jumlah_add').val(); 
        let keterangan_add = $('#keterangan_add').val();
        let token = $("meta[name='csrf-token']").attr("content");
        $.ajax({
            url:`/masuk`,
            type: "POST",
            cache: false,
            data: {
                "tanggal_masuk_add":tanggal_masuk_add,
                "id_barang_add":id_barang_add,
                "jumlah_add":jumlah_add,
                "keterangan_add":keterangan_add,
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
                        title: 'Data Dengan Nama Barang '+response.nama+' Berhasil Ditambahkan'
                    });
                    $("#quickForm")[0].reset();
                    $('#add_masuk').modal('hide');
                    table.ajax.reload();
                }                
            },
        });
    });

    $('#update_data_masuk').click(function() {
        let id = $('#id').val();
        let tanggal_masuk_edit = "";
        if(moment($('#tanggal_masuk_edit').val(), 'DD/MM/YYYY').format('YYYY-MM-DD') == "Invalid date"){
            tanggal_masuk_edit = "";
        }else{
            tanggal_masuk_edit = moment($('#tanggal_masuk_edit').val(), 'DD/MM/YYYY').format('YYYY-MM-DD');
        }
        let keterangan_edit = $('#keterangan_edit').val();
        let token = $("meta[name='csrf-token']").attr("content");        
        $.ajax({
            url: `/masuk/${id}`,
            type: "PUT",
            cache: false,
            data: {
                "id": id,
                "tanggal_masuk_edit":tanggal_masuk_edit,
                "keterangan_edit":keterangan_edit,
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
                        title: 'Data Dengan Nama Barang ' + keterangan_edit + ' Berhasil Diubah'
                    });
                    $('#edit_masuk').modal('hide');
                    table.ajax.reload(null, false);
                }
            },
        });
    });

    $('body').on('click', '#btn_delete_masuk', function () {
        let id = $(this).data("id");
        let nama_hapus = $(this).data("nama");
        let jumlah_restore = $(this).data("jumlah");
        let id_jumlah_restore = $(this).data("id_barang");
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
                        url: `/masuk/${id}`,
                        cache: false,
                        data: {
                            "id": id,
                            "jumlah_restore":jumlah_restore,
                            "id_jumlah_restore":id_jumlah_restore,
                            "_token": token
                        },
                        success:function(response){
                            if (response.status == "error") {
                                Toast.fire({
                                icon: 'error',
                                title: 'Data '+nama_hapus+' Gagal Dihapus Karena Jumlah Stock Kurang'
                            });
                            } else {
                                Toast.fire({
                                icon: 'success',
                                title: 'Data Dengan Nama Barang '+nama_hapus+' Berhasil Dihapus'
                            });
                            table.ajax.reload(); 
                            }
                        }
                    });  
                }
            })
    });
});     
</script>    