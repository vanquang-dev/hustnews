<?php  
	include_once 'views/component/head.php';
	session_start();
	$id = $_GET['id'];
	$title = $_GET['title'];
?>
<!DOCTYPE html>
<html>
<head>
	<?php head('Bài viết chi tiết | BK News') ?>
</head>
<body>
    <input type="hidden" id="post_id_url" value="<?php echo $id; ?>">
    <input type="hidden" id="title_url" value="<?php echo $title; ?>">
	<div class="header">
		<?php  
			include_once 'views/component/navbar.php';
			include_once 'views/component/sidebar.php';
		?>
	</div>		
	<div class="container-news">
		<div class="row" style="float: inherit; margin: 0 auto;">
			<div class="post-detail">
				<div class="post-img" id="image" style="background:url(https://i2.wp.com/tienganhonline.com/wp-content/uploads/2018/04/1.jpg?resize=589%2C386&ssl=1) center center / cover">
					<h1 id="title_detail">Không tồn tại bài viết này</h1>
				</div>
				<div class="main-post">
					<div class="card-author-user" style="height: 80px;">
						<div style="float: left;">
							<a href="index.php" style="float: left;">BK News &nbsp;=>&nbsp; </span>
							<div class="category"><a href="" id="category"></a></div>
						</div>
						<div style="float: right;">
							<div class="card-avatar-author" id="avatar"></div>
							<span id="username"></span> - <span id="created"></span>
						</div>
					</div>
					<div id="detail"></div>
					<div class="like-button"><img src="https://twemoji.maxcdn.com/2/72x72/2764.png" id="like-button" width="20" alt="like"><span id="like-total"></span></div>
					<h2>Bình luận</h2>
					<div class="comments">
						<?php include_once 'views/component/comment.php'; ?>
						<div id="all-comments"></div>
                	</div>
				</div>
			</div>
            <div class="new-docs" id="new-docs"></div>
            <?php include_once 'views/component/footer.php'; ?>
		</div>
	</div>
	<script src="views/assets/js/scroll.js"></script>
    <script src="views/assets/js/user/post.js"></script>
</body>
</html>