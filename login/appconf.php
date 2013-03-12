<?php
/*==========================================*\
|| ##########################################||
|| # SONHLAB.com - SONHlab Social Auth v1 #
|| ##########################################||
\*==========================================*/

// Set the page will be returned
$index = '../index.php';

if ( $app == 'facebook' ) { // Facebook App
	$facebook = new Facebook(array(
		'appId'  => '',
		'secret' => '',
	));
}
elseif ( $app == 'twitter' ) { // Twitter App
	$tmhOAuth = new tmhOAuth(array(
	  'consumer_key'    => '',
	  'consumer_secret' => '',
	));
}
elseif ( $app == 'google' ) { // Google App
	$GoogleApiConfig = array(
		// The application_name is included in the User-Agent HTTP header.
		'application_name' => '',
		
		// OAuth2 Settings, you can get these keys at https://code.google.com/apis/console
		'oauth2_client_id' => '',
		'oauth2_client_secret' => '',
		'oauth2_redirect_uri' => '',

	);
}