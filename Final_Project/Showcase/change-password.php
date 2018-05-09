<?php

    include_once("inc/dbFunctions.php");
    /*  ------------ Remove coment and edit for SEO of this page -------------- */

    /*  /// Remove this line
    $PageTitle= $defalt_title." | "."Home";
    $MetaAuthor = "";
    $MetaKeywords ="";
    $MetaDescription="";
    $Language="";
    $Googlebot="";
    $Robots="";
    $Copyright="";
    */  /// Remove this line

    /*  ------------ end SEO of this page -------------- */


    include_once("head.php");
    include_once("header.php");
    $userid = $_GET['id'];

?>
    <section class="awe-parallax login-page">
        <div class="awe-overlay"></div>
        <div class="container">
            <div class="login-register-page__content">
                <div class="content-title">
                    <h2>Reset password!</h2>
                </div>

                <form id="resetPwd_frm"  method="post" name="resetpwd_form" action="">
                    <div id="result_message"><?php echo $message = isset($message) ? $message : "" ?></div>
                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $userid; ?>">
					<div class="form-item form-group">
                        <div class="inputGroupContainer">
                            <h4 id="password-changed"></h4>
                            <div class="input-group">
                                <label>Password</label>
                                <input class="login-field login-field-password form-horizontal" id="password-reg" type="password" placeholder="" name="user_password">

                                <span class="error"> <?php echo $user_password = isset($error['user_password']) ? $error['user_password'] : "" ?></span>
                            </div>
                        </div>
                    </div>


                    <div class="form-item form-group">
                        <div class="inputGroupContainer">
                            <div class="input-group">
                                <label>Confirm password</label>
                                <input class="login-field login-field-password form-horizontal" id="password-reg-re" type="password" placeholder="" name="user_re_password">

                                <span class="error"> <?php echo $user_re_password = isset($error['user_re_password']) ? $error['user_re_password'] : "" ?></span>
                            </div>
                        </div>
                    </div>
                    <a href="login.php" class="forgot-password">Login</a>
                    <div class="form-actions">
                        <input type="hidden" id="user_id" name="user_id" value="<?php echo  isset($_GET['id']) ? $_GET['id'] : "" ?>"/>
                        <input type="hidden" id="hash" name="hash" value="<?php echo  isset($_GET['hash']) ? $_GET['hash'] : "" ?>"/>
                        <input type="hidden" id="action" name="action" value="<?php echo  isset($_GET['action']) ? $_GET['action'] : "" ?>"/>
                        <input type="submit" id="reset-btn" name="reset_btn" value="Reset">
                    </div>
                </form>
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
<!-- <script type="text/javascript" src=""></script> -->
