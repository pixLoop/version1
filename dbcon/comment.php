<?php 
if (isset($_POST['post'])) {
	require("./dbcon/connection.php");
	$con = getConnection();

	$query = "SELECT * FROM Comments c WHERE c.news = '".$_GET['comment']."'";

	$comments = mysqli_num_rows(mysqli_query($con, $query));

	$query = "INSERT INTO Comments (id,user,news,comment) values (".($comments + 1).",'".$_POST['user']."', ".$_GET['comment'].",'".$_POST['comment']."')";

	$rows = mysqli_query($con, $query);

	closeConnection($con);
}
header("Location: ./?".$_SESSION['last_page']);
?>
