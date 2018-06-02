<div class="body">
	<h2>Add Category</h2>

	<?php 
		if(isset($_SESSION['add']))
		{
			echo $_SESSION['add'];
			unset($_SESSION['add']);
		}
	?>

	<form method="post" action="">
		<div class="input-group">
			<span class="input-label">Category Title (English)</span> 
			<input type="text" name="title_en" placeholder="Category Title in English" required="true" class="half">
		</div>
		<div class="input-group">
			<span class="input-label">Category Title (Nepali)</span> 
			<input type="text" name="title_np" placeholder="Category Title in Nepali" class="half">
		</div>
		<div class="input-group">
			<span class="input-label">Category Title (Chinese)</span> 
			<input type="text" name="title_cn" placeholder="Category Title in Chinese" class="half">
		</div>
		<div class="input-group">
			<span class="input-label">Is Active?</span>
			<input type="radio" name="is_active" value="Yes"> Yes
			<input type="radio" name="is_active" value="No"> No
		</div>
		<div class="input-group">
			<span class="input-label">Include in Menu?</span>
			<input type="radio" name="include_in_menu" value="Yes"> Yes
			<input type="radio" name="include_in_menu" value="No"> No
		</div>

		<div class="input-group">
			<span class="input-label">
				<input type="submit" name="submit" value="Add Category" class="btn-success btn-sm">
			</span>
		</div>
		<br>
	</form>
	
	<?php 
		if(isset($_POST['submit']))
		{
			//echo "Click";
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

			$query = $obj->insert_data($tbl_name,$data);

			$res = $obj->execute_query($conn,$query);

			if($res==true)
			{
				//Category Successfully Added
				$_SESSION['add'] = "<div class='success'>Category successfully added.</div>";
				header('location:'.SITEURL.'admin/index.php?page=categories');
			}
			else
			{
				//Failed to Add Categoy
				$_SESSION['add'] = "<div class='error'>Failed to Add Categoy.</div>";
				header('location:'.SITEURL.'admin/index.php?page=add_category');
			}
		}
	?>
</div>