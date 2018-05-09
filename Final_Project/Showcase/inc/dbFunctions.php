<?php
require_once('config.php');

/**************** Insert Data into table****************************************/
	function insert_data($table,$val_array)
	{

		global $link;
		$keys	= array_keys($val_array);
		$value	= array_values($val_array);

		$arr	= array();
		foreach($value as $v)
		{
			$arr[]= mysqli_real_escape_string($link,trim($v));
		}
		 $fields	= implode(",",$keys);

		 $values	= "('".implode("','",$arr)."')";

		$SQL 		= "INSERT INTO ".$table." (".$fields.") values ".$values;
		$MYSQL		= mysqli_query($link,$SQL) or die($SQL);
		return $MYSQL;
	}


/**** ********************** rretun total num rows *********************************/
	function totalNumRows($table,$condition=null,$cols="*")
	{
		global $link;
	 	$SQL		= "SELECT ".$cols." FROM ".$table." ".$condition;
	    $MYSQL		= mysqli_query($link,$SQL) or die($SQL);
	    $countRow   = mysqli_num_rows($MYSQL);


		return $countRow;

	}

/***************************** Retun table single row *****************************/

	function selectTableDataSingle($table,$condition,$cols="*")
	{
		global $link;

		$SQL		="SELECT ".$cols." FROM ".$table." ".$condition;
	    $MYSQL		= mysqli_query($link,$SQL) or die($SQL);
		if(mysqli_num_rows($MYSQL) > 0){
			$row = mysqli_fetch_assoc($MYSQL);
			return $row;
		}else{
			return '';
		}
	}


/***************************** Retun table row***************/
function selectTableRows($table,$condition=null,$cols="*")
	{
		global $link;
		$SQL		="SELECT ".$cols." FROM ".$table." ".$condition;
		$MYSQL		= mysqli_query($link,$SQL) or die($SQL);
		$arr=array();
		while($row=mysqli_fetch_array($MYSQL))
		{
			$arr[]=$row;
		}
		return $arr;
	}

/***************************** Retun table row By limit***************/
function selectTableRowsLimit($table,$condition=null,$cols="*",$limit='')
	{
		global $link;
		$SQL		="SELECT ".$cols." FROM ".$table." ".$condition;
		if($limit !=""){
			$SQL = $SQL.' '.$limit;
		}

		$MYSQL		= mysqli_query($link,$SQL) or die($SQL);
		$arr=array();
		while($row=mysqli_fetch_array($MYSQL))
		{
			$arr[]=$row;
		}
		return $arr;
	}

/***************************************** DELETE FUNCTION***************************/
	function deleteRow($table,$condition)
	{
		global $link;
		if($condition !=""){
			$SQL		="DELETE  FROM ".$table." ".$condition;
			$MYSQL		= mysqli_query($link,$SQL) or die($SQL);
			return $MYSQL;
		}

	}


/***************************************** UPDATE FUNCTION***************************/

  function update_data($table,$data,$condition)
	{
		global $link;

		$i=0;
		foreach( $data as $field_name => $field_value )
		{
			/*
			if($i==0)
			{
				 $condition = $field_name." = ". $field_value;
				$i++;
				continue;
			}*/
			if($field_value != 'NULL' )
				$field_updates[] = "$field_name = '".addslashes($field_value)."'";
			else
				$field_updates[] = "$field_name = NULL ";


		}

        $SQL  	= "UPDATE $table SET " .  implode( ", ", $field_updates ) . "  ".$condition;
		$MYSQL	= mysqli_query($link,$SQL) or die($MYSQL);
		return $MYSQL;
	}



/******************************* Email is valid********************************/
function is_valid_email($email) {
    return !!filter_var($email, FILTER_VALIDATE_EMAIL);
}

 /************************************ User Email Exist*************************************/
 function is_email_exist($email){
    $table='users';
    $condition = ' where user_email="'.$email.'"';
    $result = selectTableDataSingle($table,$condition,$cols="*");
    if(!empty($result)){
      return false;
    }else{
       return true;
    }

 }



 /**
 * get_user_by_id
 * what the function does
 *	Will return user By id
 *
 * Parameters:
 *     (id) - about this param
 * Retun type: array()
 *
 */


 function get_user_by_id($id){
	$table='users';
	$condition = ' where id="'.$id.'"';
	$result = selectTableDataSingle($table,$condition,$cols="*");
	if(!empty($result)){
	  return $result;
	}else{
	   return "";
	}
 }

