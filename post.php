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
	<div class="header">
		<?php  
			include_once 'views/component/navbar.php';
			include_once 'views/component/sidebar.php';
		?>
	</div>		
	<div class="container-news">
		<div class="row" style="float: inherit; margin: 0 auto;">
			<div class="post-detail">
				<div class="post-img" id="image" style="background:url(https://steamuserimages-a.akamaihd.net/ugc/929298290925291486/9ED16A3C6C201FC08347BBCD3AF08A11124483AD/) center center / cover">
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
	<script>
		data = {title: "<?php echo $title; ?>", id: <?php echo $id; ?>};
		fetch('api/post/read_post_detail.php', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json',
			},
			body: JSON.stringify(data),
		})
		.then(response => response.json())
		.then(data => {
			var image = document.getElementById('image');
			var title = document.getElementById('title_detail');
			var created = document.getElementById('created');
			var username = document.getElementById('username');
			var avatar = document.getElementById('avatar');
			var detail = document.getElementById('detail');
            var category = document.getElementById('category');

			image.setAttribute('style', "background: url("+data.result.image+") center center / cover")
			title.innerHTML = data.result.title;
			created.innerHTML = data.result.created;
			category.innerHTML = data.result.category;
			username.innerHTML = data.result.username;
			avatar.setAttribute('style', "background: url("+data.result.avatar+") center center / cover")
			detail.innerHTML = data.result.detail_description;
			document.title = data.result.title + " | BK News"
			
		})
		.catch((error) => {
          console.error('Error:', error);
        });

        var category = 'xã hội';
        data1 = {title: "<?php echo $title; ?>", id: <?php echo $id; ?>,category: category};
        fetch('api/post/read_news_docs.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data1),
        })
        .then(response => response.json())
        .then(data => {
            var new_docs = document.getElementById('new-docs');
            for (a of data.result) {
                new_docs.insertAdjacentHTML('beforeend',"<div class='news-card' style='width:292px;'><a href="+a.link_post+"><div class='card-blur' style='background: url("+a.image+") center center / cover'></div><div class='card-img' style='background: url("+a.image+") center center / cover'></div></a><p class='card-category'>Xã hội</p><a href="+a.link_post+"><div class='card-title'>"+a.title+"</div></a><div class='card-description'>"+a.description+"</div><div class='card-author'><div class='card-author-user'><div class='card-avatar-author' style='background: url("+a.avatar+") center center / cover'></div>"+a.username+"</div><div class='card-time'>"+a.created+"</div></div></div>");
            }
        })
        .catch((error) => {
          console.error('Error:', error);
        });

        var comment = document.getElementById('comment-button');
        var like = document.getElementById('like-button');
        var total = document.getElementById('like-total');
        like.addEventListener('click',() => {
            data = {id: <?php echo $id; ?>};
            // add like user
            fetch('api/like/add.php', {
                method: 'POST', 
                headers: {
                'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
            })
            .then(response => response.json())
            .then(data => {
                var like = document.getElementById('like-button');
                var total = document.getElementById('like-total');
                if (data.code == 400) {
                    return false;
                }
                if (data.message != 'unlike') {
                    like.setAttribute('style','filter: none');
                    total.innerHTML = data.like_total + " lượt thích";
                } else {
                    like.setAttribute('style','');
                    total.innerHTML = data.like_total + " lượt thích";
                }                
            })
            .catch((error) => {
              console.error('Error:', error);
            });
        });

        data_like = {id: <?php echo $id; ?>};
        // check like
        fetch('api/like/check.php', {
            method: 'POST', 
            headers: {
            'Content-Type': 'application/json',
            },
            body: JSON.stringify(data_like),
        })
        .then(response => response.json())
        .then(data => {
            var like = document.getElementById('like-button');
            var total = document.getElementById('like-total');
            if (data.message != 'unlike') {
                like.setAttribute('style','filter: none');
            } else {
                like.setAttribute('style','');
            }
            total.innerHTML = data.like_total + " lượt thích";              
        })
        .catch((error) => {
          console.error('Error:', error);
        });

        comment.addEventListener('click',() => {
            var content = document.getElementById('content').value;
            data = {id: <?php echo $id; ?>,content: content};
            // add post user
            fetch('api/comment/add.php', {
                method: 'POST', 
                headers: {
                'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
            })
            .then(response => response.json())
            .then(data => {
                get_comment_id();
                document.getElementById('content').value = '';
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        });

        function get_comment_id() {
            data = {id: <?php echo $id; ?>};
            fetch('api/comment/read-me.php', {
                method: 'POST', 
                headers: {
                'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
            })
            .then(response => response.json())
            .then(data => {
                show_comment(data);
            })
            .catch((error) => {
              console.error('Error:', error);
            });
        }
        // show all comment
        function show_comment(comment_id){
            data = {id: <?php echo $id; ?>};
            fetch('api/comment/read.php', {
                method: 'POST', 
                headers: {
                'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
            })
            .then(response => response.json())
            .then(data => {
                var comment = document.getElementById('all-comments');
                comment.innerHTML = '';
                for (a of data.result) {
                    if (comment_id.result.id.indexOf(a.id) == -1) {
                        comment.insertAdjacentHTML('beforeend',"<div class='comment'><div class='content-comment'><h5>"+a.name+" - "+a.created+"</h5><p>"+a.content+"</p><div class='avatar-comment' style='background: url("+a.avatar+") center center / cover;'></div></div>");
                    } else {
                        comment.insertAdjacentHTML('beforeend',"<div class='comment'><div class='content-comment'><h5>"+a.name+" - "+a.created+"</h5><p>"+a.content+"</p><div class='avatar-comment' style='background: url("+a.avatar+") center center / cover;'></div><div onclick='remove_comment("+a.id+")' class='remove-comment'>x</div></div></div>");
                    }
                }
            })
            .catch((error) => {
              console.error('Error:', error);
            });
        }

        function remove_comment(id) {
            data = {id: id};
            fetch('api/comment/delete.php', {
                method: 'POST', 
                headers: {
                'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
            })
            .then(response => response.json())
            .then(data => {
                get_comment_id();
            })
            .catch((error) => {
              console.error('Error:', error);
            });
        }
        get_comment_id();
	</script>
	<script type="text/javascript" src="views/assets/js/scroll.js"></script>
	<script type="text/javascript" src="views/assets/js/category.js"></script>
</body>
</html>