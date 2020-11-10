<?php 
	include_once '../api/config/simple_html_dom.php';
	$html_dantri = file_get_html("https://dantri.com.vn/");
    $list = $html_dantri->find('h2[class=news-item__title] a' );
    echo "<table>
    <tr id='title'><th>Tên bài viết</th><th id='like'>Tuỳ chọn</th></tr>";
    foreach ( $list as $item  ) {

        $link_dantri = "https://dantri.com.vn".$item->href;
        $text_dantri = $item->plaintext;
        echo "<tr><td><p>🚀 <a href='$link_dantri'>".$text_dantri."</a></p></td><td><button class='hihi' data-link='$link_dantri'>Lấy bài viết</button></td></tr>";
    }
    echo "</table>";
?>