<?php 
if (isset($_POST['post'])) {
	require("./dbcon/connection.php");
	$con = getConnection();

	$query = "SELECT nc.*, u.*, COUNT(*) votes FROM Comments nc INNER JOIN Users u ON nc.user = CONCAT_WS(':', u.page, u.id) LEFT JOIN Comments_votes cv ON nc.id = cv.c_id AND nc.news = cv.c_news WHERE nc.news = '".$_GET['comment']."' AND nc.parent IS NULL GROUP BY nc.user";

	$comments = mysqli_num_rows(mysqli_query($con, $query));

	$query = "INSERT INTO Comments (id,user,news,comment) values (".($comments + 1).",'".$_POST['user']."', ".$_GET['comment'].",'".$_POST['comment']."')";

	$rows = mysqli_query($con, $query);

	closeConnection($con);
}
header("Location: ./?".$_SESSION['last_page']);
?>