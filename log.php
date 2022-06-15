
<?php
require_once 'database.php';
session_start();
if (isset($_POST['login'])) {
	$user = $_POST['userid'];


	$query = mysqli_query($con, "SELECT * FROM `users` WHERE `userid` = '$user' ") or die("Connection failed: " . mysqli_connect_error());
	$fetch = mysqli_fetch_array($query);
	$row = mysqli_num_rows($query);

	if ($row > 0) {
		$_SESSION['userid'] = $fetch['userid'];

		echo "<script>alert('Login Successfully!')</script>";
		echo "<script>window.location='home.php'</script>";
	} else {
		header("Location: login.php?error=Invalid username and password");
	}
}

?>