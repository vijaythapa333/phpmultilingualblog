<div class="body">
	<h2>Add User</h2>
	<?php 
		if(isset($_SESSION['edit']))
		{
			echo $_SESSION['edit'];
			unset($_SESSION['edit']);
		}

		if (isset($_GET['id']) && !empty($_GET['id'])) {
			$id = $_GET['id'];

			$tbl_name = 'tbl_users';
			$where = "id='$id'";

			$query = $obj->select_data($tbl_name,$where);
			$res = $obj->execute_query($conn,$query);
			if($res==true)
			{
				$count_rows = $obj->num_rows($res);
				if($count_rows==1)
				{
					$row = $obj->fetch_data($res);
					$full_name = $row['full_name'];
					$email = $row['email'];
					$username = $row['username'];
					$password = $row['password'];
					$is_active = $row['is_active'];
				}
			}
		}
		else
		{
			header('location:'.SITEURL.'admin/index.php?page=users');
		}
	?>
	<form method="post" action="">
		<div class="input-group">
			<span class="input-label">Full Name</span>
			<input class="half" type="text" name="full_name" value="<?php echo $full_name; ?>" required="true">
		</div>

		<div class="input-group">
			<span class="input-label">Email</span>
			<input class="half" type="email" name="email" value="<?php echo $email; ?>" required="true">
		</div>

		<div class="input-group">
			<span class="input-label">Username</span>
			<input class="half" type="text" name="username" value="<?php echo $username; ?>" required="true">
		</div>

		<div class="input-group">
			<span class="input-label">Password</span>
			<input class="half" type="password" name="password" value="<?php echo $password; ?>" required="true">
		</div>

		<div class="input-group">
			<span class="input-label">Is Active?</span>
			<input <?php if($is_active=='Yes'){echo "checked='checked'";} ?> type="radio" name="is_active" value="Yes"> Yes 
			<input <?php if($is_active=='No'){echo "checked='checked'";} ?> type="radio" name="is_active" value="No"> No
		</div>

		<div class="input-group">
			<span class="input-label">
				<input type="hidden" name="id" value="<?php echo $id; ?>">
				<input class="btn-primary btn-sm" type="submit" name="submit" value="Update User">
			</span>
		</div>
		<br>
	</form>

	<?php 
		if(isset($_POST['submit']))
		{
			$id = $_POST['id'];
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
				is_active='$is_active'
			";
			$tbl_name='tbl_users';
			$where = "id='$id'";
			$query = $obj->update_data($tbl_name,$data,$where);
			$res = $obj->execute_query($conn,$query);

			if($res==true)
			{
				$_SESSION['edit'] = "<div class='success'>User Successfully Updated.</div>";
				header('location:'.SITEURL.'admin/index.php?page=users');
			}
			else
			{
				$_SESSION['edit'] = "<div class='error'>Failed to edit User.</div>";
				header('location:'.SITEURL.'admin/index.php?page=edit_user&id='.$id);
			}
		}
	?>
</div>