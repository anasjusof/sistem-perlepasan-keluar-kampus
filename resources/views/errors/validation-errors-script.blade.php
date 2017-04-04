<script>
	
	$(document).ready(function(){

		//Check on delete checkbox
		$('.deleteBtn').on('click', function(e){

			if ($("#tbody input:checkbox:checked").length > 0)
			{
				$(this).trigger('click');
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
			   alertify.error("Nothing is selected for status approval");
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
