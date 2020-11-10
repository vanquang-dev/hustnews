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
                    <button class="button" id="btn_dantri" style="background: #6e80e8; color: #ffffff;">Dân trí</button>
                    <button class="button" id="btn_hust" style="">Hust</button>
                    <h3>Các bài báo mới nhất của Dân Trí</h3>
                    <div id="dantri">
                        <?php include_once 'model/dantri.php'; ?>
                    </div>
                    <div id="hust" class="display">
                        <?php include_once 'model/hust.php'; ?>
                    </div>
                    
                </div>
            </div>
            <div class="post-detail">
                <div class="main-post" style="margin: 0">
                    <h3>Danh sách bài viết</h3>
                    <table id="list-post"></table>
                </div>
            </div>
            
            <?php include_once 'component/footer.php'; ?>
        </div>
    </div>
    <script>

    </script>
    <script>
        var btn_dantri = document.getElementById('btn_dantri');
        var btn_hust = document.getElementById('btn_hust');
        var dantri = document.getElementById('dantri');
        var hust = document.getElementById('hust');
        var editor = document.getElementById('list-post');
        var check = 'true';

        btn_dantri.addEventListener('click', () => {
            dantri.classList.remove('display');
            hust.classList.add('display');
            btn_dantri.setAttribute('style', "background: #6e80e8; color: #ffffff;");
            btn_hust.setAttribute('style', "");
            check = 'true';
            get_list_post();
        });
        btn_hust.addEventListener('click', () => {
            hust.classList.remove('display');
            dantri.classList.add('display');
            btn_hust.setAttribute('style', "background: #6e80e8; color: #ffffff;");
            btn_dantri.setAttribute('style', "");
            check = 'flase';
            get_list_hust();
        });

        var dom = document.getElementsByClassName('hihi');
        for (a of dom) {
            get_link(a);
        }

        function get_link(a) {
            a.addEventListener('click', ()=>{
                add_post(a.getAttribute('data-link'));
                a.classList.add('success');
                return false;
            })
        }

        function add_post(link) {
            data = {url: link};
            // add post user
            fetch('../api/post/add.php', {
              method: 'POST', 
              headers: {
                'Content-Type': 'application/json',
              },
              body: JSON.stringify(data),
            })
            .then(response => response.json())
            .then(data => {
                console.log('done');
                get_list_post();
                if (check == 'true') {
                    get_list_post();
                } else if (check == 'flase') {
                    get_list_hust();
                }
            })
            .catch((error) => {
              console.error('Error:', error);
            });
        }
        
        function get_list_post() {
            fetch('../api/post/read.php', {
                method: 'POST', 
                headers: {
                'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                
                editor.innerHTML = '';
                editor.insertAdjacentHTML('beforeend',"<tr id='title'><th>Tên bài viết</th><th id='like'>Tuỳ chọn</th></tr>");
                for (a of data.result) {
                    editor.insertAdjacentHTML('beforeend',"<tr><td>"+a.title+"</td><td><button onclick='lock_member("+a.id+")' class='button-delete'>Xoá</button></td></tr>");
                }
            })
            .catch((error) => {
              console.error('Error:', error);
            });
        }

        function get_list_hust() {
            fetch('../api/post/read_hust.php', {
                method: 'POST', 
                headers: {
                'Content-Type': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                editor.innerHTML = '';
                editor.insertAdjacentHTML('beforeend',"<tr id='title'><th>Tên bài viết</th><th id='like'>Tuỳ chọn</th></tr>");
                for (a of data.result) {
                    editor.insertAdjacentHTML('beforeend',"<tr><td>"+a.title+"</td><td><button onclick='lock_member("+a.id+")' class='button-delete'>Xoá</button></td></tr>");
                }
            })
            .catch((error) => {
              console.error('Error:', error);
            });
        }

        // if (check == 'true') {
        //     get_list_post();
        // }
        
        document.getElementById('post-sidebar').classList.add('active');
    </script>
</body>

</html>