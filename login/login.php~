<?php session_start();
/*==========================================*\
|| ##########################################||
|| # SONHLAB.com - SONHlab Social Auth v1 #
|| ##########################################||
\*==========================================*/
$index = '../';
// User Logged in
if ( isset($_SESSION["userprofile"]) ) {
	print_r($_SESSION["userprofile"]);
	print_r($_SESSION["login"]);
//	header("Location: $index");
}
// Options to Log in
else {
	
	// Get social connect
	$app = $_GET['app'];
	
	if ( !empty($app) ) {
		if ( $app == 'facebook' ) { // Facebook Auth
			$_SESSION["login"]["page"] = "FB";
			require_once('facebook.php');
		}
		elseif ( ($app == 'twitter') ) { // Twitter Auth
			$_SESSION["login"]["page"] = "TW";
			require_once('twitter.php');
		}
		elseif ( $app == 'google' ) {  // Google Auth
			$_SESSION["login"]["page"] = "GO";
			require_once('google.php');
		}
		else {
			header("Location: $index");
		}
	}
	else {
		header("Location: $index");
	}
}
