<?php 
session_start();
$message="";

include("config.php");

if(count($_POST)>0)
{
	$email = $_POST['email'];
	$password = $_POST['password'];

	$dpass=mysqli_query($conn,"SELECT * FROM `login` WHERE `email` = '$email' AND `password` = PASSWORD('$password')");
	$result=mysqli_fetch_array($dpass);
	if(is_array($result))
	{
		$_SESSION["email"] = $email;
		$_SESSION["role"] = $result['role'];

	}
	else
	{
		echo "<script>
					alert('Invalid email or Password!');
					window.location = '../../';
				</script>";
	}
	if(isset($_SESSION["email"])) {
		// $_SESSION["login_time_stamp"] = time();
		if($_SESSION["role"] == "admin"){
			header("location: admin-page.php");
		}
		else
			header("location: homepage.php");
	}
}
?>