<?php  
	session_start();
	if (!@$_SESSION['admin_id']) {
		header('Location: login.php');
	}
	$id = $_GET['id'];
	include_once 'component/head.php';
?>
<html lang="en">
  <head>
  <meta charset="UTF-8">
  <?php head('Update | BK News') ?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  </head>
  <body>
  	<div class="container">
		<?php include_once 'component/sidebar.php'; ?>
		<div class="row">
			<?php include_once 'component/navbar.php'; ?>
			<div class="main-post" style="margin: 0;">
			<h3>Sửa bài viết</h3>
			<form enctype="multipart/form-data" method="POST">
			<div class="form-group">
				<input type="text" class="form-control" id="title" placeholder="Tiêu đề">
			</div>
			<div class="form-group">
				<textarea class="form-control" id="description" placeholder="Mô tả"></textarea>
			</div>
			<div class="form-group">
				<label class="form-control" for="image">Chọn ảnh</label>
				<input type="file" class="display" id="image">
				<div class="box-pre-img display"></div>
			</div>
			<div class="form-group image_summernote">
				<div id="summernote"></div>
			</div>
			<input type="hidden" id="post_id" value="<?php echo $id; ?>">
			<button type="button" id="submit" class="btn btn-primary">Lưu</button>
		</form>
			<?php include_once 'component/footer.php'; ?>
			
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
	<script src="../views/assets/js/admin/update.js"></script>
  </body>
</html>