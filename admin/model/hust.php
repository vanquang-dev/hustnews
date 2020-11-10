<?php 
	include_once '../api/config/simple_html_dom.php';
	$html_dantri = file_get_html("https://www.hust.edu.vn/web/vi/tin-tuc-thong-bao");
    $list = $html_dantri->find('div[class=content] a');
    
    echo "<table>
    <tr id='title'><th>Tên bài viết</th><th id='like'>Tuỳ chọn</th></tr>";
    foreach ( $list as $item  ) {

        $link_dantri = $item->href;
        $text_dantri = $item->title;
        if ($text_dantri != 'Xem tất cả') {
            echo "<tr><td><p>🚀 <a href='$link_dantri'>".$text_dantri."</a></p></td><td><button class='hihi' data-link='$link_dantri'>Lấy bài viết</button></td></tr>";
        }
    }
    echo "</table>";
?>