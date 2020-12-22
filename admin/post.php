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
                    <h3>Các bài báo mới nhất của Dân Trí</h3>
                    <div id="dantri" style="height: 476px; overflow-y: auto;">
                        <?php include_once 'model/dantri.php'; ?>
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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="../views/assets/js/admin/post.js"></script>
</body>

</html>