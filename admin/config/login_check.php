<?php 
	if(!isset($_SESSION['user']))
	{
		header('location:'.SITEURL.'admin/login.php');
	}
?>