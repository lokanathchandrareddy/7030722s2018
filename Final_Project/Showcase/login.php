<?php

    include_once("inc/dbFunctions.php");


if(isset($_POST['login']) && $_POST['login'] !="" ){
    //echo "<pre>";

    $error = array();

    global $link ;
    $tbluser = "users";
    $login_email    = $_POST['loginEmail'];
    $login_password = $_POST['loginPassword'];

 if($login_email ==""){
        $error['login_email'] = 'Required field!';
    }
 if($login_password ==""){
        $error['login_password'] = 'Required field!';
    }

 if(count($error)==0){

     $login_password = md5(trim($login_password));
     $condition = "WHERE `user_email` = '$login_email' AND `user_password` = '$login_password'";
     $data = selectTableDataSingle($tbluser,$condition);



     if(!empty($data)){
         set_session($data);  //Set value in session

         $_SESSION['id'] = $data['id'];
         $_SESSION['type'] = $data['user_type'];

         $id = $data['id'];

         $condition_update = " where id ='$id'";
         $users1['updated_date'] = date('Y-m-d H:i:s');
         $users1['status'] = '1';
         $response = update_data($tbluser,$users1,$condition_update);


         $login_result = '<span class="success">Login successfully...! </span>';
         header("Location: gallery.php");
     }
     else{
         $login_return['login_confirm'] = 0;
         $login_result = '<span class="error">Invalid email and password! </span>';
     }

 }//count($error)

}
    include_once("head.php");
    include_once("header.php");

?>
    <section class="awe-parallax login-page">
        <div class="awe-overlay"></div>
        <div class="container">
            <div class="login-register-page__content">
                <div class="content-title"><span>Welcome back</span>
                    <h2>to Show Case</h2>
                </div>

                <form id="loginForm"  method="post" name="login-form" action="">
                    <div id="login_result"> <?php echo $login_result = isset($login_result) ? $login_result : ""?></div>
                    <div class="form-item form-group">
                        <div class="inputGroupContainer">
                            <div class="input-group">
                                <label>Email</label>
                                <input type="email" name="loginEmail" id="login_email" value=""/>
                            </div>
                        </div>
                    </div>
                    <div class="form-item form-group">
                        <div class="inputGroupContainer">
                            <div class="input-group">
                                <label>Password</label>
                                <input class="login-field login-field-password" id="password-log" name="loginPassword" type="password" placeholder="">
                            </div>
                        </div>
                    </div>

                    <!-- <a href="forgot-password.php" class="forgot-password">Forgot Password</a> -->
                    <div class="form-actions">
                        <!--input type="button" onclick="loginFunction()" value="Log In"-->
                        <input type="submit" id="login-btn" name="login" value="Log In">
                    </div>
                </form>
                <div class="login-register-link">Dont have account yet? <a href="register.php">Register HERE</a></div>
            </div>
        </div>
    </section>
    <div class="form-group">
        <div class="col-md-9 col-md-offset-3">
            <div id="messages"></div>
        </div>
    </div>
<?php
    include_once("footer.php");
?>
<script type="text/javascript" src="<?php echo SITE_URL; ?>/js/login.js"></script>
