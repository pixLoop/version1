<?php
require("./dbcon/connection.php");
$con = getConnection();

$query = "INSERT INTO News_views (news, ip) VALUES ('".intval($_POST['post'])."', '127.0.0.1')";
//$query = "INSERT INTO News_views (news, ip) VALUES ('".$_POST['post']."', '".$_SERVER['REMOTE_ADDR']."')";

mysqli_query($con, $query);
if (mysqli_errno($con) != 0) {
	echo "<b>ERROR: ".mysqli_error($con);
}

echo 2;

closeConnection($con);
?>
