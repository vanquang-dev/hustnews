$(document).ready(function() {
    /*
     *===========Giao diện=============
     */
    var button_1 = $('#button_1');
    var button_2 = $('#button_2');

    var create_1 = $('#create_1');
    var create_2 = $('#create_2');

    button_1.click(function() {
        button_1.addClass('ok');
        create_1.removeClass('display');
        button_2.removeClass('ok');
        create_2.addClass('display');
    })

    button_2.click(function() {
        button_2.addClass('ok');
        create_2.removeClass('display');
        button_1.removeClass('ok');
        create_1.addClass('display');
    })
    /*
     * ------------Summernote-----------------
     */
     
    $('#summernote').summernote({
        placeholder: 'Chi tiết bài viết ',
        height: 300,
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
    });

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

    /*
     * ------------Lấy bài viết-----------------
     */
    var dom = document.getElementsByClassName('hihi');
    for (a of dom) {
        get_link(a);
    }

    function get_link(a) {
        a.addEventListener('click', () => {
            add_post(a.getAttribute('data-link'));
            a.classList.add('success');
            return false;
        })
    }

    function add_post(link) {
        data = { url: link };
        // add post user
        fetch('../api/post/add.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
            })
            .then(response => response.json())
            .then(data => {})
            .catch((error) => {
                console.error('Error:', error);
            });
    }

    /*
     *===============Thêm bài viết===============
     */
    $('#submit').click(function() {
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
    /*
     * ------------Datatable-----------------
     */

    $('#example').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            url: "../api/post/read.php",
            type: "post"
        }
    });

    function destroy(id) {
        data = { id: id };
        fetch('../api/post/destroy.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
            })
            .then(response => response.json())
            .then(data => {
                location.reload()
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    }

    $('#post-sidebar').addClass('active');
})