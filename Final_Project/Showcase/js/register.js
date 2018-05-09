// Register Form Validatons

$(document).ready(function() {
    $('#register-form').bootstrapValidator({
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
                        message: 'First and Last name is required!'
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
                        message: 'First and Last name is required!'
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
                        url: 'inc/ajax_db_functions.php',
                        //Send {  email: 'its value' } to the back-end
                        data: function(validator) {
                            return {
                                user_email: validator.getFieldElements('user_email').val(),
                                action: 'register'
                            };
                        },
                        message: 'Email already exist!' 
                    }                    
                }
            },
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
                 var first_name = $('#signup-user-first-name').val();
                 var last_name = $('#signup-user-last-name').val();
                 var email = $('#email').val();
                 var password_reg = $('#password-reg').val();
                 jQuery.ajax({
                    url: 'inc/ajax_db_functions.php',
                    type: 'POST',
                    dataType: "json",
                    data: {'first_name':first_name, 'last_name':last_name,'email':email,'password_reg': password_reg,'action':'register_form'},
                        success: function(data) {
                         if(data['reg_confirm'] == 1)
                         {
                          $('#error-user').html('<span style="color:green;font-size:16px;">Thanks for Registration </span>');
                          $("#register-form")[0].reset();
                          window.location.href='index.php';
                         }
                         else if(data['reg_confirm'] == 0)
                         {
                          $('#error-user').html('<span style="color:red;font-size:16px;">Something went wrong please try again later.</span>');
                         }
                }               
            });
                
            } 
        //fields    
        
    });
});