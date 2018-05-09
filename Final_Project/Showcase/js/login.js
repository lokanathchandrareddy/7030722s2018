
$(function() {

  $("#loginForm").validate({
    // Specify validation rules
    rules: {      
      
      loginEmail: {
        required: true,        
        email: true
      },
      loginPassword: {
        required: true,
        minlength: 2
      }
    },
    // Specify validation error messages
    messages: {
      
      loginPassword: {
        required: "Please provide a password",
        minlength: "Your password must be at least 2 characters long"
      },
      email: "Please enter a valid email address"
    },
   
    submitHandler: function(form) {
		  	form.submit();
	        
     
	   }
    
    });//validate
  
  
  
  
});