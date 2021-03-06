<?php
require("./dbcon/connection.php");

function getTopFonts($site) {
	$con = getConnection();
	$query = "SELECT n.font, (COUNT(nv.user) / COUNT(n.link)) rating FROM News n LEFT JOIN News_votes nv ON n.id = nv.news WHERE n.site = '".$site."' GROUP BY n.font ORDER BY rating DESC LIMIT 0, 10";
	$result = mysqli_query($con, $query);
	closeConnection($con);
	return $result;	
}

function getPages($site) {
	$con = getConnection();
	$query = "SELECT * FROM News WHERE site = '".$site."'";
	$result = mysqli_query($con, $query);
	$rows = mysqli_num_rows($result);
	$pages = ceil($rows / 17);
	closeConnection($con);
	return $pages;
}

function getNews($site, $order, $page, $time = "all") {
	$con = getConnection();

	$col = "";
	$sort = "";
	switch ($order) {
		case "portada":
			$sort = "pop DESC";
			break;
		case "nuevas":
			$sort = "time DESC";
			break;
		case "destacadas":
			$col = "nv.time";
			$sort = "votes DESC";
			break;
		case "vistas":
			$col = "ni.time";
			$sort = "views DESC";
			break;
		case "comentadas":
			$col = "nc.time";
			$sort = "comments DESC";
			break;
	}

	$interval = "";
	switch ($time) {
		case "24h":
			$interval = (24 * 3600);
			break;
		case "48h":
			$interval = (2 * 24 * 3600);
			break;
		case "1s":
			$interval = (7 * 24 * 3600);
			break;
		case "1m":
			$interval = (30 * 24 * 3600);
			break;
		case "6m":
			$interval = (6 * 30 * 24 * 3600);
			break;
		case "1a":
			$interval = (365 * 24 * 3600);
			break;
	}
	$timing = "WHERE (TO_SECONDS(NOW()) - TO_SECONDS(".$col.")) <= ".$interval;
	switch ($time) {
		case "24h":
		case "48h":
		case "1s":
		case "1m":
		case "6m":
		case "1a":
			break;
		default:
			$timing = "";
	}

	$nvTiming = "";
	$niTiming = "";
	$ncTiming = "";
	switch ($order) {
		case "destacadas":
			$nvTiming = $timing;
			break;
		case "vistas":
			$niTiming = $timing;
			break;
		case "comentadas":
			$ncTiming = $timing;
			break;
	}

	$query = "SELECT n.*, CONCAT_WS('/', n.font, n.link) url, IFNULL(v.votes, 0) votes, IFNULL(i.views, 0) views, IFNULL(c.comments, 0) comments, (((IFNULL(v.votes, 0) + IFNULL(c.comments, 0)) / (NOW() - n.time)) * 1000000) pop FROM News n LEFT JOIN (SELECT n.id, COUNT(*) votes FROM News n INNER JOIN News_votes nv ON n.id = nv.news ".$nvTiming." GROUP BY n.id) v ON n.id = v.id LEFT JOIN (SELECT n.id, COUNT(*) views FROM News n INNER JOIN News_views ni ON n.id = ni.news ".$niTiming." GROUP BY n.id) i ON n.id = i.id LEFT JOIN (SELECT n.id, COUNT(*) comments FROM News n INNER JOIN Comments nc ON n.id = nc.news ".$ncTiming." GROUP BY n.id) c ON n.id = c.id WHERE n.site = '".$site."' ORDER BY ".$sort.", time DESC LIMIT ".(17 * ($page - 1)).", 17";

	$news = mysqli_query($con, $query);

	closeConnection($con);
	return $news;
}

function getStory($site, $story) {
	$con = getConnection();

	$query = "SELECT n.*, CONCAT_WS('/', n.font, n.link) url, IFNULL(v.votes, 0) votes, IFNULL(i.views, 0) views, IFNULL(c.comments, 0) comments, (((IFNULL(v.votes, 0) + IFNULL(c.comments, 0)) / (NOW() - n.time)) * 1000000) pop FROM News n LEFT JOIN (SELECT n.id, COUNT(*) votes FROM News n INNER JOIN News_votes nv ON n.id = nv.news  GROUP BY n.id) v ON n.id = v.id LEFT JOIN (SELECT n.id, COUNT(*) views FROM News n INNER JOIN News_views ni ON n.id = ni.news  GROUP BY n.id) i ON n.id = i.id LEFT JOIN (SELECT n.id, COUNT(*) comments FROM News n INNER JOIN Comments nc ON n.id = nc.news GROUP BY n.id) c ON n.id = c.id WHERE n.site = '".$site."' AND n.id = ".$story." GROUP BY n.id LIMIT 0, 1";

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

	$query = "SELECT nc.id com_id, nc.*, u.*, IFNULL(v.votes, 0) votes FROM Comments nc INNER JOIN Users u ON nc.user = CONCAT_WS(':', u.page, u.id) LEFT JOIN (SELECT cv.c_id, cv.c_news, COUNT(*) votes FROM Comments nc INNER JOIN Comments_votes cv ON nc.id = cv.c_id AND nc.news = cv.c_news) v ON nc.id = v.c_id AND nc.news = v.c_news WHERE nc.news = '".$story."' AND nc.parent IS NULL GROUP BY nc.id";

	$comments = mysqli_query($con, $query);

	closeConnection($con);
	return $comments;
}
?>
