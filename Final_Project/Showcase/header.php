<?php
include_once("inc/dbFunctions.php");
if(is_login()){
 $list = '<li><a href="logout.php">Logout</a></li>';
 $user_id = $_SESSION['id'];
 global $link ;
 $tbluser = "users";
 $condition = "WHERE `id` = '$user_id'";
 $data = selectTableDataSingle($tbluser,$condition);
 if(!empty($data))
 {
  $status = $data['status'];
  $_SESSION['type'] = $data['user_type'];
 }
}
?>
<body>

<div class="loader" id="loader" style="display:none;"></div>
<input type="hidden" id="SITE_URL" value="<?php echo SITE_URL;?>" />
<input type="hidden" id="ADMIN_URL" value="<?php echo ADMIN_URL;?>" />
<!--<![endif]-->
<div id="page-wrap">
    <div class="preloader-"></div>
    <header id="header-page">
        <!-- <div class="header-top">
            <div class="container">
                <div class="pull-left">
                        <div class="contant-sec">

                        </div>
                    </div>
                <div class="pull-right">
                    <div class="contant-sec">



                    </div>
                </div>
            </div>
        </div> -->
        <div class="header-page__inner">
            <div class="container">
              //logo
                <div class="logo"> <a href=""> <img src="images/Camera.png" alt=""> </a> </div>
                <nav class="navigation awe-navigation" data-responsive="1200">
                <?php
                 if(is_login())
                 {
                  ?>
                    <ul class="menu-list carvik">
                        <li class="menu-item-has-children current-menu-parent"> <a href="index.php">Home</a> </li>
                        <li class="menu-item-has-children"> <a href="profile.php">Profile</a></li>
                        <li><a class="login-link viksha dropdown-toggle">Gallery<span class="caret"></span></a>
                          <ul class="dropdown-menu" aria-labelledby="dropdownMenu">
                                <li><a href="gallery.php">Public Gallery</a></li>
                                <li><a href="private-gallery.php">Private Gallery</a></li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children"> <a href="upload_gallery.php">Upload</a></li>
                        <li class="menu-item-has-children"> <a href="logout.php">Logout</a></li>


                    </ul>

                  <?php
                 }
                 else
                 {
                  ?>
                    <ul class="menu-list">
                        <li class="menu-item-has-children current-menu-parent"> <a href="index.php">Home</a> </li>
                        <li class="menu-item-has-children current-menu-parent"> <a href="login.php">Login</a> </li>
                        <li class="menu-item-has-children current-menu-parent"> <a href="register.php">Register</a> </li>

                    </ul>
                  <?php
                 }
                ?>

                </nav>

                 </div>
        </div>
    </header>
