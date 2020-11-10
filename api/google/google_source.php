<?php

include_once ('api/google/vendor/autoload.php');

$client_id = '328355680811-g8hvrbk339l3fsjii13lc4hcghldrlu1.apps.googleusercontent.com';
$client_secret = 'ED9zRz6VjxNdwUZyWTtiDA-n';
$redirect_uri = 'https://hustnews.com/bigex/login';

$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->addScope("email");
$client->addScope("profile");

$service = new Google_Service_Oauth2($client);

if (isset($_GET['code'])) {
    $client->authenticate($_GET['code']);
    $_SESSION['access_token_gg'] = $client->getAccessToken();
    
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    exit;
}

if (isset($_SESSION['access_token_gg']) && $_SESSION['access_token_gg']) {
    $client->setAccessToken($_SESSION['access_token_gg']);
} else {
    $authUrl = $client->createAuthUrl();
}
if ($client->isAccessTokenExpired()) {
    $authUrl = $client->createAuthUrl();
}

if (!isset($authUrl)) {
    $googleUser = $service->userinfo->get(); 
    if(!empty($googleUser)){
        include 'api/login/login_gg.php';
        loginFromSocialCallBack($googleUser);
    }
}
?>