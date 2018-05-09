<?php

    include_once("inc/dbFunctions.php");

if(!is_login()){
	header("Location:".SITE_URL);
}



	$current_user_id = current_user_id();
	$userData = get_user_data_by_id($current_user_id);


    $table='users';
	if(isset($_POST['profile-update']) &&  $_POST['profile-update']=='UPDATE'){

        $userData = get_user_data_by_id(current_user_id(),$cols='id,user_email');

		$error = array();
		$users['first_name'] = $_POST['first_name'];
		$users['last_name']  = $_POST['last_name'];
		$users['user_email']  = $_POST['user_email'];
		$users['mobile_number']  = $_POST['mobile_number'];
		$users['picture']  = $_POST['profile_picture'];

		if($users['first_name'] ==""){
			$error['first_name'] = 'Required field!';
		}
		if($users['last_name'] ==""){
			$error['last_name'] = 'Required field!';
		}
		if($users['user_email'] ==""){
			$error['user_email'] = 'Required field!';
		}
		if($users['user_email'] !=""){

			if( !is_valid_email($users['user_email']) ) {
				$error['user_email'] = 'Email is not valid!';
			}else{

				if($users['user_email'] != $userData['user_email'] ){
					if(!is_email_exist($users['user_email'])){
						$error['user_email'] = 'Email already exist!';
					}
				}

			}
		}

		if(count($error)==0){
			$table='users';
			$id = current_user_id();
			$condition_update = " where id ='$id'";
			$response = update_data($table,$users,$condition_update);
			if($response==1){

				$condition = "WHERE `id` = '$id'";
				$data = selectTableDataSingle($table,$condition);

				if(!empty($data)){
				  set_session($data);
				}
                $confirm = '<span class="success">Your profile updated.</span>.';
            }
			else{
				$confirm = '<span clas="error">Smothing wrong please try again.</span>.';
			}
		}


	}//Submit

	include_once("head.php");
    include_once("header.php");

?>

<section class="edit_profile">
		<div class="db">

			<!--CENTER SECTION-->
			<div class="db-2">
				<div class="db-2-com db-2-main">
					<h4>Edit My Profile </h4>
					<div class="db-2-main-com db2-form-pay db2-form-com">
						 <?php if(isset($confirm)){?>
							<div id="result_message"><?php echo $confirm ;?></div>
						<?php } ?>
						<form id="profile_edit_form" action="" method="post" enctype="multipart/form-data">
							<div class="row">
                            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                	<div class="form-item form-group">
                                        <div class="inputGroupContainer">
                                            <div class="input-group">
                                                <label>First name</label>

                                                <input type="text" name="first_name" value="<?php echo $firtname = isset($userData['first_name']) ? $userData['first_name'] : $_POST['first_name']?>"/>
												<span class="error"> <?php echo $firtname = isset($error['first_name']) ? $error['first_name'] : ""?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
							</div>
							<div class="row">
                            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                	<div class="form-item form-group">
                                        <div class="inputGroupContainer">
                                            <div class="input-group">
                                                <label>Last name</label>
                                                <input type="text" name="last_name" value="<?php echo $lastname = isset($userData['last_name']) ? $userData['last_name'] : $_POST['last_name']?>"/>
												<span class="error"> <?php echo $last_name = isset($error['last_name']) ? $error['last_name'] : "" ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
							</div>


                            <div class="row">
                            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                	<div class="form-item form-group">
                                        <div class="inputGroupContainer">
                                            <div class="input-group">
                                                <label>Email</label>
												<?php
													$user_email = isset($userData['user_email']) ? $userData['user_email'] : "";
													if(isset($_POST['user_email']) && $_POST['user_email']!=""){

														$user_email = $_POST['user_email'];
													}
												?>

                                                <input type="email" id="user_email" name="user_email" value="<?php echo $user_email;?>"/>
												<span class="error"> <?php echo $user_email = isset($error['user_email']) ? $error['user_email'] : "" ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
							</div>

                            <div class="row">
                            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                	<div class="form-item form-group">
                                        <div class="inputGroupContainer">
                                            <div class="input-group">
                                                <label>Phone</label>
                                                <input id="phone" type="tel" name="mobile_number" placeholder="" value="<?php echo $mobile_number = isset($userData['mobile_number']) ? $userData['mobile_number'] :  $_POST['mobile_number']?>">
												<span class="error"> <?php echo $mobile_number = isset($error['mobile_number']) ? $error['mobile_number'] : "" ?></span>
                                            </div>
                                            <small id="valid-msg" class="hide help-block" style="color: #008000;">✓ Valid</small>
                            				<small id="error-msg" class="hide help-block" style="color: #a94442;">Please enter valid number</small>
                                        </div>
                                    </div>
                                </div>
							</div>




							<div class="row">
                            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                	<div class="form-item form-group">
                                        <div class="inputGroupContainer">
                                            <div class="input-group">
                                                <label>Profile Image</label>
                                                <div class="box">
												<?php $picture = isset($userData['picture']) ? $userData['picture'] :  $_POST['profile_picture']?>
                                                    <div id="edit_pic_pre"><img src="<?php echo profile_pic_src($picture);?>"/></div>
                                                    <input type="hidden" name="profile_picture" id="profile_picture" value="<?php echo $picture;?>"/>
                                                    <input type="file" name="image_upload_file" id="image_upload_file" class="inputfile inputfile-6" />
                                                        <label for="file-7"><span></span><strong>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> Choose image</strong>
                                                        </label>
                                                <span class="profile_pic_loader"></span>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                	<div class="form-item form-group">
                                        <div class="inputGroupContainer">
                                            <div class="input-group">
                                                <input type="submit" value="UPDATE" name="profile-update" class="awe-btn full-btn">
                                            </div>
                                        </div>
                                    </div>
                                </div>
							</div>
						</form>
					</div>
				</div>
			</div>

		</div>
	</section>




<?php include_once("footer.php");?>
<!--script type="text/javascript" src="<?php echo SITE_URL; ?>/js/user-profile.js"></script-->
<script>
$(function() {


  $("#profile_edit_form").validate({
    // Specify validation rules
    rules: {

      first_name: {
        required: true,
		minlength: 2
      },
      last_name: {
        required: true,
        minlength: 2
      },
	  user_email:{
		required: true,
        email: true,
		"remote":
			{
			  url: "inc/ajax_db_functions.php",
			  url: $("#SITE_URL").val()+'/inc/ajax_db_functions.php',
			  type: "post",
			  data:
			  {
				pagetitle:$('#user_email').val(),
				userID: $('#id').val(),
				action: 'profile_update_email',
			  }
			}
	  },
	  mobile_number:{
		required: true,
	  }
    },
    // Specify validation error messages
    messages: {
		user_email:{
            remote: 'Email already exist!',
        },
    },

    submitHandler: function(form) {
		var site_url = $("#SITE_URL").val();
		var admin_url = $("#ADMIN_URL").val();

         form.submit();
	   }

    });//validate






	/**=========================  Profile Image upload =================================*/
	/**=========================  Profile Image upload =================================*/
	/**=========================  Profile Image upload =================================*/

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
	/**========================= END  Profile Image upload =================================*/



});
</script>
