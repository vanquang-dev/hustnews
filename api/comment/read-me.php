<?php
	session_start();
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json; chartset="UTF-8"');

	// include object database and login
	include_once '../config/database.php';
	include_once '../objects/comment.php';
	include_once '../config/time.php';
	
	// dashboard login object
	$comment = new Comment();
	$data = [];


	// data user send request
	if (!@file_get_contents('php://input') || !@$_SESSION['user_id']) {
		// set reponse code - 200 OK
		http_response_code(400);

		// send data json 
		echo json_encode(array('code' => 400, 'message' => 'Lỗi (･´з`･)'));
		die();
	}
	$json = file_get_contents('php://input');
	$data_json = json_decode($json, true);
	if (trim($data_json['id']) != '') {
		$id = $data_json['id'];
	} else {
		// set reponse code - 404
		http_response_code(400);
		// send data json 
		echo json_encode(array('code' => 400, 'message' => 'Lỗi (･´з`･)'));
		die();
	}
	$user_id = $_SESSION['user_id'];
	$comment->post_id($id);
	$comment->user_id($user_id);

	$query = $comment->read_me();
	$i = 0;
	while ($row = mysqli_fetch_array($query)) {
		$data['result']['id'][] = $row['comment_id'];
		$i++;
	}
	if (count($data) == 0) {
		$data['result']['id'][] = 0;
	}
	// set reponse code - 200 OK
	http_response_code(200);
	// send data json 
	echo json_encode($data);
?>