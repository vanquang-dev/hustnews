<?php 
	session_start();
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	// include object database 
	include_once '../config/database.php';
	include_once '../objects/login-admin.php';

	// instantiate login object
	$login = new Login();

	// value email and password admin
	$json = file_get_contents('php://input');
	$data_json = json_decode($json, true);

	$email = $data_json['email'];
	$password = $data_json['password'];

	//check user input data
	if ($password == "" || $email == "") {
		http_response_code(404);
		echo json_encode(array("code" => 404,"message" => "Đăng nhập thất bại"));
		die();
	}

	// mysqli_real_escape_string value input
	$password = mysqli_escape_string($login->get_connection(), $password);
	$email = mysqli_escape_string($login->get_connection(), $email);

	// assign user email and password
	$login->email = $email;
	$login->password = $password;

	// query check email and password
	$check_login = $login->read();
	$data = mysqli_fetch_array($check_login);
	$password_db = $data['password'];
	
	if ($data == NULL) {
		http_response_code(404);
		echo json_encode(array("code" => 404,"message" => "Tài khoản mật khẩu không chính xác"));
		die();
	}

	if ($data['kind'] == 2) {
		http_response_code(404);
		echo json_encode(array("code" => 404,"message" => "Tài khoản của bạn đã bị khóa"));
		die();
	}

	if (password_verify($login->password, $password_db)) {
		$_SESSION['admin_id'] = $data['admin_id'];
		$_SESSION['username'] = $data['username'];
		$_SESSION['avatar'] = $data['avatar'];

		http_response_code(200);
		echo json_encode(array("code" => 200,"message" => "Đăng nhập thành công."));
	    die();
	} else {
		http_response_code(404);
		echo json_encode(array("code" => 404,"message" => "Đăng nhập thất bại"));
		die();
	}
?>