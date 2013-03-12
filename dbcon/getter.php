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

function getNews($site, $order, $page, $time) {
	$con = getConnection();

	$sort = "";
	$col = "";
	switch ($order) {
		case "portada":
			$sort = "pop DESC";
			$time = "all";
			break;
		case "nuevas":
			$sort = "time DESC";
			$time = "all";
			break;
		case "destacadas":
			$sort = "votes DESC";
			$col = "nv.time";
			break;
		case "vistas":
			$sort = "views DESC";
			$col = "ni.time";
			break;
		case "comentadas":
			$sort = "comments DESC";
			$col = "nc.time";
			break;
	}

	$timing = " AND (TO_SECONDS(NOW()) - TO_SECONDS(".$col.")) <= ";
	switch ($time) {
		case "24h":
			$timing .= (24 * 3600);
			break;
		case "48h":
			$timing .= (2 * 24 * 3600);
			break;
		case "1s":
			$timing .= (7 * 24 * 3600);
			break;
		case "1m":
			$timing .= (30 * 24 * 3600);
			break;
		case "6m":
			$timing .= (6 * 30 * 24 * 3600);
			break;
		case "1a":
			$timing .= (365 * 24 * 3600);
			break;
		default:
			$timing = "";
	}

	$query = "SELECT n.*, CONCAT_WS('/', n.font, n.link) url, COUNT(nv.news) votes, COUNT(ni.news) views, COUNT(nc.news) comments, (((COUNT(nv.news) + COUNT(nc.news)) / (NOW() - n.time)) * 1000000) pop FROM News n LEFT JOIN News_votes nv ON n.id = nv.news LEFT JOIN News_views ni ON n.id = ni.news LEFT JOIN Comments nc ON n.id = nc.news WHERE n.site = '".$site."'".$timing." GROUP BY n.id ORDER BY ".$sort.", time DESC LIMIT " . (20 * ($page - 1)) . ", 20";

	$news = mysqli_query($con, $query);

	closeConnection($con);
	return $news;
}

function getStory($site, $story) {
	$con = getConnection();

	$query = "SELECT n.*, CONCAT_WS('/', n.font, n.link) url, COUNT(nv.news) votes, COUNT(ni.news) views, COUNT(nc.news) comments, (((COUNT(nv.news) + COUNT(nc.news)) / (NOW() - n.time)) * 1000000) pop FROM News n LEFT JOIN News_votes nv ON n.id = nv.news LEFT JOIN News_views ni ON n.id = ni.news LEFT JOIN Comments nc ON n.id = nc.news WHERE n.site = '".$site."' AND n.id = ".$story." GROUP BY n.id LIMIT 0, 1";

	$story = mysqli_query($con, $query);
	$rows = mysqli_num_rows($story);

	closeConnection($con);
	if ($rows !== 1) {
		return null;
	} else {
		return $story;
	}
}

function getComments($story) {
	$con = getConnection();

	$query = "SELECT nc.* FROM News n LEFT JOIN Comments nc ON n.id = nc.news WHERE n.id = ".$story;

	$comments = mysqli_query($con, $query);
	$rows = mysqli_num_rows($story);

	closeConnection($con);
	return $comments;
}
?>
