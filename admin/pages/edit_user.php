<div class="body">
	<h2><?php echo $lang['edit_user'] ?></h2>
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
			<span class="input-label"><?php echo $lang['full_name'] ?></span>
			<input class="half" type="text" name="full_name" value="<?php echo $full_name; ?>" required="true">
		</div>

		<div class="input-group">
			<span class="input-label"><?php echo $lang['email'] ?></span>
			<input class="half" type="email" name="email" value="<?php echo $email; ?>" required="true">
		</div>

		<div class="input-group">
			<span class="input-label"><?php echo $lang['username'] ?></span>
			<input class="half" type="text" name="username" value="<?php echo $username; ?>" required="true">
		</div>

		<div class="input-group">
			<span class="input-label"><?php echo $lang['password'] ?></span>
			<input class="half" type="password" name="password" value="<?php echo $password; ?>" required="true">
		</div>

		<div class="input-group">
			<span class="input-label"><?php echo $lang['is_active'] ?></span>
			<input <?php if($is_active=='Yes'){echo "checked='checked'";} ?> type="radio" name="is_active" value="Yes"> <?php echo $lang['yes'] ?> 
			<input <?php if($is_active=='No'){echo "checked='checked'";} ?> type="radio" name="is_active" value="No"> <?php echo $lang['no'] ?>
		</div>

		<div class="input-group">
			<span class="input-label">
				<input type="hidden" name="id" value="<?php echo $id; ?>">
				<input class="btn-primary btn-sm" type="submit" name="submit" value="<?php echo $lang['edit_user'] ?>">
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
				$_SESSION['edit'] = "<div class='success'>".$lang['edit_success']."</div>";
				header('location:'.SITEURL.'admin/index.php?page=users');
			}
			else
			{
				$_SESSION['edit'] = "<div class='error'>".$lang['edit_fail']."</div>";
				header('location:'.SITEURL.'admin/index.php?page=edit_user&id='.$id);
			}
		}
	?>
</div>