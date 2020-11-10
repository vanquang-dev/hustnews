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
	                <a href="hust">
		                <div class="menu-content" id="news-hust">
		                    <i class="gg-coffee" style="margin-left: 0;"></i> Hust
		                </div>
	                </a>
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
	<script>
		document.addEventListener('DOMContentLoaded', () => {
			var trangthai = 'true',
				sidebar = document.getElementById('sidebar'),
				big_logo = document.getElementById('big_logo');
				container = document.getElementById('container');
				var scroll = sidebar.offsetTop;
			window.addEventListener('scroll', () => {
				if (window.pageYOffset > scroll) {
					if (trangthai == 'true') {
						trangthai = 'false';
						big_logo.classList.add('display');
						sidebar.classList.add('sidebar-fixed');
						container.setAttribute('style', "margin-top: 290px;")
					} 
				} else if (window.pageYOffset <= scroll) {
					if(trangthai == 'false') {
						trangthai = 'true';
						big_logo.classList.remove('display');
						sidebar.classList.remove('sidebar-fixed');
						container.setAttribute('style', "")
					}
				}
			})
		});
		fetch('api/post/read_news.php', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json',
			}
		})
		.then(response => response.json())
		.then(data => {
			var posts = document.getElementById('posts');
			for (a of data.result) {
				posts.insertAdjacentHTML('beforeend',"<div class='news-card'><a href="+a.link_post+"><div class='card-blur' style='background: url("+a.image+") center center / cover'></div><div class='card-img' style='background: url("+a.image+") center center / cover'></div></a><p class='card-category'>"+a.category+"</p><a href="+a.link_post+"><div class='card-title'>"+a.title+"</div></a><div class='card-description'>"+a.description+"</div><div class='card-author'><div class='card-author-user'><div class='card-avatar-author' style='background: url("+a.avatar+") center center / cover'></div>"+a.username+"</div><div class='card-time'>"+a.created+"</div></div></div>");
			}
		})
		.catch((error) => {
          console.error('Error:', error);
        });

        fetch('api/post/popular.php', {
          method: 'POST', 
          headers: {
            'Content-Type': 'application/json',
          }
        })
        .then(response => response.json())
        .then(data => {
            var popular = document.getElementById('popular');
            popular.insertAdjacentHTML('beforeend',"<thead><tr id='title'><th>Tên bài viết</th><th id='like'> Lượt thích</th></tr></thead>");
            for (a of data.result) {
                popular.insertAdjacentHTML('beforeend',"<tbody><tr><td class='title'><a href="+a.link_post+">"+a.title+"</a></td><td class='like'>"+a.total_like+" <img class='heart' src='https://twemoji.maxcdn.com/2/72x72/2764.png' width='20'></td></tr></tbody>");
            }
        })
        .catch((error) => {
          console.error('Error:', error);
        });
		document.getElementById('home').classList.add('active');
	</script>
	<script type="text/javascript" src="views/assets/js/category.js"></script>
</body>
</html>