<?php 
	include_once 'api/config/database.php';
	include_once 'api/objects/login.php';
	include_once 'api/objects/register.php';

	$login = new Login();
	$register = new Register();

	$login->social_id = $user['id'];
	$login->social_name = $user['name'];
	$login->name = $user['name'];
	$login->email = $user['email'];

	$register->social_id = $user['id'];
	$register->social_name = $user['name'];
	$register->name = $user['name'];
	$register->email = $user['email'];
	$check = $login->check_social_fb();
	if ($check == 0) {
		$register->create_facebook();
		$row = $login->get_user_fb();
		$_SESSION['user_id'] = $row['user_id'];
		$_SESSION['name'] = $row['name'];
		$_SESSION['avatar'] = $row['avatar'];
		header('Location: /bigex/');
		die();
	} else {
		$row = $login->get_user_fb();
		$_SESSION['user_id'] = $row['user_id'];
		$_SESSION['name'] = $row['name'];
		$_SESSION['avatar'] = $row['avatar'];
		header('Location: /bigex/');
		die();
	}
?>