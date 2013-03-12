<?php session_start();
/*==========================================*\
|| ##########################################||
|| # SONHLAB.com - SONH Social Auth v1 #
|| ##########################################||
\*==========================================*/

// Page will be returned after logut
$index = '../index.php';

//session_destroy();
unset ($_SESSION['userprofile']);
header("Location: $index");
