<?php
	header('Access-Control-Allow-Origin: *');
	include_once '../config/database.php';
	include_once '../objects/post.php';
	$post = new Post();
	$data = [];
	
	if (trim($_POST['title']) != '' || trim($_POST['description']) != '' || trim($_POST['detail_description']) != '') {
		$title = $_POST['title'];
		$description = $_POST['description'];
		$detail_description = $_POST['detail_description'];
	} else {
		http_response_code(400);
		echo json_encode(array('code' => 400, 'message' => 'Lỗi không thể truy cập'));
		die();
	}
	
	$post->title($title);
	$post->description($description);
	$post->detail_description($detail_description);
	$post->image('https://icdn.dantri.com.vn/zoom/1200_630/2020/11/26/xebienxanh-80-sbikhoabanhosanbaytansonnhatdathaobienso-21606371134416-1606374987275.jpg');
	$post->add_post();
	http_response_code(200);
	echo json_encode('success');
?>