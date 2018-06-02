<div class="body">
	<h2>Edit Category</h2>

	<?php 
		if(isset($_SESSION['edit']))
		{
			echo $_SESSION['edit'];
			unset($_SESSION['edit']);
		}

		if(isset($_GET['id']) && !empty($_GET['id']))
		{
			$id = $_GET['id'];
			$tbl_name ='tbl_categories';
			$where = "id='$id'";

			$query = $obj->select_data($tbl_name,$where);
			$res = $obj->execute_query($conn,$query);
			if($res)
			{
				$count_rows = $obj->num_rows($res);
				if ($count_rows==1) {
					$row = $obj->fetch_data($res);
					$title_en = $row['title_en'];
					$title_np = $row['title_np'];
					$title_cn = $row['title_cn'];
					$is_active = $row['is_active'];
					$include_in_menu = $row['include_in_menu'];
				}
			}
		}
		else
		{
			header('location:'.SITEURL.'admin/index.php?page=categories');
		}
	?>

	<form method="post" action="">
		<div class="input-group">
			<span class="input-label">Category Title (English)</span> 
			<input type="text" name="title_en" value="<?php echo $title_en; ?>" required="true" class="half">
		</div>
		<div class="input-group">
			<span class="input-label">Category Title (Nepali)</span> 
			<input type="text" name="title_np" value="<?php echo $title_np; ?>"" class="half">
		</div>
		<div class="input-group">
			<span class="input-label">Category Title (Chinese)</span> 
			<input type="text" name="title_cn" value="<?php echo $title_cn; ?>"" class="half">
		</div>
		<div class="input-group">
			<span class="input-label">Is Active?</span>
			<input <?php if($is_active=='Yes'){echo "checked='checked'";} ?> type="radio" name="is_active" value="Yes"> Yes
			<input <?php if($is_active=='No'){echo "checked='checked'";} ?> type="radio" name="is_active" value="No"> No
		</div>
		<div class="input-group">
			<span class="input-label">Include in Menu?</span>
			<input <?php if($include_in_menu=='Yes'){echo "checked='checked'";} ?> type="radio" name="include_in_menu" value="Yes"> Yes
			<input <?php if($include_in_menu=='No'){echo "checked='checked'";} ?> type="radio" name="include_in_menu" value="No"> No
		</div>

		<div class="input-group">
			<span class="input-label">
				<input type="hidden" name="id" value="<?php echo $id; ?>">
				<input type="submit" name="submit" value="Update Category" class="btn-success btn-sm">
			</span>
		</div>
		<br>
	</form>
	
	<?php 
		if(isset($_POST['submit']))
		{
			//echo "Click";
			$id = $_POST['id'];
			$title_en = $obj->sanitize($conn,$_POST['title_en']);
			$title_np = $obj->sanitize($conn,$_POST['title_np']);
			$title_cn = $obj->sanitize($conn,$_POST['title_cn']);
			$is_active = $_POST['is_active'];
			$include_in_menu = $_POST['include_in_menu'];

			$tbl_name = 'tbl_categories';

			$data= "
				title_en = '$title_en',
				title_np = '$title_np',
				title_cn = '$title_cn',
				is_active = '$is_active',
				include_in_menu = '$include_in_menu'
			";
			$where = "id='$id'";

			$query = $obj->update_data($tbl_name,$data,$where);

			$res = $obj->execute_query($conn,$query);

			if($res==true)
			{
				//Category Successfully Added
				$_SESSION['add'] = "<div class='success'>Category successfully updated.</div>";
				header('location:'.SITEURL.'admin/index.php?page=categories');
			}
			else
			{
				//Failed to Add Categoy
				$_SESSION['add'] = "<div class='error'>Failed to Update Categoy.</div>";
				header('location:'.SITEURL.'admin/index.php?page=edit_category&id='.$id);
			}
		}
	?>
</div>