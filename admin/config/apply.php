<?php 
	ob_start();
	include('functions.php');

	//Set Default Time Zone
	date_default_timezone_set('Asia/Kathmandu');

	//Now create new obect for functions
	$obj=new Functions();

	//Now Connecting Database
	$conn = $obj->db_connect();
	//Selecting Database
	$db_select = $obj->db_select($conn);
?>