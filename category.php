<?php  
	include_once 'views/component/head.php';
	session_start();
	$name_category = $_GET['category'];
	$id = $_GET['id'];
?>
<!DOCTYPE html>
<html>
<head>
	<?php head('Danh mục | BK News') ?>
</head>
<body>
	<div class="header">
		<?php  
			include_once 'views/component/navbar.php';
			include_once 'views/component/sidebar.php';
		?>
	</div>	
	<div class="container-news" id="container">
		<div class="container-top" id="post_one">

		</div>
		<div class="col-1">
			<h4 id='name_category'>Không tồn tại danh mục</h4>
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
		data = {category: "<?php echo $name_category; ?>", id: <?php echo $id; ?>};
		fetch('api/category/read_post_category.php', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json',
			},
			body: JSON.stringify(data),
		})
		.then(response => response.json())
		.then(data => {
			var post_one = document.getElementById('post_one');
			var posts = document.getElementById('posts');
			var name_category = document.getElementById('name_category');
			var i = 0;
			for (a of data.result) {
				if (i == 0) {
					post_one.insertAdjacentHTML('beforeend','<div class="column" style="float: left;"><div class="post large"><a href="'+a.link_post+'" title="'+a.title+'"><img src="'+a.image+'" alt="'+a.title+'"><div class="black-post"></div></a></div></div><div class="column" style="float: right; background: #ffffff; color: #3f3f3f; box-shadow: 0 4px 6px rgb(68 68 106 / 18%), 0 1px 3px rgba(0, 0, 0, .08);"><div class="content"><div style="width: 310px; margin: 0 auto;"><h2>'+a.title+'</h2><p>'+a.description+'</p></div></div></div>')
				}else {
					name_category.innerHTML = a.category;
					posts.insertAdjacentHTML('beforeend',"<div class='news-card'><a href="+a.link_post+"><div class='card-blur' style='background: url("+a.image+") center center / cover'></div><div class='card-img' style='background: url("+a.image+") center center / cover'></div></a><p class='card-category'>"+a.category+"</p><a href="+a.link_post+"><div class='card-title'>"+a.title+"</div></a><div class='card-description'>"+a.description+"</div><div class='card-author'><div class='card-author-user'><div class='card-avatar-author' style='background: url("+a.avatar+") center center / cover'></div>"+a.username+"</div><div class='card-time'>"+a.created+"</div></div></div>");
				}
				i++;
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

		document.getElementById('category-sidebar').classList.add('active');
	</script>
	<script type="text/javascript" src="views/assets/js/scroll.js"></script>
	<script type="text/javascript" src="views/assets/js/category.js"></script>
</body>
</html>