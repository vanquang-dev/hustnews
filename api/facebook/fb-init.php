<?php 
include_once 'api/facebook/autoload.php';
$fb = new Facebook\Facebook([
	'app_id' => '357162525593694',
	'app_secret' => '67b98e84a92e21ee154b94b6512ef4b9',
	'default_graph_version' => 'v8.0' 
]);
$helper = $fb->getRedirectLoginHelper();
$login_url = $helper->getLoginUrl("https://hustnews.com/bigex/login");

try {
		$accessToken = $helper->getAccessToken();
		if (isset($accessToken)) {
			$_SESSION['access_token_fb']  = (string)$accessToken;
			header("Location: /bigex/");
		}
} catch (Exception $e) {
		echo $e->getTraceAsString();
}
if (isset($_SESSION['access_token_fb'])) {
	try {
		$fb->setDefaultAccessToken($_SESSION['access_token_fb']);
		$res = $fb->get('/me?locale=en_US&fields=name,email');
		$user = $res->getGraphuser();
		include 'api/login/login_fb.php';
	} catch (Exception $e) {
		echo $e->getTraceAsString();
	}
}
?>