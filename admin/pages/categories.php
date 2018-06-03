<div class="body">
	<h2><?php echo $lang['categories'] ?></h2>
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
				<a href="<?php echo SITEURL; ?>admin/index.php?page=add_category">
					<button class="btn-primary btn-sm"><?php echo $lang['add'] ?></button>
				</a>
			</td>
		</tr>

		<tr>
			<th><?php echo $lang['sn'] ?></th>
			<th><?php echo $lang['title'] ?></th>
			<th><?php echo $lang['is_active'] ?></th>
			<th><?php echo $lang['include_in_menu'] ?></th>
			<th><?php echo $lang['actions'] ?></th>
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
							<td>
								<?php if($is_active=='Yes'){echo $lang['yes'];}else if($is_active=='No'){echo $lang['no'];} ?>
								
							</td>
							<td>
								<?php if($include_in_menu=='Yes'){echo $lang['yes'];}else if($include_in_menu=='No'){echo $lang['no'];} ?>
							</td>
							<td>
								<a href="<?php echo SITEURL; ?>admin/index.php?page=edit_category&id=<?php echo $id; ?>" class="btn-success btn-sm"><?php echo $lang['edit'] ?></a>  
								<a href="<?php echo SITEURL; ?>admin/pages/delete.php?page=categories&id=<?php echo $id; ?>" class="btn-error btn-sm"><?php echo $lang['delete'] ?></a>
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