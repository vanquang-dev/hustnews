<?php  
	session_start();
	if (!@$_SESSION['admin_id']) {
		header('Location: login.php');
	}
	include_once 'component/head.php';
?>
<html lang="en">
  <head>
  <meta charset="UTF-8">
  <?php head('Create | BK News') ?>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
  </head>
  <body>
  	<div class="container">
		<?php include_once 'component/sidebar.php'; ?>
		<div class="row">
			<?php include_once 'component/navbar.php'; ?>
			<div class="main-post" style="margin: 0;">
			<h3>Thêm bài viết</h3>
			<form enctype="multipart/form-data" method="POST">
			<div class="form-group">
				<input type="text" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Tiêu đề">
			</div>
			<div class="form-group">
				<input type="text" class="form-control" id="description" placeholder="Mô tả">
			</div>
			<div class="form-group">
				<label class="form-control" for="image">Chọn ảnh</label>
				<input type="file" class="display" id="image">
				<div class="box-pre-img display"></div>
			</div>
			<div class="form-group">
				<div id="summernote"></div>
			</div>

			<button type="button" id="submit" class="btn btn-primary">Tạo</button>
		</form>
			<?php include_once 'component/footer.php'; ?>
			
		</div>
	</div>
    
    <script>
    	$(document).ready(function() {
		    $('#summernote').summernote({
		        placeholder: 'Chi tiết bài viết ',
		        height: 500,
		        minHeight: null,
		        maxHeight: null,
		        focus: true,
		        callbacks: {
		            onImageUpload: function(files)
		            {
		                for(var i = 0; i < files.length; i++)
		                {
		                    upFile(files[i]);
		                }
		            }
		        }
		    });
		});
			
		function upFile(file) {
		    if(file.type.includes('image')) {
		        var name = file.name.split(".");
		        name = name[0];  
		        var data = new FormData();
		        data.append('file', file);
		        $.ajax({
		            url: '../api/post/upload_images.php',
		            type: 'POST',
		            contentType: false,
		            cache: false,
		            processData: false,
		            dataType: 'JSON',
		            data: data,
		            success: function (response) 
		            {
		                if(response.is_ok)
		                {
		                    $('#summernote').summernote('insertImage', response.url, name);
		                }
		                else
		                {
		                    console.log(response.error);
		                }
		            }
		        })
		        .fail(function(e) {
		            console.log(e);
		        });
		    } else {
		        console.log("Đừng cố tải cái gì lên khác ngoài ảnh :>");
		    }
		}
    </script>
    <script>
    	
		$('#submit').click(() => {
			
			var title = $('#title').val();
			var description = $('#description').val();
			var detail_description = $('#summernote').summernote('code');

			$.ajax({
				url: '../api/post/add_post.php',
				type: 'POST',
				dataType: 'json',
				data: {
					title: title,
					description: description,
					detail_description: detail_description
				}
			})
			.done(function(data) {
				title.val('');
				description.val('');
				$('#summernote').val('');
				swal("Thành công", data.message, "success");
			})
			.fail(function (error) {
	        })
		})

		$('#image').change(function(){
		    img_up = $('#image').val();
		    count_img_up = $('#image').get(0).files.length;
		    $(".box-pre-img").children().remove();
		 
		    // Nếu đã chọn ảnh
		    if (img_up != '')
		    {
		        $('.box-pre-img').removeClass('display');
		        for (i = 0; i <= count_img_up - 1; i++)
		        {
		            $('.box-pre-img').append('<img src="' + URL.createObjectURL(event.target.files[i]) + '" style="width: 150px;">');
		        }
		    } 
		    // Ngược lại chưa chọn ảnh
		    else
		    {
		        $('.box-pre-img').html('');
		    }
		});
	    	
    </script>
  </body>
</html>