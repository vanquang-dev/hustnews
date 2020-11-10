<?php 
	include_once 'api/config/database.php';
	include_once 'api/objects/login.php';
	include_once 'api/objects/register.php';

	$login = new Login();
	$register = new Register();

	$login->social_id = $googleUser['id'];
	$login->social_name = $googleUser['name'];
	$login->name = $googleUser['name'];
	$login->email = $googleUser['email'];

	$register->social_id = $googleUser['id'];
	$register->social_name = $googleUser['name'];
	$register->name = $googleUser['name'];
	$register->email = $googleUser['email'];
	$register->avatar = $googleUser['picture'];

	$check = $login->check_social_gg();
	if ($check == 0) {
		$register->create_google();
		$row = $login->get_user_gg();
		$_SESSION['user_id'] = $row['user_id'];
		$_SESSION['name'] = $row['name'];
		$_SESSION['avatar'] = $row['avatar'];
		header('Location: /bigex/');
		die();
	} else {
		$row = $login->get_user_gg();
		$_SESSION['user_id'] = $row['user_id'];
		$_SESSION['name'] = $row['name'];
		$_SESSION['avatar'] = $row['avatar'];
		header('Location: /bigex/');
		die();
	}
?>