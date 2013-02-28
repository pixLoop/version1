<!DOCTYPE html>
<html lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="Refresh" content="600">
		<title>pixLoop DataBase Updater</title>
		<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
		<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>
		<script>
			$(function() {
				function refresh() {
					window.location.reload(true);
				}

				$( ".tabs" ).tabs();
				$("#last").html("Last updated: " + new Date().toLocaleString());

				var time = (1000 * 60 * 10);
				setTimeout(refresh, time);
			});
		</script>
	</head>
	<body>
		<h1>pixLoop DataBase Updater</h1>
		<p id="last"></p>
		<?php
		date_default_timezone_set('Europe/Madrid');
		require("../dbcon/connection.php");
		function updateNews($site, $font, $link, $image, $title, $resume, $time) {
			$con = getConnection();

			$query = "INSERT INTO News (site, font, link, image, title, resume, time) VALUES ('".$site."', '".$font."', '".$link."', '".$image."', '".mysqli_real_escape_string($con, $title)."', '".mysqli_real_escape_string($con, $resume)."', '".$time."')";

			mysqli_query($con, $query);
			if (mysqli_errno($con) != 0) {
				echo "<b>ERROR: ".mysqli_error($con);
			} else echo "<b>Noticia actualizada satisfactoriamente.";

			echo "</b><br><br>";

			closeConnection($con);
		}
		function cURLcheckBasicFunctions(){
			if( !function_exists("curl_init") &&!function_exists("curl_setopt") &&!function_exists("curl_exec") &&!function_exists("curl_close") ) 
				return false;
			else return true;
		}
		function cURLdownload($url, $file){
			if( !cURLcheckBasicFunctions() ) return "UNAVAILABLE: cURL Basic Functions";
			$ch = curl_init();
			if($ch){
				$fp = fopen($file, "w");
				if($fp){
					if( !curl_setopt($ch, CURLOPT_URL, $url) ) return "FAIL: curl_setopt(CURLOPT_URL)";
					if( !curl_setopt($ch, CURLOPT_FILE, $fp) ) return "FAIL: curl_setopt(CURLOPT_FILE)";
					if( !curl_setopt($ch, CURLOPT_HEADER, 0) ) return "FAIL: curl_setopt(CURLOPT_HEADER)";
					if( !curl_exec($ch) ) return "FAIL: curl_exec()";

					curl_close($ch);
					fclose($fp);
					return "SUCCESS: $file [$url]";
				}else return "FAIL: fopen()";
			}else return "FAIL: curl_init()";
		}

		function getAndUpdate($site) {
			require_once("./list/".$site.".inc");
			echo "<ul>";
			foreach($array as $page => $rss){
				echo '<li><a href="#'..$page'">'.$page.'</a></li>';
			}
			echo "</ul>";

			foreach($array as $page => $rss){
				echo '<div id="'.$page.'">';
				echo cURLdownload($rss, "./latestLogs/".$page.".xml")."<br><br>";

				$xml = new DOMDocument(); 
				$xml->load('./latestLogs/'.$page.'.xml');
				$raiz = $xml->documentElement;
				$entradas = $raiz->getElementsByTagName('item'); 
				$count = $entradas->length; 

				for ($i=0; $i<$count; $i++) { 
					$titulo = $entradas->item($i)->getElementsByTagName('title')->item(0)->nodeValue; 
					$url = $entradas->item($i)->getElementsByTagName('link')->item(0)->nodeValue;
					echo $url.'<br>';
					$font = substr($url, 0, stripos($url, "/", 8));
					$link = substr($url, stripos($url, "/", 8) + 1);
					$pubDate = $entradas->item($i)->getElementsByTagName('pubDate')->item(0)->nodeValue;
					$pubDate = date('Y-m-d H:i:s', strtotime($pubDate));
					echo $pubDate.'<br>';
					$description = $entradas->item($i)->getElementsByTagName('description')->item(0)->nodeValue;

					$image = "";
					$startimage = stripos($description, "<img");
					if ($startimage !== FALSE) {
						$endimage = stripos($description, ">", $image);
						$fullimage = substr($description, $startimage, ($endimage - $startimage));
						$startsrc = stripos($fullimage, 'src="');
						$endsrc = stripos($fullimage, '"', ($startsrc + 5));
						if ($startsrc === FALSE) {
							$startsrc = stripos($fullimage, "src='");
							$endsrc = stripos($fullimage, "'", ($startsrc + 5));
						}
						if ($startsrc !== FALSE)
							$image = substr($fullimage, ($startsrc + 5), ($endsrc - $startsrc - 5));
					}

					$description = trim(preg_replace("'<.*?>'si", "", $description));

					updateNews($site, $font, $link, $image, $titulo, $description, $pubDate);
				}
				echo '</div>';
			}
			
		}
		?>
		<div class="tabs">
			<ul>
				<li><a href="#videojuegos">Videojuegos</a></li>
			</ul>
			<div id="videojuegos" class="tabs">
		
		<?php
			getAndUpdate("videojuegos");
		?>
			</div>
		</div>
	</body>
</html>
