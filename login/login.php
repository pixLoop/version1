<?php session_start();
/*==========================================*\
|| ##########################################||
|| # SONHLAB.com - SONHlab Social Auth v1 #
|| ##########################################||
\*==========================================*/
$index = '../';
// User Logged in
if ( isset($_SESSION["userprofile"]) ) {
	echo "con ECHO<br/>";
	echo $_SESSION["userprofile"];

	echo "<br/><br/>********************************************************************<br/>";
	echo "********************************************************************<br/>";

	echo "con PRINT_R<br/>";
	$_SESSION["userprofile"]["ioputa"] = "Cagoentusmuertos";
	print_r($_SESSION["userprofile"]);
//	header("Location: $index");
}
// Options to Log in
else {
	
	// Get social connect
	$app = $_GET['app'];
	
	if ( !empty($app) ) {
		if ( $app == 'facebook' ) { // Facebook Auth
			require_once('facebook.php');
		}
		elseif ( ($app == 'twitter') ) { // Twitter Auth
			require_once('twitter.php');
		}
		elseif ( $app == 'google' ) {  // Google Auth
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
