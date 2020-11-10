<?php
	/**
	 * login object
	 */
	Class Login extends Database {
		// databse connect and database name
		public $table_name = "user";
		public $email;
		public $name;
		public $password;
		public $social_id;
		public $social_name;

		// function check number rows after query statement 
		
		public function social_id($value) {
		    $value = mysqli_escape_string($this->get_connection(), $value);
		    $this->social_id = $value;
		}

		public function social_name($value) {
		    $value = mysqli_escape_string($this->get_connection(), $value);
		    $this->social_name = $value;
		}
		
		public function name($value) {
		    $value = mysqli_escape_string($this->get_connection(), $value);
		    $this->name = $value;
		}
		
		function read() {
			// query 
			$query = "SELECT * FROM `".$this->table_name."` WHERE `email` = '".$this->email."' AND `social_name` = 'hustnews'";
			$query_statement = mysqli_query($this->get_connection(), $query);
			return $query_statement;
		}

		function check_social_gg() {
			$query = "SELECT * FROM `".$this->table_name."` WHERE `social_id` = '".$this->social_id."' AND `name` = '".$this->social_name."' AND `social_name` = 'google'";
			$query_statement = mysqli_query($this->get_connection(), $query);
			return mysqli_num_rows($query_statement);
		}
		

		function check_social_fb() {
			$query = "SELECT * FROM `".$this->table_name."` WHERE `social_id` = '".$this->social_id."' AND `name` = '".$this->social_name."' AND `social_name` = 'facebook'";
			$query_statement = mysqli_query($this->get_connection(), $query);
			return mysqli_num_rows($query_statement);
		}

		function get_user() {
			$query = "SELECT * FROM `".$this->table_name."` WHERE `email` = '".$this->email."' AND `name` = '".$this->name."' AND `social_name` = 'hustnews'";
			$query_statement = mysqli_query($this->get_connection(), $query);
			return mysqli_fetch_array($query_statement);
		}
		
		function get_user_fb() {
			$query = "SELECT * FROM `".$this->table_name."` WHERE `social_id` = '".$this->social_id."' AND `name` = '".$this->social_name."' AND `social_name` = 'facebook'";
			$query_statement = mysqli_query($this->get_connection(), $query);
			return mysqli_fetch_array($query_statement);
		}

		function get_user_gg() {
			$query = "SELECT * FROM `".$this->table_name."` WHERE `social_id` = '".$this->social_id."' AND `name` = '".$this->social_name."' AND `social_name` = 'google'";
			$query_statement = mysqli_query($this->get_connection(), $query);
			return mysqli_fetch_array($query_statement);
		}
		
	}
?>