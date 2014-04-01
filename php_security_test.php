<?php include_once('../sys/core/init.inc.php'); ?>
<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>PHP example code</title>
    </head>
    <body>

	
    
    <?php
		if($_GET){
			//$username = escape_data($_GET['username']);
			//$password = escape_data($_GET['password']);
			
			$username = $_GET['username'];
			$password = $_GET['password'];
			echo $username;
			
			if(!empty($username) && !empty($password)){
				$password = _getSaltedHash($password);
				$sql="INSERT INTO register (id ,username, password) VALUES ('','$username','$password')";
				if (!mysqli_query($db,$sql))
				{
					die(error_ms());
				}
				echo "Thank you for register.";
				mysqli_close($db);
			}else
			error_ms();
		}else
		echo '
		<form action="php_security_test.php" method="get">
			<label>User Name</label>
			
			<label>Password</label>
			<input type="password" name="password"/><br>
			<input type="submit" value="Submit"/>
			<input type="hidden" name="token" value="'.$_SESSION['token'].'"
    	</form>';
		
		function error_ms(){
			echo '<span>Please Enter the Valid Input.</span>';
		}
	?>
    
	</body>
</html>