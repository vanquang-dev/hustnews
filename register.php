<?php 
	session_start();
	if (isset($_SESSION['name'])) {
		echo "Hello pro";
		header('location: /bigex/');
		die();
	}
	include_once 'views/component/head.php';
?>
<!DOCTYPE html>
<html>
<head>
	<?php head('Đăng ký | Hust News'); ?>
</head>
<body style="overflow: hidden; background: url(views/assets/image/backgroud_login_admin.jpg) center center / cover;">
	<div class="black">
		<div class="navbar-account">
			
				<h1><a href="/bigex/" style="font-size: 40px; color: #ffffffad; font-family: ui-sans-serif;">Hust News</a></h1>
			
		</div>
		<div class="container-account">
			<h1 id="status">ĐĂNG KÝ</h1>
		</div>
		<div class="login">
			<form method="post" style="padding-top: 30px; padding-bottom: 30px;">
	        	<div class="input-login input-register">
	        		<i class="gg-user faa-pulse animated"></i><input id="name" type="text" placeholder="Họ tên">
	        	</div>
	            <div class="input-login input-register">
	                <i class="gg-mail faa-pulse animated" style="top: 28px;"></i><input id="email" onchange="check_email()" type="email" placeholder="Email">
	            </div>
	            <div class="input-login input-register">
	                <i class="gg-lock faa-pulse animated" style="top: 33px;"></i><input id="password" onkeyup="check_pass()" type="password" placeholder="Mật khẩu">
	            </div>
	            <div class="input-login input-register">
	                <i class="gg-lock faa-pulse animated" style="top: 33px;"></i><input id="repassword" onkeyup="check_repass()" type="password" placeholder="Nhập lại mật khẩu">
	            </div>
	            <button type="button" id="register" style="background: linear-gradient(45deg, rgb(19 170 110) 0%, rgb(27 124 145) 100%);">Tiếp tục</button>
	            <div class="footer-login">
	            	<a href="login" style="color: #673ab7;">Bạn đã có tài khoản?</a>
	            </div>
	        </form>
		</div>
	</div>
    <script src="views/assets/js/user/register.js"></script>
</body>
</html>