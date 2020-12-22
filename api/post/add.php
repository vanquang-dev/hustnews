<?php  
	session_start();
	if (!@$_SESSION['admin_id']) {
		header('location: /index.php');
	}
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
	$json = file_get_contents('php://input');
	$data_json = json_decode($json, true);
	$url = $data_json['url'];
	error_reporting(0);
	$urll = parse_url($url);
	$host = $urll['host'];

    $html = file_get_html($url);
    $title = $html->find("meta[name=twitter:title]", 0)->content;
    $image = $html->find("meta[name=twitter:image]",0)->content;
    $description = $html->find("meta[name=twitter:description]",0)->content;
    $category = $html->find('ul[class=dt-breadcrumb] a',1)->innertext;
    $time = $html->find("span[dt-news__time]",0)->innertext;
    $detail_description = $html->find("div[class=dt-news__content]" ,0)->innertext;

    $tag = $html->find("div[class=news-tag]" ,0)->innertext;
    $author = $html->find("p[style=text-align:right]" ,0)->innertext;
    $title = str_replace('\\','',$title);
    $detail_description = str_replace(array($tag,$author),'',$detail_description);
    $detail_description = str_replace($figcaption_array,'',$detail_description);
    $description = str_replace(array("(Dân trí) - "),'',$description);
    $title = str_replace(array('"',"'","&quot;"),'',$title);

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