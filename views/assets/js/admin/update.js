$(document).ready(function() {
    $('#summernote').summernote({
        placeholder: 'Chi tiết bài viết ',
        height: 500,
        minHeight: null,
        maxHeight: null,
        focus: true,
        callbacks: {
            onImageUpload: function(files) {
                for (var i = 0; i < files.length; i++) {
                    upFile(files[i]);
                }
            }
        }
    })

    function upFile(file) {
        if (file.type.includes('image')) {
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
                    success: function(response) {
                        if (response.is_ok) {
                            $('#summernote').summernote('insertImage', response.url, name);
                        } else {
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
    var post_id = $('#post_id').val();
	function get_post() {
    data = { id: post_id };
        $.ajax({
                url: '../api/post/read_update.php',
                type: 'POST',
                dataType: 'json',
                data: data
            })
            .done(function(data) {
                $('#title').val(data.result.title);
                $('#description').val(data.result.description);
                $('.box-pre-img').removeClass('display');
                $('.box-pre-img').append('<img src="' + data.result.image + '" style="width: 150px;">');
                $('#summernote').summernote('code', data.result.detail_description);
            })
            .fail(function(error) {})
    }
    get_post();

    $('#submit').click(() => {
    	var title = $('#title').val();
        var description = $('#description').val();
        var detail_description = $('#summernote').summernote('code');
        data = { id: post_id, title: title, description: description, detail_description: detail_description }
        $.ajax({
                url: '../api/post/update.php',
                type: 'POST',
                dataType: 'json',
                data: data
            })
            .done(function(data) {
                location.replace("post.php");
            })
            .fail(function(error) {})
    })
    $('#image').change(function() {
        img_up = $('#image').val();
        count_img_up = $('#image').get(0).files.length;
        $(".box-pre-img").children().remove();

        // Nếu đã chọn ảnh
        if (img_up != '') {
            $('.box-pre-img').removeClass('display');
            for (i = 0; i <= count_img_up - 1; i++) {
                $('.box-pre-img').append('<img src="' + URL.createObjectURL(event.target.files[i]) + '" style="width: 150px;">');
            }
        }
        // Ngược lại chưa chọn ảnh
        else {
            $('.box-pre-img').html('');
        }
    });
});