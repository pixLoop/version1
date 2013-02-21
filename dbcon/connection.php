<?php
function getConnection() {
	$con = mysqli_connect("localhost", "root", "root");
	if (!$con) {
		die('Could not connect to server: ' . mysqli_error($con));
	}
	if (!mysqli_select_db($con, "pixloop")) {
		die('Could not connect to database: ' . mysqli_error($con));
	}
	return $con;
}

function closeConnection($con) {
	mysql_close($con);
}
?>
