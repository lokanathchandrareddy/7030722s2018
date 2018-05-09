<?php session_start();

error_reporting(0);
ob_start();

global $link ;




$defalt_title = "Photo Gallery";
/*need to change the below lines when we upload it on the server */
/* provide the root path and database name correctly */
define('DB_DRIVER', 'mysql');
define('DB_SERVER', 'localhost');
define('DB_SERVER_USERNAME', 'root');
define('DB_SERVER_PASSWORD', '');
define('DB_DATABASE', 'photo-gallery-new');

define("DOCUMENT_ROOT",$_SERVER["DOCUMENT_ROOT"]);
define("SITE_URL",'http://localhost/Showcase');

define("ADMIN_URL", SITE_URL."/admin");
define("IMAGE_URL", SITE_URL."/images");
define("UPLOAD_MEDIUM_URL",SITE_URL."/uploads/medium");
define("UPLOAD_SMALL_URL",SITE_URL."/uploads");


$link = mysqli_connect("localhost", DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE) or die('database not connected');
if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}



$dboptions = array(
    PDO::ATTR_PERSISTENT => FALSE,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);
try {
  $DB = new PDO(DB_DRIVER . ':host=' . DB_SERVER . ';dbname=' . DB_DATABASE, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, $dboptions);
} catch (Exception $ex) {
  echo $ex->getMessage();
  die;
}






?>
