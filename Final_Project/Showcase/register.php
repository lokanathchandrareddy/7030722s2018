<?php
   include_once("inc/dbFunctions.php");
   include_once("head.php");
   include_once("header.php");

?>


    <section class="awe-parallax register-page">
        <div class="awe-overlay"></div>
        <div class="container">
            <div class="login-register-page__content">
                <div class="content-title"><span>Don't wipe away moments, lets ShowCase it.</span>
                    <h2>JOIN US !</h2>
                </div>
                <form id="register-form" class="" method="post" action="">
                  <span id="error-user"></span>
                    <div id="register_result"></div>
					<div class="form-item form-group">
                        <div class="inputGroupContainer">
                            <div class="input-group">
                                <label>First Name</label>
                                <input placeholder="First Name" class="form-horizontal" id="signup-user-first-name" type="text" name="first_name" value="<?php echo $firtname;?>">
                                <span class="error"></span>
                            </div>
                        </div>
                    </div>

					<div class="form-item form-group">
                        <div class="inputGroupContainer">
                            <div class="input-group">
                                <label>Last Name</label>
                                <input placeholder="Last Name" class="form-horizontal" id="signup-user-last-name" type="text" name="last_name">
                                <span class="error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-item form-group">
                        <div class="inputGroupContainer">
                            <div class="input-group">
                                <label>Email</label>
                                <input type="email" name="user_email" id="email" class="form-horizontal">
                                <span class="error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-item form-group">
                        <div class="inputGroupContainer">
                            <div class="input-group">
                                <label>Password</label>
                                <input class="login-field login-field-password form-horizontal" id="password-reg" type="password" placeholder="" name="user_password">
                                <span class="error"></span>
                            </div>
                        </div>
                    </div>


                    <div class="form-item form-group">
                        <div class="inputGroupContainer">
                            <div class="input-group">
                                <label>Confirm password</label>
                                <input class="login-field login-field-password form-horizontal" id="password-reg-re" type="password" placeholder="" name="user_re_password">

                                <span class="error"></span>
                            </div>
                        </div>
                    </div>

                    <!--captchaMessage-->

                    <a href="#" class="terms-conditions">By registering, you accept terms &amp; conditions</a>

                    <div class="form-actions">
                        <input type="hidden" name="action" value="register_form"/>
                        <input type="hidden" name="user_type" value="user"/>
                        <input type="submit"  name="register" value="Register">
                    </div>
                    <div class="divider"></div>
                </form>
                <div class="login-register-link">Already have Account? <a href="login.php">Log in here</a></div>
            </div>
        </div>
    </section>
<?php
    include_once("footer.php");
?>
 <script type="text/javascript" src="<?php echo SITE_URL; ?>/js/register.js"></script>
