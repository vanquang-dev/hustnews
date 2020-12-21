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
    <script src="../views/assets/js/admin/editor.js"></script>
</body>
</html>