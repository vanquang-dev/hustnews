<?php  
	include_once 'views/component/head.php';
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<?php head('Trang chủ | HUST News') ?>
</head>
<body>
	<div class="header">
		<?php  include_once 'views/component/navbar.php'; ?>
		<div class="sidebar-news">
			<div class="logo" id="big_logo">
				<a href="/bigex/">
					<h1 style="color: #5849aa;">Hust News</h1>
				</a>
				<p>Web tin tức trong ngày do đội ngũ nhóm 9 xây dựng.</p>
			</div>
			<div class="menu-sidebar"  id="sidebar">
				<div class="menu-sidebar-news">
	                <a href="">
	                    <div class="menu-content" id="home">
	                        <i class="gg-home-alt"></i> Trang chủ
	                    </div>
	                </a>
	                <div class="menu-content" id="news-hot">
	                    <i class="gg-alarm" style="margin-left: 0;"></i> Tin hot
	                </div>
	                <div class="menu-content" id="category-sidebar">
	                    <i class="gg-list"></i> Danh mục
	                    <div class="menu-category display" id="menu-category">
	                    	<ul>
	                    		<?php include_once 'api/category/read_category.php'; ?>
	                    	</ul>
	                    </div>
	                </div>
	                <div class="menu-content">
	                    <i class="gg-calendar-due"></i> Liên hệ
	                </div>
	                <div class="menu-content">
	                    <i class="gg-awards"></i> Về chúng tôi
	                </div>
	                <?php 
	                	if (isset($_SESSION['user_id'])) {
	                		echo '
	                			<a href="api/logout/logout.php" style="color:#9a0000;">
									<div class="menu-content">
										<i class="gg-log-off"></i> Đăng xuất
									</div>
								</a>
	                		';
	                	}
	                ?>
	            </div>
			</div>	
		</div>
	</div>		
	<div class="container-news" id="container">
		<div class="container-top">
			<?php include_once 'api/post/read_three.php'; ?>
		</div>
		<div class="col-1">
			<h4>Bài viết mới nhất</h4>
			<div id="posts">
			</div>
		</div>
		<div class="col-2">
			<h4>Bài viết nổi bật</h4>
			<table id="popular"></table>
		</div>
		<div class="clear"></div>
		<?php include_once 'views/component/footer.php'; ?>
	</div>
	<script src="views/assets/js/user/index.js"></script>
	<script type="text/javascript" src="views/assets/js/scroll.js"></script>
</body>
</html>