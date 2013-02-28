<?php
require("./dbcon/connection.php");

function getPages($site) {
	$con = getConnection();
	$query = "SELECT * FROM News WHERE site = '".$site."'";
	$result = mysqli_query($con, $query);
	$rows = mysqli_num_rows($result);
	$pages = ceil($rows / 20);
	closeConnection($con);
	return $pages;
}

function getNews($site, $order, $page) {
	$con = getConnection();

	$query = "SELECT n.*, COUNT(nv.news) votes, COUNT(ni.news) views, COUNT(nc.news) comments, (((COUNT(nv.news) + COUNT(nc.news)) / (NOW() - n.time)) * 1000000) pop FROM News n LEFT JOIN News_votes nv ON n.id = nv.news LEFT JOIN News_views ni ON n.id = ni.news LEFT JOIN Comments nc ON n.id = nc.news WHERE n.site = '".$site."' GROUP BY n.id ";
	switch ($order) {
		case "portada":
			$query .= "ORDER BY pop DESC";
			break;
		case "nuevas":
			$query .= "ORDER BY time DESC";
			break;
		case "destacadas":
			$query .= "ORDER BY votes DESC";
			break;
		case "vistas":
			$query .= "ORDER BY views DESC";
			break;
		case "comentadas":
			$query .= "ORDER BY comments DESC";
			break;
	}

	$query .= ", time DESC LIMIT " . (20 * ($page - 1)) . ", 20";

	$news = mysqli_query($con, $query);

	closeConnection($con);
	return $news;
}
?>
