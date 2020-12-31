<?php
    session_start();
    if (!@$_SESSION['admin_id']) {
        header('location: login.php');
    }
    include_once 'component/head.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    
    <?php head('Bảng quản trị | Gud News'); ?>
</head>

<body>
    <div class="container">
        <?php include_once 'component/sidebar.php'; ?>
        <div class="row">
            <?php include_once 'component/navbar.php'; ?>
            <div class="post-detail">
                <div class="main-post" style="margin: 0">
                    <button class="button-custom" style="border-radius: 0;">Thêm bài viết</button>
                    <button class="button-create ok" id="button_1">Lấy bài</button>
                    <button class="button-create" id="button_2">Tự thêm</button>

                    <div id="create_1">
                        <h3>Các bài báo mới nhất của Dân Trí</h3>
                        <div id="dantri" style="height: 476px; overflow-y: auto;">
                            <?php include_once 'crawl/dantri.php'; ?>
                        </div>
                    </div>

                    <div class="display" id="create_2">
                        <h3>Thêm bài viết</h3>
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
                        <div class="form-group">
                            <div id="summernote"></div>
                        </div>
                        <button type="button" id="submit" class="btn btn-primary">Tạo</button>
                    </div>
                </div>
            </div>
            <div class="post-detail">
                <div class="datatable">
                    <h3>Danh sách bài viết</h3>
                    <table  class="table" id="example" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th style="width: 23px;">ID</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Created</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Created</th>
                            <th></th>
                        </tr>
                        </tfoot>
                    </table>

                    <div class="modal fade" id="myModal" role="dialog">
                        <div class="modal-dialog">
                            <div id="content-data"></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include_once 'component/footer.php'; ?>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="../views/assets/js/admin/post.js"></script>
</body>

</html>