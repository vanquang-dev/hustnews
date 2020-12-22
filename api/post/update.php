<?php 
	include_once '../config/database.php';
	include_once '../objects/post.php';
	
	$post = new Post();

	$post->post_id($_POST['id']);
	$post->title($_POST['title']);
	$post->description($_POST['description']);
	$post->detail_description($_POST['detail_description']);

	$post->update();
	http_response_code(200);
	echo json_encode('success');
?>