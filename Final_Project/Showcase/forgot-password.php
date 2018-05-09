<?php

    include_once("inc/dbFunctions.php");
    include_once("head.php");
    include_once("header.php");

if(is_login()){
	header("Location:".SITE_URL);
}
?>
    <section class="awe-parallax login-page">
        <div class="awe-overlay"></div>
        <div class="container">
            <div class="login-register-page__content">
                <div class="content-title">
                    <h2>Forgot Password!</h2>
                </div>

                <form id="forgotForm"  method="post" name="forgotForm" action="">
                    <div id="forgot_result"></div>
                    <div class="form-item form-group">
                        <div class="inputGroupContainer">
                            <div class="input-group">
                               	<label>Email</label>
                        		<input type="email" name="user_email" id="user_email" value=""/>
                            </div>
                        </div>
                    </div>


                    <div class="form-actions">
                        <!--input type="button" onclick="loginFunction()" value="Log In"-->
                        <input type="submit" id="login-btn" name="Submit" value="Submit">
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
<script type="text/javascript" src="<?php echo SITE_URL; ?>/js/forgot-password.js"></script>
