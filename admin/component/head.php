<?php 
	function head(
	    $title,
	    $description = "Một trang web tin tức nhanh, tổng hợp từ các nguồn báo chính thống. Đồng thời có chức năng điểm tin, giúp người dùng tiếp nhận thông tin một cách nhanh nhất."
	) {
		echo '
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="shortcut icon" href="https://images-na.ssl-images-amazon.com/images/I/515cl%2B02yjL.png">
		<title>'.$title.'</title>
		<!-- Style -->
		<link rel="stylesheet" href="../views/assets/css/style.css">
	    <link rel="stylesheet" href="../views/assets/css/css.css">
	    <link rel="stylesheet" href="../views/assets/css/animation.min.css">
	    <style>
	        .logo {
	            padding: 25px 25px !important;
	        }
	        .menu-sidebar {
	            padding-left: 25px;
	        }
	        .sidebar a {
	            color: #fff !important;
	        }
	    </style>
	    ';

	}
?>