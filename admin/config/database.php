<?php 
	include('constants.php');

	Class Database
	{
		//Function to Connect Database
		public function db_connect()
		{
			$conn = mysqli_connect(LOCALHOST, USERNAME, PASSWORD) or die(mysqli_error()); 
			return $conn;
		}

		//Function to Select Database
		public function db_select($conn)
		{
			$db_select = mysqli_select_db($conn, DBNAME) or die(mysqli_error());
			return $db_select;
		}

		//Function to Select Data from Datbase

		//Function to Insert Data into Database

		//Function To Select Single/Unique Data from Database

		//Function to Update Data From Database

		//FUnction to Delete Data from Database
	}
?>