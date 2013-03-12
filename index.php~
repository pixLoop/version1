<?php
//session_start();

function pages() {
	require("./dbcon/getter.php");
	$news = getNews($_GET['site'], $_GET['section'], $_GET['page']);
	$totalPages = getPages($_GET['site']);
	if (isset($_GET['page'])) {
		if ($_GET['page'] <= $totalPages) {
			require("./pages/main.php");
		} else header("Location: ./?site=".$_GET['site']."&section=".$_GET['section']."&page=1");
	} else header("Location: ./?site=".$_GET['site']."&section=".$_GET['section']."&page=1");
}

function noticia() {
	if (isset($_GET['story'])) {
		require("./dbcon/getter.php");
		$story = getStory($_GET['site'], $_GET['story']);
		$comments = getComments($_GET['story']);
		if ($story !== null) {
			require("./pages/news.php");
		} else {
			header("Location: ./?site=".$_GET['site']."&section=portada&page=1");
		}
	} else header("Location: ./?site=".$_GET['site']."&section=portada&page=1");
}

function timeJumper() {
	switch ($_GET['time']) {
		case "24h":
		case "48h":
		case "1s":
		case "1m":
		case "6m":
		case "1a":
		case "all":
			break;
		default:
			header("Location: ./?site=".$_GET['site']."&section=".$_GET['section']."&time=all&page=1");
	}
}

function sectionJumper() {
	switch ($_GET['section']) {
		case "portada":
		case "nuevas":
			pages();
			break;
		case "destacadas":
		case "vistas":
		case "comentadas":
			timeJumper();
			pages();
			break;
		case "noticia":
			noticia();
			break;
		default:
			header("Location: ./?site=".$_GET['site']."&section=portada&page=1");
	}
}

function siteJumper() {
	switch ($_GET['site']) {
		case "videojuegos":
			break;
		default:
			header("Location: ./");
	}
}


if (isset($_GET['goto'])) {
	require("./dbcon/go.php");
} else if (!isset($_GET['site'])) {
	include("portada.html");
} else {
	siteJumper();
	sectionJumper();
}
?>
