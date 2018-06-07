<div class="body">
	<h2><?php echo $lang['add_post'] ?></h2>
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
			<span class="input-label"><?php echo $lang['title'] ?> (<?php echo $lang['english'] ?>)</span>
			<input class="half" type="text" name="title_en" placeholder="Post Title in English" required="true">
		</div>
		<div class="input-group">
			<span class="input-label"><?php echo $lang['title'] ?> (<?php echo $lang['nepali'] ?>)</span>
			<input class="half" type="text" name="title_np" placeholder="Post Title in Nepali">
		</div>
		<div class="input-group">
			<span class="input-label"><?php echo $lang['title'] ?> (<?php echo $lang['chinese'] ?>)</span>
			<input class="half" type="text" name="title_cn" placeholder="Post Title in Chinese">
		</div>

		<div class="input-group">
			<span class="input-label"><?php echo $lang['description'] ?> (<?php echo $lang['english'] ?>)</span>
			<textarea class="half" name="description_en" placeholder="Post Description in English" required="true"></textarea>
		</div>
		<div class="input-group">
			<span class="input-label"><?php echo $lang['description'] ?> (<?php echo $lang['nepali'] ?>)</span>
			<textarea class="half" name="description_np" placeholder="Post Description in Nepali" required="true"></textarea>
		</div>
		<div class="input-group">
			<span class="input-label"><?php echo $lang['description'] ?> (<?php echo $lang['chinese'] ?>)</span>
			<textarea class="half" name="description_cn" placeholder="Post Description in Chinese" required="true"></textarea>
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
								$id=$row['id'];
								$title=$row['title_'.$_SESSION['lang']];
								?>
								<option value="<?php echo $id; ?>"><?php echo $title; ?></option>
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
			<input type="radio" name="is_active" value="Yes"> <?php echo $lang['yes'] ?>
			<input type="radio" name="is_active" value="No"> <?php echo $lang['no'] ?>
		</div>

		<div class="input-group">
			<span class="input-label"><?php echo $lang['is_featured'] ?></span>
			<input type="radio" name="is_featured" value="Yes"> <?php echo $lang['yes'] ?>
			<input type="radio" name="is_featured" value="No"> <?php echo $lang['no'] ?>
		</div>
		<br>
		<div class="input-group">
			<input class="btn-primary btn-sm" type="submit" name="submit" value="<?php echo $lang['add_post'] ?>">
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
			$url = strtolower(str_replace(' ', '-', $title_en));
			$category = $_POST['category'];
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
				url = '$url',
				category='$category',
				is_active='$is_active',
				is_featured='$is_featured',
				created_at='$created_at'
			";

			$tbl_name='tbl_posts';
			$query = $obj->insert_data($tbl_name,$data);
			$res = $obj->execute_query($conn,$query);

			if($res == true)
			{
				$_SESSION['add'] = "<div class='success'>".$lang['add_success']."</div>";
				header('location:'.SITEURL.'admin/index.php?page=posts');
			}
			else
			{
				$_SESSION['add'] = "<div class='error'>".$lang['add_fail']."</div>";
				header('location:'.SITEURL.'admin/index.php?page=add_post');
			}
		}
	?>
</div>