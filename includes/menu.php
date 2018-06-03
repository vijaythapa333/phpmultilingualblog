<?php 
	$tbl_name = 'tbl_categories';
	$where = "is_active='Yes' && include_in_menu='Yes'";

	$query = $obj->select_data($tbl_name,$where);
	$res = $obj->execute_query($conn,$query);
	if($res == true)
	{
		$count_rows = $obj->num_rows($res);
		{
			if($count_rows>0)
			{
				while ($row=$obj->fetch_data($res)) {
					$id = $row['id'];
					$category_title = $row['title_'.$_SESSION['lang']];
					?>
					<li>
						<a href="<?php echo SITEURL; ?>index.php?page=cat_posts&id=<?php echo $id; ?>"><?php echo $category_title; ?></a>
					</li>
					<?php
				}
			}
		} 
	}
?>

