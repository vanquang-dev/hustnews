<?php  
echo '		<div class="navbar">
				<div class="search">
					<i class="gg-search"></i>
					<input type="text" id="search" placeholder="Tìm kiếm">
				</div>
				<div class="profile">
					<span class="name">'.$_SESSION["username"].'</span>
					<div class="avatar" style="background: url('.$_SESSION["avatar"].') center center / cover"></div>
				</div>
			</div>';
?>