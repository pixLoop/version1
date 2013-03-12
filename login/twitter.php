<?php
/*==========================================*\
|| ##########################################||
|| # SONHLAB.com - SONH Social Auth v1 #
|| ##########################################||
\*==========================================*/
require('twitter/tmhOAuth.php');
require('twitter/tmhUtilities.php');
require_once('appconf.php');

$here = tmhUtilities::php_self();


function outputError($tmhOAuth) {
  echo 'Error: ' . $tmhOAuth->response['response'] . PHP_EOL;
  tmhUtilities::pr($tmhOAuth);
}

// Credentials exist
if ( isset($_SESSION['access_token']) ) {

		$tmhOAuth->config['user_token']  = $_SESSION['access_token']['oauth_token'];
		$tmhOAuth->config['user_secret'] = $_SESSION['access_token']['oauth_token_secret'];
	
		$code = $tmhOAuth->request('GET', $tmhOAuth->url('1/account/verify_credentials'));
		if ($code == 200) {	   
			$resp = json_decode($tmhOAuth->response['response']);
			$_SESSION["userprofile"] = $resp;
			
			// return after login
			header("Location: $index");
		}
		else {
			outputError($tmhOAuth);
		}
	
}

// we're being called back by Twitter
elseif (isset($_REQUEST['oauth_verifier'])) {

		$tmhOAuth->config['user_token'] = $_SESSION['oauth']['oauth_token'];
		$tmhOAuth->config['user_secret'] = $_SESSION['oauth']['oauth_token_secret'];
	
		$code = $tmhOAuth->request('POST', $tmhOAuth->url('oauth/access_token', ''), array(
			'oauth_verifier' => $_REQUEST['oauth_verifier']
		));
	
		if ($code == 200) {
			$_SESSION['access_token'] = $tmhOAuth->extract_params($tmhOAuth->response['response']);
			unset($_SESSION['oauth']);
			header("Location: {$here}");
		}
		else {
			outputError($tmhOAuth);
		}
}

// Credentials not exist
elseif ( !isset($_SESSION['access_token']) ) {
	$code = $tmhOAuth->request('POST', $tmhOAuth->url('oauth/request_token', ''), $params);
	if ($code == 200) {
		$_SESSION['oauth'] = $tmhOAuth->extract_params($tmhOAuth->response['response']);
		//$method = 'authorize';
		$method = 'authenticate';
		$force  = '';
		$authurl = $tmhOAuth->url("oauth/{$method}", '') .  "?oauth_token={$_SESSION['oauth']['oauth_token']}{$force}";
		header("Location: {$authurl}");
	} else {
		outputError($tmhOAuth);
	}
}
