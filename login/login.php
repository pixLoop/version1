<?php session_start();
/*==========================================*\
|| ##########################################||
|| # SONHLAB.com - SONHlab Social Auth v1 #
|| ##########################################||
\*==========================================*/
$index = '../';
// User Logged in
if ( isset($_SESSION["userprofile"]) ) {
	if (isset($_SESSION["userprofile"]["id"])) 
		$_SESSION["login"]["id"] = $_SESSION["userprofile"]["id"];
	if (isset($_SESSION["userprofile"]["id"]) && isset($_SESSION["login"]["page"])) 
		$_SESSION["login"]["short"] = $_SESSION["login"]["page"].":".$_SESSION["userprofile"]["id"];
	if (isset($_SESSION["userprofile"]["name"])) 
		$_SESSION["login"]["name"] = $_SESSION["userprofile"]["name"];
	if (isset($_SESSION["userprofile"]["link"])) 
		$_SESSION["login"]["url"] = $_SESSION["userprofile"]["link"];
	if (isset($_SESSION["userprofile"]["picture"])) 
		$_SESSION["login"]["image"] = $_SESSION["userprofile"]["picture"];

	print_r($_SESSION["login"]);
	print_r($_SESSION["last_page"]);
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
