<?php
	session_start();
	require 'dbconfig/config.php';
?>
<!DOCTYPE html>
<html>
<head>
<title> Login Page</title>
<link rel= "stylesheet" href="css/style.css">
</head>

<body style= "background-color:#bdc3c7">

	<div id="main-wrapper">
	<center><h2>Log In Form</h2>
	
	<img src="images/loginkey.png" class= "loginkey"/>
	</center>
	<br>

	<form class="myform" action="index.php" method="post">
	<label><b>Username:</label><br>
	<input name= "username" type="text" class="inputvalues" placeholder="Type Your Username" required/><br>
	<label><b>Password:</label><br>
	<input name= "password" type="password" class="inputvalues" placeholder="Type Your Password" required/><br>
	<input name="login" type="submit" id="login_btn" value="Log In"/><br>
	<a href= "register.php"><input type="button" id="register_btn" value="Register"/>
	
</form>

		<?php
			if(isset($_POST['login']))
			{
				$username=$_POST['username'];
				$password=$_POST['password'];

				$query = "select * from userinfos WHERE username='$username' AND password='$password'";
				//echo $query;
				
				$query_run=mysqli_query($con,$query);
				//echo mysql_num_rows($query_run);

					if(mysqli_num_rows($query_run)>0)
					{
						$row= mysqli_fetch_assoc($query_run);
					$_SESSION['username'] = $username;
					$_SESSION['imglink'] = $row['imglink'];
					$_SESSION['fullname']= $row['fullname'];
					header( "location: homepage.php");
					}
					else
					{
						echo '<script type="text/javascript">alert("No such User exists. Invalid Credentials")</script>';
					}
				}

			
			
		?>
</div>
</body>
</html>