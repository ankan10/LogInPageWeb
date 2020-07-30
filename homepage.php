<?php
	session_start();
	require 'dbconfig/config.php';
?>
<!DOCTYPE html>
<html>
<head>
<title> Home Page</title>
<link rel= "stylesheet" href="css/style.css">
</head>
<body style= "background-color:#bdc3c7">

	<div id="main-wrapper">
	<center><h2>Home Page</h2>
	<h3> Welcome 
	<?php echo $_SESSION['fullname']?>
	</h3>
	<?php echo '<img class="loginkey" src= "'.$_SESSION["imglink"].'">' ?> 
	<br>
	

	<form class="myform" action="homepage.php" method="post">

	<input name= "logout" type="submit" id="logout_btn" value="Log Out"/><br>
</center>
</form>

	<?php
	if(isset($_POST['logout'])){
	
	header( "Location: index.php");
	session_destroy();
	}
	?>
</div>
</body>
</html>