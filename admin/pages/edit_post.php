<div class="body">
	<h2><?php echo $lang['edit_post'] ?></h2>
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
					$category = $row['category'];
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
			<span class="input-label"><?php echo $lang['title'] ?> (<?php echo $lang['english'] ?>)</span>
			<input class="half" type="text" name="title_en" value="<?php echo $title_en; ?>" required="true">
		</div>
		<div class="input-group">
			<span class="input-label"><?php echo $lang['title'] ?> (<?php echo $lang['nepali'] ?>)</span>
			<input class="half" type="text" name="title_np" value="<?php echo $title_np; ?>">
		</div>
		<div class="input-group">
			<span class="input-label"><?php echo $lang['title'] ?> (<?php echo $lang['chinese'] ?>)</span>
			<input class="half" type="text" name="title_cn" value="<?php echo $title_cn; ?>">
		</div>

		<div class="input-group">
			<span class="input-label"><?php echo $lang['description'] ?> (<?php echo $lang['english'] ?>)</span>
			<textarea class="half" name="description_en" required="true"><?php echo $description_en; ?></textarea>
		</div>
		<div class="input-group">
			<span class="input-label"><?php echo $lang['description'] ?> (<?php echo $lang['nepali'] ?>)</span>
			<textarea class="half" name="description_np"><?php echo $description_np; ?></textarea>
		</div>
		<div class="input-group">
			<span class="input-label"><?php echo $lang['description'] ?> (<?php echo $lang['chinese'] ?>)</span>
			<textarea class="half" name="description_cn"><?php echo $description_cn; ?></textarea>
		</div>

		<div class="input-group">
			<span class="input-label"><?php echo $lang['category'] ?></span>
			<select class="half" name="category">
				<?php 
					$tbl_name = 'tbl_categories';
					$query = $obj->select_data($tbl_name);
					$res = $obj->execute_query($conn,$query);
					if($res==true)
					{
						$count_rows = $obj->num_rows($res);
						if($count_rows>0)
						{
							while ($row=$obj->fetch_data($res)) {
								$cat_id=$row['id'];
								$title=$row['title_'.$_SESSION['lang']];
								?>
								<option <?php if($category==$cat_id){echo"selected='selected'";} ?> value="<?php echo $cat_id; ?>"><?php echo $title; ?></option>
								<?php
							}
						}
						else{
							?>
							<option value="0">None</option>
							<?php 
						}
					}
				?>
			</select>
		</div>

		<div class="input-group">
			<span class="input-label"><?php echo $lang['is_active'] ?></span>
			<input <?php if($is_active=='Yes'){echo"checked='checked'";} ?> type="radio" name="is_active" value="Yes"> <?php echo $lang['yes'] ?>
			<input <?php if($is_active=='No'){echo"checked='checked'";} ?> type="radio" name="is_active" value="No"> <?php echo $lang['no'] ?>
		</div>

		<div class="input-group">
			<span class="input-label"><?php echo $lang['is_featured'] ?></span>
			<input <?php if($is_featured=='Yes'){echo"checked='checked'";} ?> type="radio" name="is_featured" value="Yes"> <?php echo $lang['yes'] ?>
			<input <?php if($is_featured=='No'){echo"checked='checked'";} ?> type="radio" name="is_featured" value="No"> <?php echo $lang['no'] ?>
		</div>
		<br>
		<div class="input-group">
			<input type="hidden" name="id" value="<?php echo $id; ?>">
			<input class="btn-primary btn-sm" type="submit" name="submit" value="<?php echo $lang['edit_post'] ?>">
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
			$url = strtolower(str_replace(' ', '-', $title_en));
			$category = $obj->sanitize($conn,$_POST['category']);
			$is_active = $obj->sanitize($conn,$_POST['is_active']);
			$is_featured = $obj->sanitize($conn,$_POST['is_featured']);

			$data = "
				title_en='$title_en',
				title_np='$title_np',
				title_cn='$title_cn',
				description_en='$description_en',
				description_np='$description_np',
				description_cn='$description_cn',
				url = '$url',
				category='$category',
				is_active='$is_active',
				is_featured='$is_featured'
			";
			$where = "id='$id'";
			$tbl_name = 'tbl_posts';
			$query = $obj->update_data($tbl_name,$data,$where);
			$res = $obj->execute_query($conn,$query);
			if($res==true)
			{
				$_SESSION['edit'] = "<div class='success'>".$lang['edit_success']."</div>";
				header('location:'.SITEURL.'admin/index.php?page=posts');
			}
			else
			{
				$_SESSION['edit'] = "<div class='error'>".$lang['edit_fail']."</div>";
				header('location:'.SITEURL.'admin/index.php?page=edit_post&id='.$id);
			}
		}
	?>
</div>