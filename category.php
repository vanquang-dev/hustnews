<?php  
	include_once 'views/component/head.php';
	session_start();
	$name_category = $_GET['category'];
	$id = $_GET['id'];
?>
<!DOCTYPE html>
<html>
<head>
	<?php head('Danh mục | BK News') ?>
</head>
<body>
	<div class="header">
		<?php  
			include_once 'views/component/navbar.php';
			include_once 'views/component/sidebar.php';
		?>
	</div>	
	<div class="container-news" id="container">
		<div class="container-top" id="post_one">

		</div>
		<div class="col-1">
			<h4 id='name_category'>Không tồn tại danh mục</h4>
			<div id="posts">
			</div>
		</div>
		<div class="col-2">
			<h4>Bài viết nổi bật</h4>
			<table id="popular"></table>
		</div>
		<div class="clear"></div>
		<?php include_once 'views/component/footer.php'; ?>
	</div>
	<script type="text/javascript" src="views/assets/js/scroll.js"></script>
	<script type="text/javascript" src="views/assets/js/user/category.js"></script>
	<script>
		data = {category: "<?php echo $name_category; ?>", id: <?php echo $id; ?>};
		
	</script>
	<script src="views/assets/js/user/category.js"></script>
</body>
</html>