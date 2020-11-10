<?php
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json; chartset="UTF-8"');

	// include object database and login
	include_once '../config/database.php';
	include_once '../config/time.php';
	include_once '../config/utf8tourl.php';
	include_once '../objects/post.php';
	
	// dashboard login object
	$post = new Post();
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
	if (trim($data_json['id']) != '' || trim($data_json['title']) != '' || trim($data_json['category']) != '') {
		$id = $data_json['id'];
		$title = $data_json['title'];
		$category = $data_json['category'];
	} else {
		// set reponse code - 404
		http_response_code(400);
		// send data json 
		echo json_encode(array('code' => 400, 'message' => 'Lỗi không thể truy cập'));
		die();
	}
	$post->category($category);
	$query = $post->get_post_docs();
	$i = 0;
	while ($row = mysqli_fetch_array($query)) {
		if ($id != $row['post_id']) {
			$data['result'][$i]['id'] = $row['post_id'];
			$data['result'][$i]['username'] = $row['username'];
			$data['result'][$i]['avatar'] = $row['avatar'];
			$data['result'][$i]['title'] = $row['title'];
			$data['result'][$i]['description'] = $row['description'];
			$data['result'][$i]['image'] = $row['image'];
			$data['result'][$i]['created'] = time_stamp($row['created_post']);
			$data['result'][$i]['link_post'] = utf8tourl($row['title'])."-".$row['post_id'].".html";
			$i++;
		}
		
	}
	// set reponse code - 200 OK
	http_response_code(200);
	// send data json 
	echo json_encode($data);
?>