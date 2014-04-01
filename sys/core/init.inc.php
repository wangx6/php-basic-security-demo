<?php
	// Create session token to prevent CRS ...
	session_start();
	if(!isset($_SESSION['token']))
	{
		$_SESSION['token'] = sha1(uniqid(mt_rand(),TRUE));
	}
	
	// incluse configuration file to extract settings ...
	include_once('../sys/config/db-cred.inc.php');
	
	// Define configurations ...
	foreach( $C as $name => $val )
	{
		define($name, $val);
	}	
	
	// Create Data base connection ...
	$db = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	
	// Check connection ...
	if (mysqli_connect_errno())
  	{
  		echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}
	
	//Escape all input ...
	function escape_data($data)
	{	
		global $db;
		$data = mysqli_real_escape_string($db,trim($data));
		$data = strip_tags($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data,ENT_QUOTES, 'utf-8');
		return $data;
	}
	
	// Encrypt password ...
	function _getSaltedHash($string, $salt=NULL){
		$_saltLength = 7;
		if ( $salt ==NULL ){
			$salt = substr(md5(time()), 0, $_saltLength);
		}
		else{
			$salt = substr($salt, 0, $_saltLength);
		}
		return $salt.sha1($salt.$string);
	}
?>