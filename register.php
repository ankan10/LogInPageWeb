<?php
require 'dbconfig/config.php';
?>
<!DOCTYPE html>
<html>
<head>
<title> Registration Page</title>
<link rel= "stylesheet" href="css/style.css">
<script type="text/javascript">


</script>
</head>

<body style= "background-color:#95a5a6">

	<div id="main-wrapper">
	<center><h2>Registration Form</h2>
	
	<img src="images/loginkey.png" class= "loginkey"/>
	</center>
	<br>

	<form class="myform" action="register.php" method="post" enctype="multipart/form-data">
	<label><b>Full Name:</label><br>
	<input name="fullname" type="text" class="inputvalues" placeholder="Full Name" required/><br>
	<label><b>Username:</label><br>
	<input name="username" type="text" class="inputvalues" placeholder="Your Username" required/><br>
	<label><b>Gender:</label><br>
	<input name="gender" type="radio" class="radiobtns" value="Male" checked required/> Male 
	<input name="gender" type="radio" class="radiobtns" value="Female" required/> Female <br>
	<label><b>Qualification:</label><br>
	<select class="qualification" name="qualification" >
		<option value= "none" checked> ----- </option>
		<option value= "BscCS"> BSc CS</option>
		<option value= "BCA"> BCA</option>
		<option value= "BTechCS">BTech CS</option>		
		<option value= "BTechIT"> BTech IT</option>
	</select><br>
	<label><b>Password:</label><br>
	<input name="password" type="password" class="inputvalues" placeholder="Your Password" required/><br>
	<label><b> Confirm Password:</label><br>
	<input name= "cpassword" type="password" class="inputvalues" placeholder="Confirm Password" required/><br>
	<label><b>Upload Image:</label><br>
	<input type="file" id="imglink" name="imglink" accept=".jpg, .jpeg, .png" ;/><br>
	<input name= "submit_btn" type="submit" id="signup_btn" value="Sign Up"/><br>
	<a href= "index.php"><input type="button" id="back_btn" value="<-- Back to Log In  "/>
	
	</form>

		<?php
			if(isset($_POST['submit_btn']))
			{
				$fullname =$_POST['fullname'];
				$username = $_POST['username'];
				$password = $_POST['password'];
				$cpassword = $_POST['cpassword'];
				$gender = $_POST['gender'];
				$qualification = $_POST['qualification'];
				
				$img_name = $_FILES['imglink']['name'];
				$img_size =$_FILES['imglink']['size'];
			    $img_tmp =$_FILES['imglink']['tmp_name'];
				
				$directory = 'uploads/';
				$target_file = $directory.$img_name;
				
				if($password==$cpassword)
				{
					
					$query= "select * from userinfos WHERE username='$username'";
					$query_run= mysqli_query($con,$query);
					if(mysqli_num_rows($query_run)>0)
					{
						// there is already a user with the same username
						echo '<script type="text/javascript"> alert("User already exists.. try another username") </script>';
					}
					else if(file_exists($target_file))
					{
						echo '<script type="text/javascript"> alert("Image file already exists.. Try another image file") </script>';
					}
					
					else if($img_size>2097152)
					{
						echo '<script type="text/javascript"> alert("Image file size larger than 2 MB.. Try another image file") </script>';
					}

					else
					{
						move_uploaded_file($img_tmp,$target_file); 
						$query= "insert into userinfos values('','$username','$fullname','$gender','$qualification','$password','$target_file')";
						$query_run = mysqli_query($con,$query);
						if($query_run)
						{
							$_SESSION['fullname']= $fullname;
							echo '<script type="text/javascript">alert("User Registered.. Go To Log In Page")</script>';
							
						}
						else
						{
							echo '<script type="text/javascript"> alert("Error!") </script>';
						}
					}
				}
				
				else
				{
					echo '<script type="text/javascript">alert("Password and Confirm Password does not match")</script>';
				}
			}
				
		?>


</div>
</body>
</html>