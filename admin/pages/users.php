<div class="body">
	<h2><?php echo $lang['users'] ?></h2>
	<br>
	<?php 
		if(isset($_SESSION['add']))
		{
			echo $_SESSION['add'];
			unset($_SESSION['add']);
		}
		if(isset($_SESSION['edit']))
		{
			echo $_SESSION['edit'];
			unset($_SESSION['edit']);
		}
		if(isset($_SESSION['delete']))
		{
			echo $_SESSION['delete'];
			unset($_SESSION['delete']);
		}
	?>
	<table class="tbl-responsive">
		<tr>
			<td colspan="5">
				<a href="<?php echo SITEURL; ?>admin/index.php?page=add_user"><button class="btn-primary btn-sm">Add User</button></a>
			</td>
		</tr>
		<tr>
			<th>S.N.</th>
			<th>Full Name</th>
			<th>Username</th>
			<th>Is Active?</th>
			<th>Actions</th>
		</tr>

		<?php 
			$tbl_name='tbl_users';
			$sn = 1;
			$query = $obj->select_data($tbl_name);

			$res = $obj->execute_query($conn,$query);
			if($res==true)
			{
				$count_rows = $obj->num_rows($res);
				if($count_rows>0)
				{
					while ($row=$obj->fetch_data($res)) {	
						$id = $row['id'];
						$full_name = $row['full_name'];
						$username = $row['username'];
						$is_active = $row['is_active'];
						?>
						<tr>
							<td><?php echo $sn++; ?>. </td>
							<td><?php echo $full_name; ?></td>
							<td><?php echo $username; ?></td>
							<td><?php echo $is_active; ?></td>
							<td>
								<a href="<?php echo SITEURL; ?>admin/index.php?page=edit_user&id=<?php echo $id; ?>" class="btn-success btn-sm">Edit</a> 
								<a href="<?php echo SITEURL; ?>admin/pages/delete.php?page=users&id=<?php echo $id; ?>" class="btn-error btn-sm">Delete</a>
							</td>
						</tr>
						<?php
					}
				}
				else
				{
					echo "<tr><td class='error'>No Users Added Yet.</td></tr>";
				}
			}
		?>
		
	</table>
</div>