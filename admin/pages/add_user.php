<div class="body">
	<h2>Add User</h2>
	<?php 
		if(isset($_SESSION['add']))
		{
			echo $_SESSION['add'];
			unset($_SESSION['add']);
		}
	?>
	<form method="post" action="">
		<div class="input-group">
			<span class="input-label">Full Name</span>
			<input class="half" type="text" name="full_name" placeholder="Your Full Name." required="true">
		</div>

		<div class="input-group">
			<span class="input-label">Email</span>
			<input class="half" type="email" name="email" placeholder="Your Email." required="true">
		</div>

		<div class="input-group">
			<span class="input-label">Username</span>
			<input class="half" type="text" name="username" placeholder="Your Username" required="true">
		</div>

		<div class="input-group">
			<span class="input-label">Password</span>
			<input class="half" type="password" name="password" placeholder="Youre Secure Password" required="true">
		</div>

		<div class="input-group">
			<span class="input-label">Is Active?</span>
			<input type="radio" name="is_active" value="Yes"> Yes 
			<input type="radio" name="is_active" value="No"> No
		</div>

		<div class="input-group">
			<span class="input-label">
				<input class="btn-primary btn-sm" type="submit" name="submit" value="Add User">
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
				$_SESSION['add'] = "<div class='success'>User Successfully Added.</div>";
				header('location:'.SITEURL.'admin/index.php?page=users');
			}
			else
			{
				$_SESSION['add'] = "<div class='error'>Failed to Add New User.</div>";
				header('location:'.SITEURL.'admin/index.php?page=add_user');
			}
		}
	?>
</div>