<?php 
	session_start();
	unset($_SESSION['access_token_fb']);
    unset($_SESSION['access_token_gg']);
	session_destroy();
	header('location: ../../')
?>