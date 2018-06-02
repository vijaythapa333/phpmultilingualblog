<?php 
	include('../languages/lang_config.php');
	include('config/apply.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login - MLB Website</title>

	<link rel="stylesheet" type="text/css" href="<?php echo SITEURL; ?>assets/css/style.css">
</head>
<body>
	<div class="login">
		<h1>Login Here</h1>
		<br>
		<?php 
			if(isset($_SESSION['login']))
			{
				echo $_SESSION['login'];
				unset($_SESSION['login']);
			}
		?>
		<form method="post" action="">
			<div class="title">Username</div>
			<input class="full" type="text" name="username" placeholder="Username" required="true">
			<br>
			<div class="title">Password</div>
			<input class="full" type="password" name="password" placeholder="Password" required="true">
			<br>
			<br>
			<input class="btn-success btn-md full" type="submit" name="submit" value="Login">
		</form>

		<?php 
			if(isset($_POST['submit']))
			{
				//echo "Click";
				$username = $obj->sanitize($conn,$_POST['username']);
				$password = md5($obj->sanitize($conn,$_POST['password']));

				$tbl_name = "tbl_users";
				$where = "username='$username' && password='$password'";

				$query = $obj->select_data($tbl_name,$where);
				$res = $obj->execute_query($conn,$query);
				$count_rows = $obj->num_rows($res);
				if($count_rows>0)
				{
					$_SESSION['login'] = "<div class='success'>Login Successful.</div>";
					$_SESSION['user'] = $username;
					header('location:'.SITEURL.'admin/');
				}
				else
				{
					$_SESSION['login'] = "<div class='error'>Login Failed.</div>";
					header('location:'.SITEURL.'admin/login.php');
				}
			}
		?>
	</div>
</body>
</html>