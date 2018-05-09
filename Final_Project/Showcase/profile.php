<?php

    include_once("inc/dbFunctions.php");
  
if(!is_login()){
	header("Location:".SITE_URL);
}
    include_once("head.php");
    include_once("header.php");

	$current_user_id = current_user_id();
?>
<section class="profile.php">
    <div class="profilvik db">
        <!--LEFT SECTION-->
        <!--LEFT SECTION-->
        <div class="db-l">
            <div class="db-l-1">
               <ul>
                    <?php $picture =  isset($_SESSION['picture']) ? $_SESSION['picture'] : "";?>
                    <li><img src="<?php echo profile_pic_src($picture);?>" alt="">
                    </li>
                    <li class="firstUpper">
						<?php $fname =   isset($_SESSION['first_name']) ? $_SESSION['first_name'] : "";

						  $lname = isset($_SESSION['last_name']) ? $_SESSION['last_name'] : "";

						  echo $fname.' '.$lname;
						?>

					</li>

                </ul>
            </div>
            <div class="db-l-2--">

            </div>
        </div>
        <!--CENTER SECTION-->
        <div class="db-2">

            <div class="db-2-com db-2-main">
                <h4>My Profile</h4>
                <div class="db-2-main-com db-2-main-com-table">
                    <table class="responsive-table">
                        <tbody>
                            <tr>
                                <td>First name</td>
                                <td>:</td>
                                <td class="firstUpper">
								<?php echo  isset($_SESSION['first_name']) ? $_SESSION['first_name'] : "";?>

								</td>
                            </tr>
                            <tr>
                                <td>Last name</td>
                                <td>:</td>
                                <td class="firstUpper"><?php echo  isset($_SESSION['last_name']) ? $_SESSION['last_name'] : "";?> </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td><?php echo  isset($_SESSION['user_email']) ? $_SESSION['user_email'] : "";?> </td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>:</td>
                                <td><?php echo  isset($_SESSION['mobile_number']) ? $_SESSION['mobile_number'] : "";?> </td>
                            </tr>


                        </tbody>
                    </table>
                    <div class="db-mak-pay-bot">

                        <a href="<?php echo SITE_URL; ?>/profile-edit.php?uid=<?php echo $current_user_id;?>&action=edit-user" class="awe-btn btn-large">Edit my profile</a> </div>
                </div>
            </div>
        </div>
        <!--RIGHT SECTION-->
        <div class="db-3">

        </div>
    </div>
</section>


<?php
    include_once("footer.php");
?>
