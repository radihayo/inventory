<script>
$(document).ready(function() { 
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 5000
    });

    var table = $('#table_keluar').DataTable({
        stateSave: true,
        ajax: "{{ route('keluar.read') }}",
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
            data: 'tanggal_keluar',
            render: function(data) {
                let new_tanggal_keluar = moment(data).format('DD/MM/YYYY');
                return new_tanggal_keluar                
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
                return '<div class="project-actions"><button type="button" class="btn btn-primary" id="btn_edit_keluar"' +
                    'data-id="' + row['id'] +
                    '"><i class="fas fa-edit"></i></button>' +
                    '<button type="button" class="btn btn-danger" id="btn_delete_keluar"' +
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

    $('body').on('click', '#btn_add_keluar', function () {
        $('#add_keluar').modal('show');
    });

    $('body').on('click', '#btn_edit_keluar', function() {
        let id = $(this).data('id');
        $.get('keluar/' + id + '/edit', function(data) {
            $('#edit_keluar').modal('show');
            $('#id').val(data.id);
            $('#tanggal_keluar_edit').val(moment(data.tanggal_keluar).format('DD/MM/YYYY'));; 
            $('#id_barang_edit').val(data.id_barang); 
            $('#jumlah_edit').val(data.jumlah); 
            $('#keterangan_edit').val(data.keterangan); 
        })
    });

    function remove_message_alert(param){
        $("#edit_keluar").on("hidden.bs.modal",function(){
            $('#'+param).removeClass('is-invalid');
            $('#'+param+"-error").html("");
        })
    }

    $('#store_data_keluar').click(function() { 
        let tanggal_keluar_add = "";
        if(moment($('#tanggal_keluar_add').val(), 'DD/MM/YYYY').format('YYYY-MM-DD') == "Invalid date"){
            tanggal_keluar_add = "";
        }else{
            tanggal_keluar_add = moment($('#tanggal_keluar_add').val(), 'DD/MM/YYYY').format('YYYY-MM-DD');
        }
        let id_barang_add = $('#id_barang_add').val(); 
        let jumlah_add = $('#jumlah_add').val(); 
        let keterangan_add = $('#keterangan_add').val();
        let token = $("meta[name='csrf-token']").attr("content");
        $.ajax({
            url:`/keluar`,
            type: "POST",
            cache: false,
            data: {
                "tanggal_keluar_add":tanggal_keluar_add,
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
                        title: 'Data Dengan Jenis Barang '+id_barang_add+' Berhasil Ditambahkan'
                    });
                    $("#quickForm")[0].reset();
                    $('#add_keluar').modal('hide');
                    table.ajax.reload();
                }                
            },
        });
    });

    $('#update_data_keluar').click(function() {
        let id = $('#id').val();
        let tanggal_keluar_edit = "";
        if(moment($('#tanggal_keluar_edit').val(), 'DD/MM/YYYY').format('YYYY-MM-DD') == "Invalid date"){
            tanggal_keluar_edit = "";
        }else{
            tanggal_keluar_edit = moment($('#tanggal_keluar_edit').val(), 'DD/MM/YYYY').format('YYYY-MM-DD');
        }
        let keterangan_edit = $('#keterangan_edit').val();
        let token = $("meta[name='csrf-token']").attr("content");        
        $.ajax({
            url: `/keluar/${id}`,
            type: "PUT",
            cache: false,
            data: {
                "id": id,
                "tanggal_keluar_edit":tanggal_keluar_edit,
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
                    $('#edit_keluar').modal('hide');
                    table.ajax.reload(null, false);
                }
            },
        });
    });

    $('body').on('click', '#btn_delete_keluar', function () {
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
                        url: `/keluar/${id}`,
                        cache: false,
                        data: {
                            "id": id,
                            "jumlah_restore":jumlah_restore,
                            "id_jumlah_restore":id_jumlah_restore,
                            "_token": token
                        },
                        success:function(response){
                            Toast.fire({
                                icon: 'success',
                                title: 'Data Dengan Nama Barang '+nama_hapus+' Berhasil Dihapus'
                            });
                            table.ajax.reload(); 
                        }
                    });  
                }
            })
    });

});        
</script>    