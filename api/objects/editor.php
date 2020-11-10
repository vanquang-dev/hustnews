<?php
	/**
	 * member object
	 */
	Class Editor extends Database {
		// databse connect and database name
		public $table_name = "admin";
		public $username;
		public $email;
		public $password;
		public $admin_id;

		public function username($value) {
		    $value = mysqli_escape_string($this->get_connection(), $value);
		    $this->username = $value;
		}
		public function email($value) {
		    $value = mysqli_escape_string($this->get_connection(), $value);
		    $this->email = $value;
		}
		public function password($value) {
		    $value = mysqli_escape_string($this->get_connection(), $value);
		    $this->password = $value;
		}
		public function admin_id($value) {
		    $value = mysqli_escape_string($this->get_connection(), $value);
		    $this->admin_id = $value;
		}
		
		// function check number rows after query statement 
		function check() {
			// query 
			$query = "SELECT * FROM `".$this->table_name."` WHERE `email` = '".$this->email."'";
			$query_statement = mysqli_query($this->get_connection(), $query);
			return $query_statement;
		}

		function add() {
			$query = "INSERT INTO `admin` (
		    `email`, `username`, `password`, `kind`
		    ) VALUES (
		    '".$this->email."',
		    '".$this->username."',
		    '".$this->password."',
		    '1'
		    )";
		    return mysqli_query($this->get_connection(), $query);
		}

		function read() {
			$query = "SELECT * FROM `admin` WHERE `kind` = 1 OR `kind` = 2";
			$query_statement = mysqli_query($this->get_connection(), $query);
			return $query_statement;
		}

		function check_access() {
			// query 
			$query = "SELECT `kind` FROM `admin` WHERE `admin_id` = '".$this->admin_id."'";
			$query_statement = mysqli_query($this->get_connection(), $query);
			$row = mysqli_fetch_array($query_statement);
			return $row['kind'];
		}
	}
?>