<?php
	// include object database and login
	include_once 'api/config/database.php';
	include_once 'api/config/time.php';
	include_once 'api/config/utf8tourl.php';
	include_once 'api/objects/category.php';
	
	$category = new Category();
	$query = $category->get_category();
	while ($row = mysqli_fetch_array($query)) {
		$link = utf8tourl($row['name_category']).'-'.$row['id_category'].'.html';
		echo '<li>
			<a href="danh-muc-'.$link.'">'.$row['name_category'].'</a>
		</li>';
	}

?>