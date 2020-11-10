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
				<h3>Thống kê</h3>
			</div>
			<?php include_once 'component/footer.php'; ?>
		</div>
	</div>
	<script>
        document.getElementById('home-sidebar').classList.add('active');
    </script>
</body>
</html>