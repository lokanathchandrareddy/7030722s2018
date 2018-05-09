$(document).ready(function() {
    $('#profile_edit_form').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },

        fields: {
            first_name: {
                validators: {
                        notEmpty: {
                        message: 'First name is required!'
                    },
					regexp: {
                        regexp: /^[a-zA-Z]+$/,
                        message: 'Please enter latters only'
                    }

                }
            },
			last_name: {
                validators: {
                        notEmpty: {
                        message: 'Last name is required!'
                    },
					regexp: {
                        regexp: /^[a-zA-Z]+$/,
                        message: 'Please enter latters only'
                    }

                }
            },
			user_email: {
                validators: {
                    notEmpty: {
                        message: 'Please enter your email address'
                    },
                    emailAddress: {
                        regexp: /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/,
                        message: 'Please enter a valid email address'
                    },
					remote: {
                        url: $("#SITE_URL").val()+'/inc/ajax_db_functions.php',
                        //Send {  email: 'its value' } to the back-end
                        data: function(validator) {
                            return {
                                user_email: validator.getFieldElements('user_email').val(),
                                action: 'profile_update_email'
                            };
                        },
                        message: 'Email already exist!'
                    }
                }
            },

		}//fields




    });




	/********************************* Profile Image upload ***********/
	$(document).on('change', '#image_upload_file', function(){



		var form_data = new FormData();

		form_data.append("file", document.getElementById('image_upload_file').files[0]);
		   $.ajax({
		  url:"image_upload.php",
		  method:"POST",
		  data: form_data,
		  dataType: "json",
		  contentType: false,
		  cache: false,
		  processData: false,
		  beforeSend:function(){
		    //$('#uploaded_image').html("<label class='text-success'>Image Uploading...</label>");
			 $(".loader").show();
		  },
		  success:function(data)
		  {
			 $(".loader").hide();

			if(data['status']){


			  $("#edit_pic_pre").html('<img src="'+data['image_medium_src']+'"/>');
			  $("#profile_picture").val(data['file_name']);

			 }else{
			  $("#edit_pic_pre").html(data['error']);
			}
		  }
		});

    });


	/*****************************************************************************************/
	/************************************************* Reset Password*************************/
	/************************************************* ***************************************/


	$('#resetPwd_frm').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },

        fields: {
			user_password: {
                validators: {
                    stringLength: {
                        min: 8,
                        max: 25,
                        message:'Please enter at least 8 characters and no more than 25'
                    },
                    notEmpty: {
                        message: 'Please enter you password'
                    }
                }
            },
            user_re_password: {
                validators: {
                    identical: {
                        field: 'user_password',
                        message: 'The password and its confirm are not the same'
                    },
                    notEmpty: {
                        message: 'Please confirm your password'
                    }
                }
            }
		},
		submitHandler:function(form)
             {
                 var user_re_password = $('#password-reg').val();
                 var confirm_password = $('#password-reg-re').val();
                 var user_id = $('#user_id').val();
                  jQuery.ajax({
					url: 'inc/ajax_db_functions.php',
					type: 'POST',
					dataType: "json",
					data: {'user_re_password': user_re_password, 'confirm_password': confirm_password,'user_id': user_id,'action': 'reset-confirm'},
					    success: function(data) {
					        if(data['reset-password'] == 1)
					        {
					            $('#password-changed').html('<h4 style="color:green;font-size:18px;">Password reset successfully</h4>');
					            window.location.href="index.php";
					        }
				// 		 alert(data);
				}
			});
            }
		//fields

    });






});//Main close
