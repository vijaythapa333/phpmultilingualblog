<div class="body">
	<h2><?php echo $lang['add_user'] ?></h2>
	<?php 
		if(isset($_SESSION['add']))
		{
			echo $_SESSION['add'];
			unset($_SESSION['add']);
		}
	?>
	<form method="post" action="">
		<div class="input-group">
			<span class="input-label"><?php echo $lang['full_name'] ?></span>
			<input class="half" type="text" name="full_name" placeholder="Your Full Name." required="true">
		</div>

		<div class="input-group">
			<span class="input-label"><?php echo $lang['email'] ?></span>
			<input class="half" type="email" name="email" placeholder="Your Email." required="true">
		</div>

		<div class="input-group">
			<span class="input-label"><?php echo $lang['username'] ?></span>
			<input class="half" type="text" name="username" placeholder="Your Username" required="true">
		</div>

		<div class="input-group">
			<span class="input-label"><?php echo $lang['password'] ?></span>
			<input class="half" type="password" name="password" placeholder="Youre Secure Password" required="true">
		</div>

		<div class="input-group">
			<span class="input-label"><?php echo $lang['is_active'] ?></span>
			<input type="radio" name="is_active" value="Yes"> <?php echo $lang['yes'] ?> 
			<input type="radio" name="is_active" value="No"> <?php echo $lang['no'] ?>
		</div>

		<div class="input-group">
			<span class="input-label">
				<input class="btn-primary btn-sm" type="submit" name="submit" value="<?php echo $lang['add_user'] ?>">
			</span>
		</div>
		<br>
	</form>

	<?php 
		if(isset($_POST['submit']))
		{
			$full_name = $obj->sanitize($conn,$_POST['full_name']);
			$email = $obj->sanitize($conn,$_POST['email']);
			$username = $obj->sanitize($conn,$_POST['username']);
			$password = md5($obj->sanitize($conn,$_POST['password']));
			$is_active = $_POST['is_active'];
			$created_at = date('Y-m-d H:i:s');

			$data = "
				full_name='$full_name',
				email='$email',
				username='$username',
				password='$password',
				is_active='$is_active',
				created_at='$created_at'
			";
			$tbl_name='tbl_users';

			$query = $obj->insert_data($tbl_name,$data);
			$res = $obj->execute_query($conn,$query);

			if($res==true)
			{
				$_SESSION['add'] = "<div class='success'>".$lang['add_success']."</div>";
				header('location:'.SITEURL.'admin/index.php?page=users');
			}
			else
			{
				$_SESSION['add'] = "<div class='error'>".$lang['add_fail']."</div>";
				header('location:'.SITEURL.'admin/index.php?page=add_user');
			}
		}
	?>
</div>