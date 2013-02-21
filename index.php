<?php
//session_start();
if (!isset($_GET['site'])) {
	include("portada.html");
} else if ($_GET['site'] !== "videojuegos") {
	header("Location: ./");
} else if (isset($_GET['section'])) {
	switch ($_GET['section']) {
		case "portada":
		case "nuevas":
		case "destacadas":
		case "vistas":
		case "comentadas":
			require("./dbcon/getter.php");
			$news = getNews($_GET['site'], $_GET['section'], $_GET['page']);
			$totalPages = getPages($_GET['site']);
			if (isset($_GET['page'])) {
				if ($_GET['page'] <= $totalPages) {
					require("./pages/main.php");
				} else header("Location: ./?site=".$_GET['site']."&section=".$_GET['section']."&page=1");
			} else header("Location: ./?site=".$_GET['site']."&section=".$_GET['section']."&page=1");
			break;
		case "noticia":
			require("./access/news.php");
			break;
		default:
			header("Location: ./?site=".$_GET['site']."&section=portada&page=1");
	}
} else header("Location: ./?site=".$_GET['site']."&section=portada&page=1");
?>
