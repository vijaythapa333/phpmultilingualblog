<div class="body">
	<h2><?php echo $lang['posts'] ?></h2>
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
	?>
	<table class="tbl-responsive">
		<tr>
			<td colspan="5">
				<a href="<?php echo SITEURL; ?>admin/index.php?page=add_post" class="btn-primary btn-sm">Add Post</a>
			</td>
		</tr>
		<tr>
			<th>S.N.</th>
			<th>Post Title</th>
			<th>Is Active?</th>
			<th>Is Featured?</th>
			<th>Actions</th>
		</tr>

		<?php 
			$tbl_name = 'tbl_posts';
			$query = $obj->select_data($tbl_name);
			$res = $obj->execute_query($conn,$query);
			$sn = 1;

			if($res==true)
			{
				$count_rows = $obj->num_rows($res);
				if($count_rows>0)
				{
					while ($row=$obj->fetch_data($res)) {
						$id = $row['id'];
						$title = $row['title_'.$_SESSION['lang']];
						$is_active = $row['is_active'];
						$is_featured = $row['is_featured'];
						?>
						<tr>
							<td><?php echo $sn++; ?>. </td>
							<td><?php echo $title; ?></td>
							<td><?php echo $is_active; ?></td>
							<td><?php echo $is_featured; ?></td>
							<td>
								<a href="<?php echo SITEURL; ?>admin/index.php?page=edit_post&id=<?php echo $id; ?>" class="btn-success btn-sm">Edit</a> 
								<a href="#" class="btn-error btn-sm">Delete</a>
							</td>
						</tr>
						<?php
					}
				}
				else
				{
					echo"<tr><td colspan='5' class='error'>No Posts Found.</td></tr>";
				}
			}
		?>
		
	</table>
</div>