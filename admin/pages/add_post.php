<div class="body">
	<h2>Add Post</h2>
	<br>
	<?php 
		if(isset($_SESSION['add']))
		{
			echo $_SESSION['add'];
			unset($_SESSION['add']);
		}
	?>
	<form method="post" action="">
		<div class="input-group">
			<span class="input-label">Post Title (English)</span>
			<input class="half" type="text" name="title_en" placeholder="Post Title in English" required="true">
		</div>
		<div class="input-group">
			<span class="input-label">Post Title (Nepali)</span>
			<input class="half" type="text" name="title_np" placeholder="Post Title in Nepali">
		</div>
		<div class="input-group">
			<span class="input-label">Post Title (Chinese)</span>
			<input class="half" type="text" name="title_cn" placeholder="Post Title in Chinese">
		</div>

		<div class="input-group">
			<span class="input-label">Post Description (English)</span>
			<textarea class="half" name="description_en" placeholder="Post Description in English" required="true"></textarea>
		</div>
		<div class="input-group">
			<span class="input-label">Post Description (Nepali)</span>
			<textarea class="half" name="description_np" placeholder="Post Description in Nepali" required="true"></textarea>
		</div>
		<div class="input-group">
			<span class="input-label">Post Description (Chinese)</span>
			<textarea class="half" name="description_cn" placeholder="Post Description in Chinese" required="true"></textarea>
		</div>

		<div class="input-group">
			<span class="input-label">Is Active?</span>
			<input type="radio" name="is_active" value="Yes"> Yes
			<input type="radio" name="is_active" value="No"> No
		</div>

		<div class="input-group">
			<span class="input-label">Is Featured?</span>
			<input type="radio" name="is_featured" value="Yes"> Yes
			<input type="radio" name="is_featured" value="No"> No
		</div>
		<br>
		<div class="input-group">
			<input class="btn-primary btn-sm" type="submit" name="submit" value="Add Post">
		</div>
	</form>

	<?php 
		if(isset($_POST['submit']))
		{
			$title_en = $obj->sanitize($conn,$_POST['title_en']);
			$title_np = $obj->sanitize($conn,$_POST['title_np']);
			$title_cn = $obj->sanitize($conn,$_POST['title_cn']);
			$description_en = $obj->sanitize($conn,$_POST['description_en']);
			$description_np = $obj->sanitize($conn,$_POST['description_np']);
			$description_cn = $obj->sanitize($conn,$_POST['description_cn']);
			$is_active = $_POST['is_active'];
			$is_featured = $_POST['is_featured'];
			$created_at = date('Y-m-d H:i:s');

			$data="
				title_en='$title_en',
				title_np='$title_np',
				title_cn='$title_cn',
				description_en='$description_en',
				description_np='$description_np',
				description_cn='$description_cn',
				is_active='$is_active',
				is_featured='$is_featured',
				created_at='$created_at'
			";

			$tbl_name='tbl_posts';
			$query = $obj->insert_data($tbl_name,$data);
			$res = $obj->execute_query($conn,$query);

			if($res == true)
			{
				$_SESSION['add'] = "<div class='success'>New Post Successfully Added.</div>";
				header('location:'.SITEURL.'admin/index.php?page=posts');
			}
			else
			{
				$_SESSION['add'] = "<div class='error'>Failed to add new post.</div>";
				header('location:'.SITEURL.'admin/index.php?page=add_post');
			}
		}
	?>
</div>