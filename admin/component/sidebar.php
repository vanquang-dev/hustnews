<?php  
echo '<div class="sidebar admin">
			<div class="bg-black-admin">
				<div class="bg-black-admin">
					<div class="logo">
						<a href="index.php">
							<h1> Hust News </h1>
						</a>
					</div>
					<div class="menu-sidebar">
						<a href="index.php">
							<div class="menu-content" id="home-sidebar">
								<i class="gg-home-alt"></i> Tổng quan
							</div>
						</a>

						<a href="#">
							<div class="menu-content" id="category-sidebar">
								<i class="gg-stack"></i> Danh mục
							</div>
						</a>

						<a href="post.php">
							<div class="menu-content" id="post-sidebar">
								<i class="gg-list"></i> Bài viết
							</div>
						</a>

						<a href="editor.php">
							<div class="menu-content" id="editor-sidebar">
								<i class="gg-calendar-due"></i> Biên tập viên
							</div>
						</a>

						<a href="#">
							<div class="menu-content" id="user-sidebar">
								<i class="gg-user-list"></i> Thành viên
							</div>
						</a>

					</div>
					<div style="padding-right: 30px; padding-left: 25px;">
						<a href="../api/logout/logout.php">
							<div class="logout">
								<i class="gg-log-off"></i> Đăng xuất
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>';
?>