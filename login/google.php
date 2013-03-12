<?php
/*==========================================*\
|| ##########################################||
|| # SONHLAB.com - SONH Social Auth v1 #
|| ##########################################||
\*==========================================*/

require_once 'google/apiClient.php';
require_once 'google/contrib/apiOauth2Service.php';
	
$client = new apiClient();
$client->setApplicationName("Google UserInfo PHP Starter Application");
$oauth2 = new apiOauth2Service($client);

if (isset($_GET['code'])) {
	$client->authenticate();
	$_SESSION['token'] = $client->getAccessToken();
	$redirect = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
	header('Location: ' . filter_var($redirect, FILTER_SANITIZE_URL));
}

if (isset($_SESSION['token'])) {
	$client->setAccessToken($_SESSION['token']);
}
	
if (isset($_REQUEST['logout'])) {
	unset($_SESSION['token']);
	$client->revokeToken();
}
	
if ($client->getAccessToken()) {
	$user = $oauth2->userinfo->get();
	$_SESSION["userprofile"] = $user;
			
	// The access token may have been updated lazily.
	$_SESSION['token'] = $client->getAccessToken();
	
	// return after login
	header("Location: $index");	
	
} else {
  $authUrl = $client->createAuthUrl();		  
}
		
if(isset($authUrl)) {
	header("Location: $authUrl");
}
