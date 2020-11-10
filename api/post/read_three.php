<?php
	// include object database and login
	include_once 'api/config/database.php';
	include_once 'api/config/time.php';
	include_once 'api/config/utf8tourl.php';
	include_once 'api/objects/post.php';
	
	// dashboard login object
	$post = new Post();
	$data = [];
	$query = $post->get_post_new();
	$i = 0;
	while ($row = mysqli_fetch_array($query)) {
		$data['result'][$i]['id'] = $row['post_id'];
		$data['result'][$i]['title'] = $row['title'];
		$data['result'][$i]['description'] = $row['description'];
		$data['result'][$i]['image'] = $row['image'];
		$data['result'][$i]['category'] = $row['category'];
		// $data['result'][$i]['created'] = time_stamp($row['created_post']);
		$data['result'][$i]['link_post'] = utf8tourl($row['title'])."-".$row['post_id'].".html";
		$i++;
	}
	echo '
		<div class="column" style="float: left;">
				<a href="'.$data['result'][0]['link_post'].'" title="'.$data['result'][0]['title'].'">
					<div class="post large">
						
							<img src="'.$data['result'][0]['image'].'" alt="">
							<div class="black-post" style="height: 100%; top: 0;"></div>
						
					</div>
					<div class="content_box">
						<ul class="post_category">
							<li class="category">
								<a href="">'.$data['result'][0]['category'].'</a>
							</li>
						</ul>
						<a href="'.$data['result'][0]['link_post'].'" title="'.$data['result'][0]['title'].'">
							<h2>'.$data['result'][0]['title'].'</h2>
							<p>'.$data['result'][0]['description'].'</p>
						</a>
					</div>
				</a>
			</div>
			<div class="column" style="float: right;">
				<a href="'.$data['result'][1]['link_post'].'" title="'.$data['result'][1]['title'].'">
					<div class="post small">
							<img src="'.$data['result'][1]['image'].'" alt="">
							<div class="black-post"></div>
						<div class="content_box">
							<ul class="post_category">
								<li class="category">
									<a href="">'.$data['result'][1]['category'].'</a>
								</li>
							</ul>
							<a href="'.$data['result'][1]['link_post'].'" title="'.$data['result'][1]['title'].'">
							<h5>'.$data['result'][1]['title'].'</h5>
							</a>
						</div>
					</div>
				</a>
				<a href="'.$data['result'][2]['link_post'].'" title="'.$data['result'][2]['title'].'">
					<div class="post small">
							<img src="'.$data['result'][2]['image'].'" alt="">
							<div class="black-post"></div>
						<div class="content_box">
							<ul class="post_category">
								<li class="category">
									<a href="">'.$data['result'][2]['category'].'</a>
								</li>
							</ul>
							<a href="'.$data['result'][2]['link_post'].'" title="'.$data['result'][2]['title'].'">
								<h5>'.$data['result'][2]['title'].'</h5>
							</a>
						</div>
					</div>
				</a>
			</div>
	';
?>