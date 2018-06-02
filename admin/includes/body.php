<div class="main">
	<?php 
		if(isset($_GET['page']) && !empty($_GET['page']))
		{
			$page = $_GET['page'];
			if($page=='logout')
			{
				unset($_SESSION['user']);
				header('location:'.SITEURL.'admin/login.php');
				die();
			}
		}
		else
		{
			$page="home";
		}
		include('pages/'.$page.'.php');
		/*
		switch ($page) {
			case 'categories':
				include('pages/'.$page.'.php');
				break;

			case 'add_category':
				include('pages/'.$page.'.php');
				break;

			case 'edit_category':
				include('pages/'.$page.'.php');
				break;

			case 'posts':
				include('pages/'.$page.'.php');
				break;

			case 'add_post':
				include('pages/'.$page.'.php');
				break;

			case 'edit_post':
				include('pages/'.$page.'.php');
				break;
			
			case 'logout':
				session_destroy();
				header('location:'.SITEURL.'admin');
				break;
			
			default:
				include('pages/'.$page.'.php');
				break;
		}
		*/
	?>
</div>