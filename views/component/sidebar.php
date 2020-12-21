		<div class="sidebar-news">
			<div class="menu-sidebar"  id="sidebar">
				<div class="menu-sidebar-news">
	                <a href="/bigex/">
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
	                			<a href="api/logout/logout.php">
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