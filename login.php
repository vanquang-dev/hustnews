<?php 
	session_start();
	if (isset($_SESSION['name'])) {
		echo "Hello pro";
		header('location: /bigex/');
		die();
	}
	include_once 'views/component/head.php';
	include_once 'api/facebook/fb-init.php';
	include_once 'api/google/google_source.php';
	
?>
<!DOCTYPE html>
<html>
<head>
	<?php head('Đăng nhập | Hust News'); ?>
</head>
<body style="background: url(views/assets/image/backgroud_login_admin.jpg) center center / cover;">
	<div class="black">
		<div class="navbar-account">
			<h1><a href="/bigex/" style="font-size: 40px; color: #ffffffad; font-family: ui-sans-serif;">Hust News</a></h1>
		</div>
		<div class="container-account">
			<h1 id="status">ĐĂNG NHẬP</h1>
		</div>
		<div class="login" style="width: 500px;">
			<form style="padding-top: 30px;">
				<div class="input-login" >
					<i class="gg-mail faa-pulse animated" style="top: 28px;left: 45px;"></i><input id="email" onchange="check_email()" class="input_login" type="email" placeholder="Email" style="width: 79%;">
				</div>
				<div class="input-login">
					<i class="gg-lock faa-pulse animated" style="top: 36px;left: 48px;"></i><input id="password"  class="input_login" type="password" placeholder="Password" style="width: 79%;">
				</div>
				<button id="login" type="button" style="margin-top: 10px; background: linear-gradient(45deg, rgb(19 105 170) 0%, rgb(24 101 118) 100%);">Đăng nhập</button>
				<div class="footer-login" style="position: absolute; top: 63%; left: 32px;">
	            	<a href="register" style="color: #673ab7; margin-right: 170px;">Bạn chưa có tài khoản?</a>
	            	<a href="#" style="color: #673ab7;">Quên mật khẩu?</a>
	            </div>
				<div class="social" style="margin-top: 30px;">
					<a href="<?php echo $login_url; ?>"><button id="login_fb" type="button">Đăng nhập với Facebook</button></a>
					<a href="<?php echo $authUrl; ?>"><button id="login_gg" type="button">Đăng nhập với Google</button></a>
				</div>
			</form>
		</div>
	</div>
	<script src="views/assets/js/user/login.js"></script>
</body>
</html>