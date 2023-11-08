<script>
$(document).ready(function() {
    $('.form_checkbox').click(function(){
		if($(this).is(':checked')){
			$('.form_password').attr('type','text');
		}else{
			$('.form_password').attr('type','password');
		}
	});
	setTimeout(function(){
            $("div.alert").remove();
    }, 5000 );
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
});     
</script>    