/**
* set_session
* Set key and value in array
* param 1 as array
*/

function set_session($data=null){
	if(is_array($data)){
		foreach($data as $key => $value){
			if(!empty($key)){
			   $_SESSION[$key] = $value;
			}
		}
	}
}


/**
* is_admin
* Retun true or false
* param 0
*/
function is_admin() {
    if(isset($_SESSION['user_type']) && $_SESSION['user_type'] =='admin'){
		return true;
	}else{
		return false;
	}
}

/**
* is_user
* Retun true or false
* param 0
*/
function is_user() {
    if(isset($_SESSION['user_type']) && $_SESSION['user_type'] =='user'){
		return true;
	}else{
		return false;
	}
}


/**
* current_user_id
* Retun id
* param 0
*/
function current_user_id() {
    if(isset($_SESSION['id']) && $_SESSION['id'] >0){
		return $_SESSION['id'];
	}else{
		return false;
	}
}

/**
* is_login
* Retun true or false
* param 0
*/
function is_login() {
    if(isset($_SESSION['id']) && $_SESSION['id'] >0){
		return true;
	}else{
		return false;
	}
}


/**
* profile_pic_src
* Retun true or false
* param 0
*/
function profile_pic_src($name) {
	if($name !=""){
		return  UPLOAD_MEDIUM_URL.'/'.$name;
	}else{
		return "";
	}
}
/**
* profileImgByName
* Retun img
* param 0
*/
function profileImgByName($filename,$type=null) {
	if($filename !=""){
		$path = UPLOAD_URL.'/';
		if($type =='medium'){
			return '<img src="'.UPLOAD_MEDIUM_URL.'/'.$filename. '"/>';
		}else{
			return '<img src="'.UPLOAD_URL.'/'.$filename. '"/>';
		}

	}else{
		return "";
	}
}
function getImageByName($filename,$type=null) {
	if($filename !=""){
		$path = UPLOAD_URL.'/';
		if($type =='medium'){
			return '<img src="'.UPLOAD_MEDIUM_URL.'/'.$filename. '"/>';
		}else{
			return '<img src="'.UPLOAD_URL.'/'.$filename. '"/>';
		}

	}else{
		return "";
	}
}




  /********************************************************************************
* get_setting
* Retun array
* param 1 (id)
*/
function get_user_data_by_id($id,$cols='*'){

	if(!empty($id)){
		$tbl = "users";
		$condition = "WHERE `id` = '$id'";
		$data = selectTableDataSingle($tbl,$condition,$cols);

		if(!empty($data))
		{
		  return $data;
		}
		else
		{
			return "";
		}
	}
 }


/*************************************** Send Email *********************************/
function send_email($to,$from='photogallery@test.com',$subject,$message,$header=""){	
	$boundary = md5( uniqid() . microtime() );
	$headers = "MIME-Version: 1.0" . "\r\n";


	if($header =='html'){
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	}else{
		$headers .= "Content-Type: text/plain; charset=\"utf-8\"\r\n";
	}
	//$headers .= "Content-Type: multipart/alternative; boundary=\"$boundary\"\r\n\r\n";

	// More headers
	$headers .= 'From: <'.$from.'>' . "\r\n";

	$response = mail($to,$subject,$message,$headers);
	if($response){
		return 1;
	}else{
		return 0;
	}

}


/******************************************* *************************************************/
/********************** Password Incrypttion *************************************************/
/******************************************** *************************************************/

function passwordEncryption($pwd){
	$pwd = trim($pwd);
	$pwd_md5 = md5($pwd);
	return $pwd_md5;
}



//******************************************** Fetch all small images****/

 function gallery_pic_smallsrc($name) {
     if($name !=""){
		return  UPLOAD_SMALL_URL.'/'.$name;
     }else{
       return "";
    }
 }

 //******************************************** Fetch all large images****/
 function gallery_pic_mediumsrc($name) {
    if($name !=""){
		return  UPLOAD_MEDIUM_URL.'/'.$name;
    }else{
       return "";
    }
 }

?>
