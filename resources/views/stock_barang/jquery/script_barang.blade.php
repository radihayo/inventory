<script>
$(document).ready(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 5000
    });

    var table = $('#table_barang').DataTable({
        stateSave: true,
        ajax: "{{ route('barang.read') }}",
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
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                }
            }
        ],    
        columns: [{
            render: function(data, type, row, meta) {
                return meta.row + 1;
            }
        }, {
            data: 'nama',
        }, {
            data: 'ukuran',
        }, {
            data: 'stock',
        }, {
            data: 'relation_jenis.jenis.',
            render: function(data) {
                let jenis = "";
                if(data == null){
                    jenis = "Jenis Barang Belum Diisi";
                }else {
                    jenis = data;
                }
                return jenis                
            }
        }, {
            data: 'relation_merek.merek',
            render: function(data) {
                let merek = "";
                if(data == null){
                    merek = "Merek Barang Belum Diisi";
                }else {
                    merek = data;
                }
                return merek                
            }
        }, {
            data: 'relation_satuan.satuan',
            render: function(data) {
                let satuan = "";
                if(data == null){
                    satuan = "Satuan Barang Belum Diisi";
                }else {
                    satuan = data;
                }
                return satuan                
            }
        }, {
            data: 'relation_lokasi.lokasi',
            render: function(data) {
                let lokasi = "";
                if(data == null){
                    lokasi = "Lokasi Barang Belum Diisi";
                }else {
                    lokasi = data;
                }
                return lokasi                
            }
        }, {
            render: function(data, type, row) {                
                return '<div class="project-actions"><button type="button" class="btn btn-primary" id="btn_edit_barang"' +
                    'data-id="' + row['id'] +
                    '"><i class="fas fa-edit"></i></button>' +
                    '<button type="button" class="btn btn-danger" id="btn_delete_barang"' +
                    'data-id="' + row['id'] + '"data-nama="' + row['nama'] +
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

    $('body').on('click', '#btn_add_barang', function () {
        $('#add_barang').modal('show');
    });

    $('body').on('click', '#btn_edit_barang', function() {
        let id = $(this).data('id');
        $.get('barang/' + id + '/edit', function(data) {
            $('#edit_barang').modal('show');
            $('#id').val(data.id);
            $('#nama_edit').val(data.nama); 
            $('#ukuran_edit').val(data.ukuran); 
            $('#stock_edit').val(data.stock); 
            $('#id_jenis_edit').val(data.id_jenis); 
            $('#id_merek_edit').val(data.id_merek); 
            $('#id_satuan_edit').val(data.id_satuan); 
            $('#id_lokasi_edit').val(data.id_lokasi); 
        })
    });

    function remove_message_alert(param){
        $("#edit_barang").on("hidden.bs.modal",function(){
            $('#'+param).removeClass('is-invalid');
            $('#'+param+"-error").html("");
        })
    }

    $('#store_data_barang').click(function() { 
        let nama_add = $('#nama_add').val();
        let ukuran_add = $('#ukuran_add').val();
        let stock_add = $('#stock_add').val();
        let id_jenis_add = $('#id_jenis_add').val();
        let id_merek_add = $('#id_merek_add').val();
        let id_satuan_add = $('#id_satuan_add').val();
        let id_lokasi_add = $('#id_lokasi_add').val();
        let token = $("meta[name='csrf-token']").attr("content");
        $.ajax({
            url:`/barang`,
            type: "POST",
            cache: false,
            data: {
                "nama_add":nama_add,
                "ukuran_add":ukuran_add,
                "stock_add":stock_add,
                "id_jenis_add":id_jenis_add,
                "id_merek_add":id_merek_add,
                "id_satuan_add":id_satuan_add,
                "id_lokasi_add":id_lokasi_add,
                "_token": token
            },
            success:function(response){
                if (response.status == "error") {
                    $.each(response.message, function(key, value) {
                        $("." + key + "-error").remove();

                        // setTimeout(function(){
                        $('#' + key).removeClass('is-invalid');
                    // },8000)
                        $('#' + key).addClass('is-invalid');
                        
                        $("#" + key + '-error').addClass('invalid-feedback');
                        $("#" + key + '-error').text(response.message[key][0]);
                    });
                }else{
                    Toast.fire({
                        icon: 'success',
                        title: 'Data Dengan Nama Barang '+nama_add+' Berhasil Ditambahkan'
                    });
                    $("#quickForm")[0].reset();
                    $('#add_barang').modal('hide');
                    table.ajax.reload();
                }                
            },
        });
    });

    $('#update_data_barang').click(function() {
        let id = $('#id').val();
        let nama_edit = $('#nama_edit').val();
        let ukuran_edit = $('#ukuran_edit').val();
        let stock_edit = $('#stock_edit').val();
        let id_jenis_edit = $('#id_jenis_edit').val();
        let id_merek_edit = $('#id_merek_edit').val();
        let id_satuan_edit = $('#id_satuan_edit').val();
        let id_lokasi_edit = $('#id_lokasi_edit').val();
        let token = $("meta[name='csrf-token']").attr("content");        
        $.ajax({
            url: `/barang/${id}`,
            type: "PUT",
            cache: false,
            data: {
                "id": id,
                "nama_edit":nama_edit,
                "ukuran_edit":ukuran_edit,
                "stock_edit":stock_edit,
                "id_jenis_edit":id_jenis_edit,
                "id_merek_edit":id_merek_edit,
                "id_satuan_edit":id_satuan_edit,
                "id_lokasi_edit":id_lokasi_edit,
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
                        title: 'Data Dengan Nama Barang ' + nama_edit + ' Berhasil Diubah'
                    });
                    $('#edit_barang').modal('hide');
                    table.ajax.reload(null, false);
                }
            },
        });
    });

    $('body').on('click', '#btn_delete_barang', function () {
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
                        url: `/barang/${id}`,
                        cache: false,
                        data: {
                            "id": id,
                            "_token": token
                        },
                        success:function(response){
                            if (response.status == "error") {
                                Toast.fire({
                                icon: 'error',
                                title: 'Data '+nama_hapus+' Gagal Dihapus Karena Sedang Digunakan, Cek Transaksi Barang'
                            });
                            } else {
                                Toast.fire({
                                icon: 'success',
                                title: 'Data Dengan Jenis Barang '+nama_hapus+' Berhasil Dihapus'
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