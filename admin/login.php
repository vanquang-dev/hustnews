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
	<script>
		var input = document.getElementsByClassName('input_login');
		for (var i = 0; i < input.length; i++) {
			input[i].addEventListener("keyup", ()=>{
				if (event.keyCode === 13) {
					document.getElementById('login').click();
				}
			})
		}
		var login = document.getElementById('login');
		login.addEventListener('click',()=>{
			var email = document.getElementById('email').value;
			var password = document.getElementById('password').value;
			fetch('../api/login-admin/check.php',{
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
				},
				body: JSON.stringify({email: email, password: password}),
			})
			.then(response => response.json())
			.then(data => {
				var error = document.getElementById('error');
				if (data.code == 400) {
					error.innerHTML = data.message;
                    return;
				}
				if (data.code == 404) {
					error.classList.remove('display');
					return;
				}
				window.location = 'index.php';
			})
		})
		
	</script>
</body>
</html>