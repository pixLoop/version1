<?php
$news_id = $_GET['goto'];
$ip = $_SERVER['REMOTE_ADDR'];
echo $news_id, $ip;

require("./dbcon/connection.php");
$con = getConnection();
$query = "SELECT id, CONCAT_WS('/', font, link) url FROM News WHERE id = '".$news_id."'";
$result = mysqli_query($con, $query);
$result = mysqli_fetch_array($result);
$id = $result['id'];
if ($id != null) {
	$query = "INSERT INTO News_views (news, ip) VALUES ('".$id."', '".$ip."')";
	mysqli_query($con, $query);
}
closeConnection($con);

header("Location: ".$result['url']);
?>
