<script>
$(document).ready(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 5000
    });

    function remove_message_alert(param){
        $("#edit_data").on("hidden.bs.modal",function(){
            $('#'+param).removeClass('is-invalid');
            $('#'+param+"-error").html("");
        })
    }

    function read_data() {
        $.get("{{ url('pengaturan/read') }}", function(data, status) {
            $("#data_akun_login").html(data);
        })
    }

    function reloadFoto() {
      $.get('/pengaturan/reload', function(data) {
          $('#fotoprofil').html(data);
      });
    };

    function reloadFoto_sidebar(){
      $.get('/pengaturan/reload_sidebar', function(data) {
          $('#fotoprofil_sidebar').html(data);
      });
    }

 
    $('body').on('click', '#btn_edit_password', function () {
        $('#edit_password').modal('show');
    });
    // $('body').on('click', '#btn_edit_password', function() {
    //     let id = $(this).data('id');
    //     $.get('pengaturan/edit_password/' + id , function(data) {
    //         $('#edit_password').modal('show');
    //         $('#id').val(data.id);
    //     })
    // });

    $('body').on('click', '#btn_edit_data', function() {
        let id = $(this).data('id');
        // $.get('pengaturan/edit_data/' + id , function(data) {
        $.get('pengaturan/' + id + '/edit', function(data){
            $('#edit_data').modal('show');
            $('#id').val(data.id);
            $('#nama_update').val(data.nama); 
            $('#email_update').val(data.email);
            $('#jenis_kelamin_update').val(data.jenis_kelamin);
            $('#tempat_lahir_update').val(data.tempat_lahir);
            $('#tanggal_lahir_update').val(moment(data.tanggal_lahir).format('DD/MM/YYYY'));
            $('#agama_update').val(data.agama);
            $('#no_telp_update').val(data.no_telp);
            $('#alamat_update').val(data.alamat);
        })
    });

    $('#update_password').click(function() {      
        let old_password   = $('#old_password').val();
        let new_password = $('#new_password').val();
        let re_new_password = $('#re_new_password').val();
        let token   = $("meta[name='csrf-token']").attr("content");
        $.ajax({
            url:`/pengaturan`,
            type: "POST",
            cache: false,
            data: {
                "old_password": old_password,
                "new_password": new_password,
                "re_new_password": re_new_password,
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
                    } else {
                        Toast.fire({
                            icon: 'success',
                            title: 'Password Berhasil Diubah'
                    })
                    $('#edit_password').modal('hide');
                }
            },
        });
    });

    $('#update_data').click(function() {
        let id = $('#id').val();
        let nama_update = $('#nama_update').val(); 
        let email_update = $('#email_update').val(); 
        let jenis_kelamin_update = $('#jenis_kelamin_update').val(); 
        let tempat_lahir_update = $('#tempat_lahir_update').val(); 
        let tanggal_lahir_update = "";
        if(moment($('#tanggal_lahir_update').val(), 'DD/MM/YYYY').format('YYYY-MM-DD') == "Invalid date"){
            tanggal_lahir_update = "";
        }else{
            tanggal_lahir_update = moment($('#tanggal_lahir_update').val(), 'DD/MM/YYYY').format('YYYY-MM-DD');
        }
        let agama_update = $('#agama_update').val(); 
        let no_telp_update = $('#no_telp_update').val(); 
        let alamat_update = $('#alamat_update').val();
        let token = $("meta[name='csrf-token']").attr("content");        
        $.ajax({
       
            url: `/pengaturan/${id}`,
            type: "PUT",
            cache: false,
            data: {
                "id": id,
                "nama_update":nama_update,
                "email_update":email_update,
                "jenis_kelamin_update":jenis_kelamin_update,
                "tempat_lahir_update":tempat_lahir_update,
                "tanggal_lahir_update":tanggal_lahir_update,
                "agama_update":agama_update,
                "no_telp_update":no_telp_update,
                "alamat_update":alamat_update,
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
                        title: 'Data Diri Berhasil Diubah'
                    });
                    $('#edit_data').modal('hide');
                    read_data();
                }
            },
        });
    });


    $('body').on('click', '#btn_edit_foto', function () {
        // createCroppie();
        $('#edit_foto').modal('show');
    });

    let resize;
    function createCroppie(){
        //nggawe kanvas
        resize = $('#upload-demo').croppie({
            enableExif: true,
            enableOrientation: true,    
            viewport: { 
                width: 200,
                height: 200,
                type: 'square'
            },   
            boundary: {
                width: 250,
                height: 250
            }
        });
        //input img ng kanvas
        $('#image').on('change', function () { 
            let reader = new FileReader();
            reader.onload = function (e) {
                resize.croppie('bind',{
                    url: e.target.result
                });
            }
            reader.readAsDataURL(this.files[0]);
        });
    }

    // function remove_image(){
        $("#edit_foto").on("hidden.bs.modal",function(){
            // $('#upload-demo').removeClass('croppie-container');
            $('#upload-demo').croppie('destroy');
            // $("#upload-demo").empty();
            // $("#upload-demo").html("");
            $("#image").val("");
            // $('#upload-demo').croppie('bind',{url : ''});
            // new Croppie(document.getElementById("image"), resize);
            // resize.croppie('bind', {url : ''});
        })
    // }

    $('#upload-image').on('click', function (ev) {
        let token   = $("meta[name='csrf-token']").attr("content");
        resize.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (response) {
            $.ajax({
                url: "{{route('pengaturan.upload')}}",
                type: "POST",
                data: {
                    "image":response,
                    "_token": token
                },
                success: function (data) {
                    if (data.status == "error") {
                        $.each(data.message, function(key, value) {
                            let id = "#" + key + "-error";
                            // fokus input invalid
                            $('#' + key).addClass('is-invalid');

                            //add invalid to div id=foto-error
                            $(id).addClass('invalid-feedback d-block');
                            $(id).text(data.message[key][0]);

                            setTimeout(function() {
                                $("#" + key + "-error").removeClass('d-block');
                                $('#' + key).removeClass('is-invalid');
                            }, 3000)
                        });                    
                    } else {
                        Toast.fire({
                            icon: 'success',
                            title: 'Gambar Berhasil Diupload'
                        })
                        $('#edit_foto').modal('hide');
                        // remove_image();
                        // createCroppie();
                        $('#upload-demo').croppie('destroy');
                        $("#image").val("");
                        reloadFoto();
                        reloadFoto_sidebar();
                        // $('#upload-demo').croppie('bind');
                        // resize.croppie('bind', {url : ''});
                        // $('#upload-demo').croppie(opts);
                        // $('#upload-demo').croppie(method, args);
                    }
                }
            });
        });
    });
    
});     
</script>