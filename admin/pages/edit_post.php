<div class="body">
	<h2>Edit Post</h2>
	<br>
	<?php 
		if(isset($_SESSION['edit']))
		{
			echo $_SESSION['edit'];
			unset($_SESSION['edit']);
		}

		if (isset($_GET['id']) && !empty($_GET['id'])) {
			$id = $_GET['id'];
			$tbl_name = 'tbl_posts';
			$where = "id='$id'";

			$query = $obj->select_data($tbl_name,$where);
			$res = $obj->execute_query($conn,$query);

			if($res==true)
			{
				$count_rows = $obj->num_rows($res);
				if($count_rows==1)
				{
					$row = $obj->fetch_data($res);
					$title_en = $row['title_en'];
					$title_np = $row['title_np'];
					$title_cn = $row['title_cn'];
					$description_en = $row['description_en'];
					$description_np = $row['description_np'];
					$description_cn = $row['description_cn'];
					$is_active = $row['is_active'];
					$is_featured = $row['is_featured'];
				}
			}
		}
		else
		{
			header('location:'.SITEURL.'admin/index.php?page=posts');
		}
	?>
	<form method="post" action="">
		<div class="input-group">
			<span class="input-label">Post Title (English)</span>
			<input class="half" type="text" name="title_en" value="<?php echo $title_en; ?>" required="true">
		</div>
		<div class="input-group">
			<span class="input-label">Post Title (Nepali)</span>
			<input class="half" type="text" name="title_np" value="<?php echo $title_np; ?>">
		</div>
		<div class="input-group">
			<span class="input-label">Post Title (Chinese)</span>
			<input class="half" type="text" name="title_cn" value="<?php echo $title_cn; ?>">
		</div>

		<div class="input-group">
			<span class="input-label">Post Description (English)</span>
			<textarea class="half" name="description_en" required="true"><?php echo $description_en; ?></textarea>
		</div>
		<div class="input-group">
			<span class="input-label">Post Description (Nepali)</span>
			<textarea class="half" name="description_np"><?php echo $description_np; ?></textarea>
		</div>
		<div class="input-group">
			<span class="input-label">Post Description (Chinese)</span>
			<textarea class="half" name="description_cn"><?php echo $description_cn; ?></textarea>
		</div>

		<div class="input-group">
			<span class="input-label">Is Active?</span>
			<input <?php if($is_active=='Yes'){echo"checked='checked'";} ?> type="radio" name="is_active" value="Yes"> Yes
			<input <?php if($is_active=='No'){echo"checked='checked'";} ?> type="radio" name="is_active" value="No"> No
		</div>

		<div class="input-group">
			<span class="input-label">Is Featured?</span>
			<input <?php if($is_featured=='Yes'){echo"checked='checked'";} ?> type="radio" name="is_featured" value="Yes"> Yes
			<input <?php if($is_featured=='No'){echo"checked='checked'";} ?> type="radio" name="is_featured" value="No"> No
		</div>
		<br>
		<div class="input-group">
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<input class="btn-primary btn-sm" type="submit" name="submit" value="Update Post">
		</div>
	</form>

	<?php 
		if(isset($_POST['submit']))
		{
			//echo "Clicked";
			$id = $_POST['id'];
			$title_en = $obj->sanitize($conn,$_POST['title_en']);
			$title_np = $obj->sanitize($conn,$_POST['title_np']);
			$title_cn = $obj->sanitize($conn,$_POST['title_cn']);
			$description_en = $obj->sanitize($conn,$_POST['description_en']);
			$description_np = $obj->sanitize($conn,$_POST['description_np']);
			$description_cn = $obj->sanitize($conn,$_POST['description_cn']);
			$is_active = $obj->sanitize($conn,$_POST['is_active']);
			$is_featured = $obj->sanitize($conn,$_POST['is_featured']);

			$data = "
				title_en = '$title_en',
				title_np = '$title_np',
				title_cn = '$title_cn',
				description_en = '$description_en',
				description_np = '$description_np',
				description_cn = '$description_cn',
				is_active = '$is_active',
				is_featured = '$is_featured'
			";

			$tbl_name = 'tbl_posts';
			$where = "id = '$id'";

			$query = $obj->update_data($tbl_name,$data,$where);
			$res = $obj->execute_query($conn,$query);
			if($res == true)
			{
				$_SESSION['edit'] = "<div class='success'>Post Succcessfully Updated.</div>";
				header('location:'.SITEURL.'admin/index.php?page=posts');
			}
			else
			{
				$_SESSION['edit'] = "<div class='error'>Failed to Update Post.</div>";
				header('location:'.SITEURL.'admin/index.php?page=edit_post&id='.$id);
			}
		}
	?>
</div>