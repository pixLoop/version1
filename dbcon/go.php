<?php
$url = $_GET['go'];
$ip = $_SERVER['REMOTE_ADDR'];
echo $ip;

require("./dbcon/connection.php");
$con = getConnection();
$idQuery = "SELECT id FROM News WHERE CONCAT_WS('/', font, link) = '".$url."'";
$id = mysqli_fetch_array(mysqli_query($con, $idQuery))['id'];
if ($id != null) {
	$query = "INSERT INTO News_views (news, ip) VALUES ('".$id."', '".$ip."')";
	mysqli_query($con, $query);
}
closeConnection($con);

header("Location: ".$url);
?>
