<?php 
	/**
	 * register object
	 */
	class Register extends Database {
		public $name;
		public $email;
		public $password;
		public $social_id;
		public $social_name;
		public $avatar;

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
		
		public function avatar($value) {
		    $value = mysqli_escape_string($this->get_connection(), $value);
		    $this->avatar = $value;
		}
		
		function check_exists() {
			$query = "SELECT * FROM `user` WHERE `email` = '".$this->email."' AND `social_name` = 'hustnews'";
			$query_statement = mysqli_query($this->get_connection(), $query);
			return mysqli_num_rows($query_statement);
		}
		
		function create() {
			$query = "INSERT INTO `user` (`name`, `email`, `password`, `social_name`) VALUES ('".$this->name."', '".$this->email."', '".$this->password."', 'hustnews')";
			mysqli_query($this->get_connection(), $query);
			return 1;
		}

		function create_facebook() {
			$query = "INSERT INTO `user` (`name`, `email`, `social_id`, `social_name`) VALUES ('".$this->name."', '".$this->email."', '".$this->social_id."', 'facebook')";
			mysqli_query($this->get_connection(), $query);
			return 1;
		}

		function create_google() {
			$query = "INSERT INTO `user` (`name`, `email`, `social_id`, `social_name`, `avatar`) VALUES ('".$this->name."', '".$this->email."', '".$this->social_id."', 'google', '".$this->avatar."')";
			mysqli_query($this->get_connection(), $query);
			return 1;
		}

		function get_user() {
			$query = "SELECT * FROM `user` WHERE `email` = '".$this->email."' AND `name` = '".$this->name."' AND `social_name` = 'hustnews'";
			$query_statement = mysqli_query($this->get_connection(), $query);
			return mysqli_fetch_array($query_statement);
		}
		
	}
?>