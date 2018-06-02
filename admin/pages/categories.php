<div class="body">
	<h2><?php echo $lang['categories'] ?></h2>
	<br>

	<?php 
		if(isset($_SESSION['add']))
		{
			echo $_SESSION['add'];
			unset($_SESSION['add']);
		}
	?>

	<table class="tbl-responsive">
		<tr>
			<td colspan="5">
				<a href="<?php echo SITEURL; ?>admin/index.php?page=add_category">
					<button class="btn-primary btn-sm">Add Category</button>
				</a>
			</td>
		</tr>

		<tr>
			<th>S.N.</th>
			<th>Category Title</th>
			<th>Is Active?</th>
			<th>Include in Menu?</th>
			<th>Actions</th>
		</tr>

		<?php 
			$tbl_name = 'tbl_categories';
			$query = $obj->select_data($tbl_name);
			$res = $obj->execute_query($conn,$query);
			$sn = 1;

			if($res)
			{
				$count_rows= $obj->num_rows($res);
				if($count_rows > 0)
				{
					while ($row=$obj->fetch_data($res)) {
						$id = $row['id'];
						$title = $row['title_'.$_SESSION['lang']];
						$is_active = $row['is_active'];
						$include_in_menu = $row['include_in_menu'];
						?>

						<tr>
							<td><?php echo $sn++; ?>. </td>
							<td><?php echo $title; ?></td>
							<td><?php echo $is_active; ?></td>
							<td><?php echo $include_in_menu; ?></td>
							<td>
								<a href="<?php echo SITEURL; ?>admin/index.php?page=edit_category&id=<?php echo $id; ?>" class="btn-success btn-sm">Edit</a>  
								<a href="#" class="btn-error btn-sm">Delete</a>
							</td>
						</tr>

						<?php
					}
				}
				else
				{
					echo "<tr><td colspan='5' class='error'>No Categories Found.</td></tr>";
				}
			}
		?>
		
	</table>
</div>