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
			$username = $_GET['username'];
			$password = $_GET['password'];
			$sql="INSERT INTO register (id ,username, password) VALUES ('','$username','$password')";
				if (!mysqli_query($db,$sql))
				{
					die(error_ms());
				}
				echo "Thank you for register.";
				mysqli_close($db);
		}else
		echo '
		<form action="php_security.php" method="get"> 
			<label>User Name</label>
			<input type="text" name="username" maxlength="10"/><br>
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