<script>
    $(document).ready(function() {
        $('.input_number').keypress(function (e) {
            if (String.fromCharCode(e.keyCode).match(/[^0-9]/g)) return false;
        });
    
        $('#date_picker1').datetimepicker({
            format: 'DD/MM/YYYY'
        });
    
        $('#date_picker2').datetimepicker({
            format: 'DD/MM/YYYY'
        });

        $('.select2bs4').select2({
          theme: 'bootstrap4'
        });
    
        $('#quickForm').validate({
            errorElement: 'div',
            errorPlacement: function(error, element) {
                id = error[0].id;
                $("#" + id).html(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });

        $('#quickForm2').validate({
            errorElement: 'div',
            errorPlacement: function(error, element) {
                id = error[0].id;
                $("#" + id).html(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });    
</script>