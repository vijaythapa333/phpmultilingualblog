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
		public function select_data($tbl_name, $where="", $other="")
		{
			$query = "SELECT * FROM $tbl_name";
			if($where != "")
			{
				$query .= " WHERE $where";
			}
			if($other != "")
			{
				$query .= " $other";
			}
			return $query;
		}

		//Function to Insert Data into Database
		public function insert_data($tbl_name, $data)
		{
			$query = "INSERT INTO $tbl_name SET $data";
			return $query;
		}

		//Function to Update Data From Database
		public function update_data($tbl_name, $data, $where)
		{
			$query = "UPDATE $tbl_name SET $data WHERE $where";
			return $query;
		}

		//FUnction to Delete Data from Database
		public function delete_data($tbl_name, $where)
		{
			$query = "DELETE FROM $tbl_name WHERE $where";
			return $query;
		}

		//Function to Execute Query
		public function execute_query($conn,$query)
		{
			$res = mysqli_query($conn,$query) or die(mysqli_error($conn));
			return $res;
		}

		//Function to Calculate Number of Rows
		public function num_rows($res)
		{
			$num_rows = mysqli_num_rows($res);
			return $num_rows;
		}

		//Function to Get all the Data from DAtabase
		public function fetch_data($res)
		{
			$row = mysqli_fetch_assoc($res);
			return $row;
		}
	}
?>