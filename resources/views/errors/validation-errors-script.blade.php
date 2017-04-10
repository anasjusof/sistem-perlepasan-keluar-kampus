<script>
	
	$(document).ready(function(){

		//Check on delete checkbox
		$('.deleteBtn').on('click', function(e){

			if ($("#tbody input:checkbox:checked").length > 0)
			{
				e.preventDefault();
				//$(this).trigger('click');

				swal({
				  title: 'Are you sure you want to delete?',
				  type: 'warning',
				  showCancelButton: true,
				  confirmButtonColor: '#3085d6',
				  cancelButtonColor: '#d33',
				  confirmButtonText: 'Delete'
				}).then(function () {
					$("#form_update_status").trigger('submit');
				}).catch(swal.noop);

			}
			else
			{
			   
			   e.preventDefault();
			   alertify.error("Nothing is selected to delete");
			}
		});

		//Check on update checkbox
		$('.updateBtn').on('click', function(e){

			if ($("#tbody input:radio:checked").length > 0)
			{
				$(this).trigger('click');
			}
			else
			{
			   
			   e.preventDefault();
			   alertify.error("Sila pilih permohonan untuk diluluskan/ditolak");
			}
		});

		//Check on delete checkbox
		// $('.submitUserBtn').on('click', function(e){
		// 	e.preventDefault();

		// 	if(!($("#username").val())){
		// 		$("#username").focus();
		// 	   	alertify.error("Name field is empty");
		// 	}
		// 	if(!($("#email").val())){
		// 		$("#email").focus();
		// 	   	alertify.error("Email field is empty");
		// 	}
		// 	if(!($("#password").val())){
		// 		$("#password").focus();
		// 	   	alertify.error("Password field is empty");
		// 	}

		// 	if ($('#password').val() != $('#confirm_password').val()) {
		// 		$("#confirm_password").focus();
		// 		alertify.error("Password does not matched");
		// 	}
		// });
	});

</script>
