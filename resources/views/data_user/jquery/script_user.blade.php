<script>
$(document).ready(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 5000
    });

    var table = $('#table_user').DataTable({
        stateSave: true,
        ajax: "{{ route('user.read') }}",
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
            data: 'nama',
        },  {
            data: 'email',
        }, {
            data: 'jenis_kelamin',
            render: function(data) {
                let jenis_kelamin = "";
                if(data=='0'){
                    jenis_kelamin = "Laki - Laki";
                }else{
                    jenis_kelamin = "Perempuan";
                }
                return jenis_kelamin                
            }
        },{
            data: 'tempat_lahir',
        },{
            data: 'tanggal_lahir',
            render: function(data) {
                let tanggal_lahir = moment(data).format('DD/MM/YYYY');
                return tanggal_lahir                
            }
        },{
            data: 'agama',
            render: function(data){
                let agama = "";
                if(data == "0"){
                    agama = "Islam";
                }else if(data == "1"){
                    agama = "Kristen";
                }else if(data == "2"){
                    agama = "Hindu";
                }else if(data == "3"){
                    agama = "Buddha";
                }else{
                    agama = "Konghucu";
                }
                return agama
            }
        },{
            data: 'no_telp',
        },{
            data: 'alamat',
        },{
            render: function(data, type, row) {                
                return '<div class="btn-group"><button type="button" class="btn btn-primary" id="btn_edit_user"' +
                    'data-id="' + row['id'] +
                    '"><i class="fas fa-edit"></i></button>' + 
                    '<button type="button" class="btn btn-danger" id="btn_delete_user"' +
                    'data-id="' + row['id'] + '"data-nama="' + row['nama'] + '"data-email="' + row['email'] +
                    '"><i class="fas fa-trash"></i></button>' +
                    '<button type="button" class="btn btn-warning" id="btn_reset_user"' +
                    'data-id="' + row['id'] + '"data-nama="' + row['nama'] + '"data-email="' + row['email'] + '"data-no_telp="' + row['no_telp'] +
                    '"><i class="fas fa-undo-alt"></i></button></div>'                    
            },
        }],
        columnDefs: [{
            "defaultContent": "-",
            "targets": "_all"
        }]
    });

    $('body').on('click', '#btn_add_user', function () {
        $('#add_user').modal('show');
    });

    $('body').on('click', '#btn_edit_user', function() {
        let id = $(this).data('id');
        $.get('user/' + id + '/edit', function(data) {
            $('#edit_user').modal('show');
            $('#id').val(data.id);
            $('#nama_edit').val(data.nama); 
            $('#email_edit').val(data.email);
            $('#jenis_kelamin_edit').val(data.jenis_kelamin);
            $('#tempat_lahir_edit').val(data.tempat_lahir);
            $('#tanggal_lahir_edit').val(moment(data.tanggal_lahir).format('DD/MM/YYYY'));
            $('#agama_edit').val(data.agama);
            $('#no_telp_edit').val(data.no_telp);
            $('#alamat_edit').val(data.alamat);
        })
    });

    function remove_message_alert(param){
        $("#edit_user").on("hidden.bs.modal",function(){
            $('#'+param).removeClass('is-invalid');
            $('#'+param+"-error").html("");
        })
    }

    $('#store_data_user').click(function() { 
        let nama_add = $('#nama_add').val(); 
        let email_add = $('#email_add').val(); 
        let jenis_kelamin_add = $('#jenis_kelamin_add').val(); 
        let tempat_lahir_add = $('#tempat_lahir_add').val(); 
        let tanggal_lahir_add = "";
        if(moment($('#tanggal_lahir_add').val(), 'DD/MM/YYYY').format('YYYY-MM-DD') == "Invalid date"){
          tanggal_lahir_add = "";
        }else{
          tanggal_lahir_add = moment($('#tanggal_lahir_add').val(), 'DD/MM/YYYY').format('YYYY-MM-DD');
        }
        let agama_add = $('#agama_add').val(); 
        let no_telp_add = $('#no_telp_add').val(); 
        let alamat_add = $('#alamat_add').val(); 
        let token = $("meta[name='csrf-token']").attr("content");
        $.ajax({
            url:`/user`,
            type: "POST",
            cache: false,
            data: {
                "nama_add":nama_add,
                "email_add":email_add,
                "jenis_kelamin_add":jenis_kelamin_add,
                "tempat_lahir_add":tempat_lahir_add,
                "tanggal_lahir_add":tanggal_lahir_add,
                "agama_add":agama_add,
                "no_telp_add":no_telp_add,
                "alamat_add":alamat_add,
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
                        title: 'Data Dengan Nama User '+nama_add+' Berhasil Ditambahkan'
                    });
                    $("#quickForm")[0].reset();
                    $('#add_user').modal('hide');
                    table.ajax.reload();
                }                
            },
        });
    });

    $('#update_data_user').click(function() {
        let id = $('#id').val();
        let nama_edit = $('#nama_edit').val(); 
        let email_edit = $('#email_edit').val(); 
        let jenis_kelamin_edit = $('#jenis_kelamin_edit').val(); 
        let tempat_lahir_edit = $('#tempat_lahir_edit').val(); 
        let tanggal_lahir_edit = "";
        if(moment($('#tanggal_lahir_edit').val(), 'DD/MM/YYYY').format('YYYY-MM-DD') == "Invalid date"){
          tanggal_lahir_edit = "";
        }else{
          tanggal_lahir_edit = moment($('#tanggal_lahir_edit').val(), 'DD/MM/YYYY').format('YYYY-MM-DD');
        }
        let agama_edit = $('#agama_edit').val(); 
        let no_telp_edit = $('#no_telp_edit').val(); 
        let alamat_edit = $('#alamat_edit').val();
        let token = $("meta[name='csrf-token']").attr("content");        
        $.ajax({
            url: `/user/${id}`,
            type: "PUT",
            cache: false,
            data: {
                "id": id,
                "nama_edit":nama_edit,
                "email_edit":email_edit,
                "jenis_kelamin_edit":jenis_kelamin_edit,
                "tempat_lahir_edit":tempat_lahir_edit,
                "tanggal_lahir_edit":tanggal_lahir_edit,
                "agama_edit":agama_edit,
                "no_telp_edit":no_telp_edit,
                "alamat_edit":alamat_edit,
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
                        title: 'Data Dengan Nama User ' + nama_edit + ' Berhasil Diubah'
                    });
                    $('#edit_user').modal('hide');
                    table.ajax.reload(null, false);
                }
            },
        });
    });

    $('body').on('click', '#btn_delete_user', function () {
        let id = $(this).data("id");
        let nama_hapus = $(this).data("nama");
        let email = $(this).data("email");
        let token = $("meta[name='csrf-token']").attr("content");
        Swal.fire({
            title: 'Menghapus Data User Akan Menghapus Akun User, Apakah Anda Yakin?',
            text: "Ingin Menghapus Data "+nama_hapus+" ?",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Tidak',
            confirmButtonText: 'Ya'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: `/user/${id}`,
                        cache: false,
                        data: {
                            "id": id,
                            "email":email,
                            "_token": token
                        },
                        success:function(response){
                            Toast.fire({
                                icon: 'success',
                                title: 'Data Dengan Nama User '+nama_hapus+' Berhasil Dihapus'
                            });
                            table.ajax.reload(); 
                        }
                    });  
                }
            })
    });

    $('body').on('click', '#btn_reset_user', function () {
        let nama_reset = $(this).data("nama");
        let email = $(this).data("email");
        let no_telp = $(this).data("no_telp");
        let token = $("meta[name='csrf-token']").attr("content");
        Swal.fire({
            title: 'Apakah Anda Yakin?',
            text: "Ingin Mereset Password "+nama_reset+" ?",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Tidak',
            confirmButtonText: 'Ya'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "PUT",
                        url: "{{ route('user.reset_password') }}",
                        cache: false,
                        data: {
                            "email":email,
                            "no_telp":no_telp,
                            "_token": token
                        },
                        success:function(response){
                            Toast.fire({
                                icon: 'success',
                                title: 'Data Password Dengan Nama User '+nama_reset+' Berhasil Direset'
                            });
                            table.ajax.reload(); 
                        }
                    });  
                }
            })
    });

});         
</script>