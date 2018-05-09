<?php
require_once('config.php');
require_once('dbFunctions.php');

/****Register Function call by ajax**********/

if(isset($_POST['action']) && $_POST['action']=='register_form'){
    global $link ;
   $table='users';
   $users['first_name'] = $_POST['first_name'];
   $users['last_name']  =  $_POST['last_name'];
   $users['user_email'] =  $_POST['email'];
   $users['picture']    =  'user_avater.png';
   $users['user_password']   =  md5($_POST['password_reg']);

  
    $response = insert_data($table,$users);    
    if($response == 1)
     {
      $return['reg_confirm'] = 1; 
     } 

    else
    {
     $return['reg_confirm'] = 0; 
    }    
         
     echo json_encode($return);
     die();
 }
 
 
/****Login Function call by ajax**********/

 if(isset($_POST['action']) && $_POST['action']=='login_form'){
    global $link ;
    $tbluser = "users";
    $login_email = $_POST['login_email'];
    $login_password = md5($_POST['login_password']);

    $condition = "WHERE `user_email` = '$login_email' AND `user_password` = '$login_password'";
    $data = selectTableDataSingle($tbluser,$condition);
  
    if(!empty($data))
    {
    set_session($data);  //Set value in session 
      $login_return['login_confirm'] = 1;
    }
    else
    {
      $login_return['login_confirm'] = 0;
    }

     echo json_encode($login_return);
     die();
 }
 
 
 /************************************ User Email Exist*************************************/
 function is_useremail_exist($email){
    $table='users';
    $condition = ' where user_email="'.$email.'"';
    $result = selectTableDataSingle($table,$condition,$cols="*");
    if(!empty($result)){
      return false;
    }else{
       return true;
    }
   
 } 
 
 
 if(isset($_POST['user_email']) && $_POST['action'] =="register"){
  
  $isAvailable  = is_useremail_exist($_POST['user_email']);  
  // Finally, return a JSON
  echo json_encode(array(
    'valid' => $isAvailable,
  ));
  die();
}
/**************************** 
 Check email in update Profile
 Call By ajax
 Return: true,false;
************************************************/



 if(isset($_POST['user_email']) && $_POST['action'] =="profile_update_email"){
     
  current_user_id();
    $userData = get_user_data_by_id(current_user_id(),$cols='id,user_email');
   
  if($_POST['user_email'] == $userData['user_email'] ){
    
    $isAvailable = 'true';
  }else{
    
    $isAvailable  = is_useremail_exist($_POST['user_email']); 
    if($isAvailable){
         $isAvailable = 'true';
    }else{
        $isAvailable = 'false';
    }       
  }
  echo $isAvailable;
 
  die();
}



/************************************** Fogot Password********************************/

 if(isset($_POST['action']) && $_POST['action']=='forgot_password'){
    global $link ;
    $tbluser = "users";
    $login_email = $_POST['login_email'];
    $condition = "WHERE `user_email` = '$login_email'";
    $userData = selectTableDataSingle($tbluser,$condition,$cols="id,first_name,last_name");
  
    if(!empty($userData))
    {
        $table='users';
        $hash =   time();       
        $data['hash'] =  $hash;
        $data['change_pwd_request'] =  1;
        
        $id = $userData['id'];
        $condition_update = " where id ='$id'";
        update_data($table,$data,$condition_update);
        
        
        
        
        $to      = $login_email;
        $subject = 'Change Password';       
          
        $password_chgelink = SITE_URL.'/change-password.php?hash='.$hash.'&id='.$id.'&action=confirm';
            
        
        $message  = 'Hi,' .'<br><br>';
        $message .= 'Please click on below link to reset password,' .'<br><br>';
        $message .=  $password_chgelink .'<br><br>';
        $message .=  'Thanks<br><br>';
        
        
        
        $responce = send_email($to,$from='webmaster@example.com',$subject,$message,$header='html');
        if($responce==1){   
            $return['confirm'] = 1;
        }else{
            $return['confirm'] = 2;
        } 
        
    }
    else
    {
      $return['confirm'] = 0;
    }

     echo json_encode($return);
     die();
 }
 
 
 
 /************************* Password Reset **********/
 
 
 if(isset($_POST['action']) && $_POST['action'] == "reset-confirm" ){
   $user_re_password =  md5($_POST['user_re_password']);
   $user_id =  $_POST['user_id'];
   $table = 'users';
    $condition_update = "where `id`='$user_id'";
    $data['user_password'] = $user_re_password;
    $updated_record = update_data($table,$data,$condition_update);
    if($updated_record == 1)
    {
        $return['reset-password'] = 1;
    }
    else
    {
        $return['reset-password'] = 0;
    }
   
   
    echo json_encode($return);
     die();

    
    
    
}

/*======================= Delete Image  =================================*/

if(isset($_POST['action']) && $_POST['action']=='delete_image'){
  
  $imageid = $_POST['imageid'];

  $table = 'tbl_gallery';
  $condition = " where id='".$imageid."'";
  
  $status = deleteRow($table,$condition);
  if($status){
    $return['confirm'] = 1;
    $return['id'] = $imageid;
  }else{
    $return['confirm'] = 0;
  }
  echo json_encode($return);
  die();
}



?>