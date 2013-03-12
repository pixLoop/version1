<?php
/*==========================================*\
|| ##########################################||
|| # SONHLAB.com - SONH Social Auth v1 #
|| ##########################################||
\*==========================================*/

// Call Facebook API
require_once('facebook/facebook.php');
// Get Configuration
require_once('appconf.php');
	
// Get User ID
$user = $facebook->getUser();

	if ($user) {
		try {
			// Proceed knowing you have a logged in user who's authenticated.
			$user_profile = $facebook->api('/me');
		} catch (FacebookApiException $e) {
			error_log($e);
			$user = NULL;
		}
	}

	// Login or logout url will be needed depending on current user state.
	if ($user) {
		$_SESSION["logout_url"] = $logoutUrl = $facebook->getLogoutUrl();
		$_SESSION["userprofile"] = $user_profile;
		
		// Return after login
		header("Location: $index");
	}
	else {
		$loginUrl = $facebook->getLoginUrl();
		header("Location: $loginUrl");
	}
