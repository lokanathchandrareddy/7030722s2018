<?php 
include_once("inc/config.php");
unset($_SESSION['id']);
session_destroy();
header("Location:".SITE_URL);
exit;
?>