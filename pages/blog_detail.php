<div class="main">

	<?php
		if(isset($_GET['id']) && !empty($_GET['id']))
		{
			$id = $_GET['id'];
			$tbl_name = 'tbl_posts';
			$where = "id='$id'";
			$query = $obj->select_data($tbl_name,$where);

			$res = $obj->execute_query($conn,$query);
			if($res == true)
			{
				$count_rows = $obj->num_rows($res);
				if($count_rows==1)
				{
					$row = $obj->fetch_data($res);
					$post_title = $row['title_'.$_SESSION['lang']];
					$post_description = $row['description_'.$_SESSION['lang']];
				}
				else
				{
					header('location:'.SITEURL);
				}
			}
		}
		else
		{
			header('location:'.SITEURL);
		}
	?>

	<div class="body">
		<h2><?php echo $post_title; ?></h2>
		<br>
		<p>
			<?php echo $post_description; ?>
		</p>
		<br>
	</div>
</div>