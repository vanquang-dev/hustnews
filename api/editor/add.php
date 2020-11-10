<?php 
	session_start();
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	// include object database 
	include_once '../config/database.php';
	include_once '../objects/editor.php';

	// instantiate editor object
	$editor = new Editor();

	// value email and password admin
	$json = file_get_contents('php://input');
	$data_json = json_decode($json, true);

	$email = $data_json['email'];
	$username = $data_json['username'];
	$password = $data_json['password'];
	$password = password_hash($password, PASSWORD_DEFAULT);
	$admin_id = $_SESSION['admin_id'];

	$editor->admin_id($admin_id);
	$check_access = $editor->check_access();
	if ($check_access != 0) {
		http_response_code(404);
		echo json_encode(array("code" => 404,"message" => "Lỗi!"));
		die();
	}

	//check user input data
	if ($username == "" || $password == "" || $email == "") {
		http_response_code(404);
		echo json_encode(array("code" => 404,"message" => "Không được để trống!"));
		die();
	}

	// assign user email and password
	$editor->username($username);
	$editor->email($email);
	$editor->password($password);

	// query check email and password
	$check_editor = $editor->check();
	$check = mysqli_num_rows($check_editor);

	if ($check != 0) {
		http_response_code(404);
		echo json_encode(array("code" => 404,"message" => "Email đã tồn tại"));
		die();
	}

	try {
		
		$editor->add();
		// set reponse code - 400
		http_response_code(200);

		// send data json 
		echo json_encode(array('code' => 200, 'message' => 'Thêm thành công'));


	} catch (Exception $e) {
		// set reponse code - 400
		http_response_code(400);

		// send data json 
		echo json_encode(array('code' => 400, 'message' => 'Lỗi (･´з`･)'));
		die();
	}
?>