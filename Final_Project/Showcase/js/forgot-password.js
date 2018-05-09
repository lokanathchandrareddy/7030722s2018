
$(function() {

  $("#forgotForm").validate({
    // Specify validation rules
    rules: {      
      
      user_email: {
        required: true,        
        email: true
      }
    },
    // Specify validation error messages
    messages: {
      
      email: "Please enter a valid email address"
    },
   
    submitHandler: function(form) {
		var site_url = $("#SITE_URL").val();
		var email = $("#user_email").val();
       
       
        var dataString = 'login_email=' + email + '&action=' + 'forgot_password';
       
            
        $(".loader").show();
        // AJAX code to submit form.
        $.ajax({
            type: "POST",
            url: 'inc/ajax_db_functions.php',
            data: dataString,
            dataType: "json",
            cache: false,
            success: function(html) {
                $(".loader").hide();
          
				if(html['confirm']=='1'){
					$("#forgot_result").html('<span style="color:green;">Please check your email box.</span>');
					var email = $("#user_email").val("");
				}
				else if(html['confirm']=='0'){
					$("#forgot_result").html('<span style="color:red;">Invalid email!</span>');
				}
            }
        });
       
        return false; 
      //form.submit();
	   }
    
    });//validate
  
  function site_redirect(url){
	  
	  window.location.href = url;
  }
  
  
  
  
});