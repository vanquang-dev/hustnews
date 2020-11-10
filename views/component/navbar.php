		<div class="navbar" style="margin-bottom: 0;">
			<div class="logo-fixed">
				<a href="/bigex/"><h2>Hust News</h2></a>
			</div>
			<div class="search search-news">
				<i class="gg-search"></i>
				<input type="text" id="search" placeholder="Tìm kiếm">
			</div>
			<div class="profile profile-news">
				<?php 
					if (isset($_SESSION['user_id'])) {
						echo '
							<span class="name">'.$_SESSION["name"].'</span>
							<div class="avatar" style="background: url(https://media1.tenor.com/images/262a3bcb8471db0ee9d5131cce2b1a16/tenor.gif?itemid=8863336) center center / cover;"></div>
						';
					} else {
						echo '
							<a href="/bigex/login" class="button">Đăng nhập</a>
						';
					}
				?>
							
			</div>
		</div>