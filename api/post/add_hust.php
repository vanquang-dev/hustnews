<?php  
	session_start();
	
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json; chartset="UTF-8"');
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	// include object database and login
	include_once '../config/database.php';
	include_once '../objects/post.php';
	include_once 'up_img.php';
	include_once '../config/utf8tourl.php';
	include_once '../config/simple_html_dom.php';

	// post object
	$post = new Post();
	
	$url = 'https://www.hust.edu.vn/tin-tuc/-/asset_publisher/AKFI5qRls1e8/content/bach-khoa-ha-noi-va-evn-hop-tac-ua-nghien-cuu-vao-thuc-te';
	error_reporting(0);
	$urll = parse_url($url);
	$host = $urll['host'];
	if ($host == 'www.hust.edu.vn') {
	    $html = file_get_html($url);
		$title = $html->find("h3[class=header-title] span", 0)->innertext;
	    $image = $html->find("div[class=journal-content-article] img",0)->src;
	    $image = preg_replace('/[\/]documents[\/]/','https://www.hust.edu.vn/documents/',$image);
	    $description = $html->find("div[class=journal-content-article] em",0)->innertext;
	    $category = 'Hust';
	    $detail_description = $html->find("div[class=journal-content-article]", 0)->innertext;
	    $detail_description = preg_replace('/[\/]documents[\/]/','https://www.hust.edu.vn/documents/',$detail_description);
	    $tag = '<audio controls> <source alt="Audio" src="" /> </audio>';
	    $detail_description = str_replace($tag,'',$detail_description);

	    // echo $title;
	    // echo $image;
	    // echo $description;
	    echo $detail_description;
	    die();
	    
	}
	// input user
	$admin_id = $_SESSION['admin_id'];
	
	// add value input to obj
	$post->admin_id($admin_id);
	$post->image($image);
	$post->title($title);
	$post->description($description);
	$post->category($category);
	$post->detail_description(trim($detail_description));
	// add post
	$post->add();
	$check_category = $post->check_category();
	if ($check_category == 0) {
		if ($category != '') {
			$post->add_category();
		}
	}
	http_response_code(200);
	echo json_encode(array('code' => 200));
?>