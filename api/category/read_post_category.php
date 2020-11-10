<?php
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json; chartset="UTF-8"');

	// include object database and login
	include_once '../config/database.php';
	include_once '../config/time.php';
	include_once '../config/utf8tourl.php';
	include_once '../objects/category.php';
	
	// dashboard login object
	$category = new Category();
	$data = [];
	// data user send request
	if (!@file_get_contents('php://input')) {
		// set reponse code - 200 OK
		http_response_code(400);

		// send data json 
		echo json_encode(array('code' => 400, 'message' => 'Lỗi không thể truy cập'));
		die();
	}
	$json = file_get_contents('php://input');
	$data_json = json_decode($json, true);
	if (trim($data_json['id']) != '' || trim($data_json['title']) != '') {
		$id = $data_json['id'];
		$name_category = $data_json['category'];
	} else {
		// set reponse code - 404
		http_response_code(400);
		// send data json 
		echo json_encode(array('code' => 400, 'message' => 'Lỗi không thể truy cập'));
		die();
	}

	$category->id_category($id);
	$check_id = $category->check_id();
	if ($check_id != 1) {
		// set reponse code - 404
		http_response_code(400);
		// send data json 
		echo json_encode(array('code' => 400, 'message' => 'Lỗi'));
		die();
	}
	$check_name = $category->check_name();
	if ($name_category != utf8tourl($check_name)) {
		// set reponse code - 404
		http_response_code(400);
		// send data json 
		echo json_encode(array('code' => 400, 'message' => 'Lỗi'));
		die();
	}
	$category->name_category($check_name);
	$query = $category->get_full();
	$i = 0;
	while ($row = mysqli_fetch_array($query)) {
		$data['result'][$i]['id'] = $row['post_id'];
		$data['result'][$i]['username'] = $row['username'];
		$data['result'][$i]['avatar'] = $row['avatar'];
		$data['result'][$i]['title'] = $row['title'];
		$data['result'][$i]['description'] = $row['description'];
		$data['result'][$i]['category'] = $row['category'];
		$data['result'][$i]['image'] = $row['image'];
		$data['result'][$i]['created'] = time_stamp($row['created_post']);
		$data['result'][$i]['link_post'] = utf8tourl($row['title'])."-".$row['post_id'].".html";
		$i++;
	}
	
	// set reponse code - 200 OK
	http_response_code(200);
	// send data json 
	echo json_encode($data);
?>