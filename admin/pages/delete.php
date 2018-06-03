<?php 
	include('../../languages/lang_config.php');
	include('../config/apply.php');

	if(isset($_GET['id']) && !empty($_GET['id']) && isset($_GET['page']) && !empty($_GET['page']))
	{
		$id = $_GET['id'];
		$page = $_GET['page'];
		$tbl_name = 'tbl_'.$page;
		$where = "id = '$id'";

		// switch ($page) {
		// 	case 'categories':
				
		// 		$title = "Category";
		// 		break;
			
		// 	case 'posts':
		// 		$title = "Post";
		// 		break;
			
		// 	case 'users':
		// 		$title = "User";
		// 		break;
		// }

		$query = $obj->delete_data($tbl_name,$where);
		$res = $obj->execute_query($conn,$query);

		if($res == true)
		{
			$_SESSION['delete'] = "<div class='success'>".$lang['delete_success']."</div>";
			header('location:'.SITEURL.'admin/index.php?page='.$page);
		}
		else
		{
			$_SESSION['delete'] = "<div class='error'>".$lang['delete_fail']."</div>";
			header('location:'.SITEURL.'admin/index.php?page='.$page);
		}
	}
	else
	{
		header('location:'.SITEURL.'admin/');
	}
?>