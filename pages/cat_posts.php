<div class="main">

	<?php 
		if(isset($_GET['id']) && !empty($_GET['id']))
		{
			$id = $_GET['id'];
			$tbl_name="tbl_posts";
			$where = "category='$id' && is_active='Yes'";
			$other = "ORDER BY id DESC";

			$query = $obj->select_data($tbl_name,$where,$other);
			$res = $obj->execute_query($conn,$query);
			if($res==true)
			{
				$count_rows = $obj->num_rows($res);
				if($count_rows>0)
				{
					while ($row=$obj->fetch_data($res)) {
						$id = $row['id'];
						$post_title = $row['title_'.$_SESSION['lang']];
						$post_description = $row['description_'.$_SESSION['lang']];
						$created_at = $row['created_at'];
						?>

						<div class="body">
							<h2><?php echo $post_title; ?></h2>
							<br>
							<p>
								<?php echo substr($post_description, 0,400).' ...'; ?>
							</p>
							<br>
							<a href="<?php echo SITEURL; ?>index.php?page=blog_detail&id=<?php echo $id; ?>">
								<button class="btn-primary btn-sm"><?php echo $lang['read_more'] ?></button>
							</a>
						</div>

						<?php
					}
				}
				else
				{
					?>
					<div class="error">
						No Posts Found. Try Again.
					</div>
					<?php
				}
			}
		}
		else
		{
			header('location:'.SITEURL);
		}
		
	?>

	
</div>