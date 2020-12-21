<?php 
	session_start();
	if (@$_SESSION['admin_id']) {
		header('location: index.php');
		die();
	}
	include_once 'component/head.php';
?>
<!DOCTYPE html>
<html>
<head>
	<?php head('Đăng nhập | Hust News'); ?>
</head>
<body style="overflow: hidden; background: url(../views/assets/image/backgroud_login_admin.jpg) center center / cover;">
	<div class="black">
		<div class="navbar-account">
			<a href="../">
				<h1 style="font-size: 40px; color: #ffffffad; font-family: ui-sans-serif;">Hust News</h1>
			</a>
		</div>
		<div class="container-account">
			<h1>ĐĂNG NHẬP QUẢN TRỊ</h1>
		</div>
		<div class="login">
			<form style="padding-top: 30px;">
				<div class="input-login" >
					<i class="gg-mail faa-pulse animated"></i><input id="email" class="input_login" type="email" placeholder="Email">
				</div>
				<div class="input-login">
					<i class="gg-lock faa-pulse animated"></i><input id="password"  class="input_login" type="password" placeholder="Password">
				</div>
				<div class="error display" id="error">Tài khoản hoặc mật khẩu không chính xác. </div>
				<button id="login" type="button">Đăng nhập</button>
			</form>
		</div>
	</div>
	<script src="../views/assets/js/admin/login.js"></script>
</body>
</html>