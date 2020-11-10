<?php  
	session_start();
	if (!@$_SESSION['admin_id']) {
		header('Location: login.php');
	}
	include_once 'component/head.php';
?>
<!DOCTYPE html>
<html>
<head>
	<?php head('Quản trị | BK News') ?>
</head>
<body>
	<div class="container">
		<?php include_once 'component/sidebar.php'; ?>
		<div class="row">
			<?php include_once 'component/navbar.php'; ?>
			<div class="main-post" style="margin: 0;">
				<h2>Thêm thành viên</h2>
				<input type="text" class="input-editor" id="username" placeholder="Username">
				<input type="email" class="input-editor" id="email" placeholder="Email">
				<input type="password" class="input-editor" id="password" placeholder="Password">
				<button id="submit" class="button-editor">Thêm tài khoản</button>
				<div id="error" class="display"></div>
			</div>
			<div class="main-post" style="margin: 0;">
				<h2>Danh sách thành viên</h2>
				<table id="editor"></table>
			</div>
			
			<?php include_once 'component/footer.php'; ?>
		</div>
	</div>
	<script>
		var input = document.getElementsByClassName('input-editor');
		for (var i = 0; i < input.length; i++) {
			input[i].addEventListener("keyup", ()=>{
				if (event.keyCode === 13) {
					document.getElementById('submit').click();
				}
			})
		}
		var submit = document.getElementById('submit');
		submit.addEventListener('click',()=>{
			var username = document.getElementById('username').value;
			var email = document.getElementById('email').value;
			var password = document.getElementById('password').value;
			fetch('../api/editor/add.php',{
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
				},
				body: JSON.stringify({username: username, email: email, password: password}),
			})
			.then(response => response.json())
			.then(data => {
				var error = document.getElementById('error');
				error.innerHTML = "";
				if (data.code == 200) {
					error.classList.remove('display');
					error.innerHTML = data.message;
					document.getElementById("username").value = "";
					document.getElementById("email").value = "";
					document.getElementById("password").value = "";
					get_list_editor();
					return;
				}
				if (data.code == 404 ) {
					error.classList.remove('display');
					error.innerHTML = data.message;
					return;
				}
			})
		})
		function get_list_editor() {
			fetch('../api/editor/read.php', {
				method: 'POST',
				header: {
					'Content-Type': 'application/json',
				}
			})
			.then(response => response.json())
			.then(data => {
				var editor = document.getElementById('editor');
				editor.innerHTML = '';
				editor.insertAdjacentHTML('beforeend', "<tr id='title'><th>Họ tên</th><th>Email</th><th id='like'>Tuỳ chọn</th></tr>");
				for (a of data.result) {
					editor.insertAdjacentHTML('beforeend', "<tr><td>"+a.username+"</td><td>"+a.email+"</td><td><button onclick='lock_editor("+a.id+")' class='button-delete'>"+a.status+"</button></td></tr>");
				}
			})
			.catch((error) => {
				console.error('Error:', error);
			});
		}
		get_list_editor();
        document.getElementById('editor-sidebar').classList.add('active');
    </script>
</body>
</html>