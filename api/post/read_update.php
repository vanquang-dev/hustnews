<?php
	include_once '../config/database.php';
	include_once '../objects/post.php';
	
	$post = new Post();
	$data = [];

	$id = $_POST['id'];
	$post->post_id($id);
	$row = $post->get_update();

	$data['result']['title'] = $row['title'];
	$data['result']['description'] = $row['description'];
	$data['result']['category'] = $row['category'];
	$data['result']['detail_description'] = $row['detail_description'];
	$data['result']['image'] = $row['image'];
	http_response_code(200);
	echo json_encode($data);
?>