<?php
	require("./pages/showroom.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>pixLoop - Descubre qué se cuece entre videojuegos</title>

	<link rel="stylesheet" type="text/css" media="all" href="./css/general.css"/>
<?php
switch ($_GET['section']) {
	case "portada":
	case "nuevas":
	case "destacadas":
	case "vistas":
	case "comentadas":
?>
	<link rel="stylesheet" type="text/css" media="all" href="./css/main.css"/>
<?php		break;
	case "noticia":
?>
	<link rel="stylesheet" type="text/css" media="all" href="./css/news.css"/>
<?php		break;
}
?>
	<link rel="stylesheet" type="text/css" media="all" href="./css/color/<?php echo $_GET['site']?>.css"/>
	<link rel="stylesheet" type="text/css" media="all" href="./css/modals.css"/>
	<link rel="stylesheet" type="text/css" media="all" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css"/>

	<link rel="icon" href="./img/icon.png" type="image/png" sizes="128x128"/>
	<link rel="icon" href="./img/icon.png" type="image/png" sizes="64x64"/>
	<link rel="shortcut icon" href="./img/icon16.png" type="image/png" sizes="16x16"/>
	<link rel="apple-touch-icon" href="./img/icon.png"/>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
	<script src="./scripts/general.js"></script>
</head>
<body>
	<div id="fb-root"></div>
	<script>
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/es_ES/all.js#xfbml=1";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
<!-- MODAL DIALOGS -->
	<div id="login-form" class="modal-background">
		<div id="login-dialog" class="modal-window">
			<a href="javascript:void(0)" class="modal-close">x</a>
			<h2 class="modal-title">Login</h2>
			<a href="">
				<span id="login-facebook" class="social-login">
					<span class="logo"></span>
					Conecta con <b>Facebook</b>
				</span>
			</a>
			<a href="">
				<span id="login-twitter" class="social-login">
					<span class="logo"></span>
					Conecta con <b>Twitter</b>
				</span>
			</a>
			<a href="">
				<span id="login-google" class="social-login">
					<span class="logo"></span>
					Conecta con <b>Google</b>
				</span>
			</a>
		</div>
	</div>
	<div id="accept-vote-form" class="modal-background">
		<div id="accept-vote-dialog" class="modal-window">
			<a href="javascript:void(0)" class="modal-close">x</a>
			<h2 class="modal-title">Voto del usuario</h2>
			<p id="vote-result"></p>
		</div>
	</div>

<!--header-->
	<div id="header">
		<div id="header-top">
			<ul id="links">
				<li<?php isSelected($_GET['site'], "videojuegos");?>>
					<a href="./?site=videojuegos" title="Videojuegos">Videojuegos</a>
				</li>
				<li<?php isSelected($_GET['site'], "software");?>>
					<a href="./?site=software" title="Software">Software</a>
				</li>
				<li<?php isSelected($_GET['site'], "hardware");?>>
					<a href="./?site=hardware" title="Hardware">Hardware</a>
				</li>
				<li<?php isSelected($_GET['site'], "movil");?>>
					<a href="./?site=movil" title="Movil">Movil</a>
				</li>
				<li<?php isSelected($_GET['site'], "mediatech");?>>
					<a href="./?site=mediatech" title="MediaTech">MediaTech</a>
				</li>
				<li<?php isSelected($_GET['site'], "deportes");?>>
					<a href="./?site=deportes" title="Deportes">Deportes</a>
				</li>
				<li<?php isSelected($_GET['site'], "futbol");?>>
					<a href="./?site=futbol" title="Fútbol">Fútbol</a>
				</li>
				<li<?php isSelected($_GET['site'], "motorsport");?>>
					<a href="./?site=motorsport" title="Motorsport">Motorsport</a>
				</li>
				<li<?php isSelected($_GET['site'], "motor");?>>
					<a href="./?site=motor" title="Motor">Motor</a>
				</li>
				<li<?php isSelected($_GET['site'], "cine");?>>
					<a href="./?site=cine" title="Cine">Cine</a>
				</li>
				<li<?php isSelected($_GET['site'], "musica");?>>
					<a href="./?site=musica" title="Música">Música</a>
				</li>
				<li<?php isSelected($_GET['site'], "tv");?>>
					<a href="./?site=tv" title="Televisión">Televisión</a>
				</li>
			</ul>
			<div class="social">
				<span>Síguenos en: </span>
				<a href="" title="síguenos en Facebook">
					<img id="follow-facebook" class="follow" src="./css/img/social/facebook.png" alt="Facebook"/></a>
				<a href="" title="síguenos en Twitter">
					<img id="follow-twitter" class="follow" src="./css/img/social/twitter.png" alt="Twitter"/></a>
				<a href="" title="síguenos en Google+">
					<img id="follow-google" class="follow" src="./css/img/social/google.png" alt="Google+"/></a>
			</div>

			<ul id="userinfo">
				<li class="usertext">
					<a href="javascript:void(0)" id="login-link">Login</a>
				</li>
			</ul>
		</div>

		<div id="header-menu">
			<a href="./" class="pagetitle" title="pixLoop">pix<b>Loop</b></a>
			<ul id="sections">    
				<li<?php isSelected($_GET['section'], "portada");?>>
					<a href="<?php echo './?site='.$_GET['site'].'&section=portada&page=1'?>" title="Página principal">Portada</a>
				</li>
				<li<?php isSelected($_GET['section'], "nuevas");?>>
					<a href="<?php echo './?site='.$_GET['site'].'&section=nuevas&page=1'?>" title="Ver las últimas noticias">+Nuevas</a>
				</li>  
				<li<?php isSelected($_GET['section'], "destacadas");?>>
					<a href="<?php echo './?site='.$_GET['site'].'&section=destacadas&page=1'?>" title="Ver las noticias más destacadas">+Destacadas</a>
				</li>  
				<li<?php isSelected($_GET['section'], "vistas");?>>
					<a href="<?php echo './?site='.$_GET['site'].'&section=vistas&page=1'?>" title="Ver las noticias más leídas">+Vistas</a>
				</li>
				<li<?php isSelected($_GET['section'], "comentadas");?>>
					<a href="<?php echo './?site='.$_GET['site'].'&section=comentadas&page=1'?>" title="Ver las noticias más comentadas">+Comentadas</a>
				</li>
			</ul>

			<!--<div id="searchform"> 
				<form action="" method="get"> 
					<a href="" id="searchglass">
						<img src="" width="12" height="12" alt="">
					</a>
					<input id="searchbox" name="q" type="text" /> 
				</form> 
			</div> -->
		</div>
<?php 
switch ($_GET['section']) {
	case "destacadas":
	case "vistas":
	case "comentadas":
?>		<div id="header-time">
			<ul id="time-snap">    
				<li<?php isSelected($_GET['time'], "24h");?>>
					<a href="<?php echo './?site='.$_GET['site'].'&section='.$_GET['section'].'&time=24h&page=1';?>" title="Últimas 24 horas">24 horas</a>
				</li>
				<li<?php isSelected($_GET['time'], "48h");?>>
					<a href="<?php echo './?site='.$_GET['site'].'&section='.$_GET['section'].'&time=48h&page=1';?>" title="Últimas 48 horas">48 horas</a>
				</li>
				<li<?php isSelected($_GET['time'], "1s");?>>
					<a href="<?php echo './?site='.$_GET['site'].'&section='.$_GET['section'].'&time=1s&page=1';?>" title="Última semana">Semana</a>
				</li>
				<li<?php isSelected($_GET['time'], "1m");?>>
					<a href="<?php echo './?site='.$_GET['site'].'&section='.$_GET['section'].'&time=1m&page=1';?>" title="Último mes">Mes</a>
				</li>
				<li<?php isSelected($_GET['time'], "6m");?>>
					<a href="<?php echo './?site='.$_GET['site'].'&section='.$_GET['section'].'&time=6m&page=1';?>" title="Últimos 6 meses">6 meses</a>
				</li>
				<li<?php isSelected($_GET['time'], "1a");?>>
					<a href="<?php echo './?site='.$_GET['site'].'&section='.$_GET['section'].'&time=1a&page=1';?>" title="Último año">Año</a>
				</li>
				<li<?php isSelected($_GET['time'], "all");?>>
					<a href="<?php echo './?site='.$_GET['site'].'&section='.$_GET['section'].'&time=all&page=1';?>" title="Todas">Todas</a>
				</li>
			</ul>
		</div>
<?php 
		break;
}
?>
	</div>
	<!--header--> 

<div id="container">
	<!-- sidebar-->
	<div id="sidebar">
		<div class="fb-like-box" data-href="http://www.facebook.com/pixLoop" data-width="300" data-show-faces="true" data-stream="false" data-header="true"></div>
	<a class="twitter-timeline" href="https://twitter.com/pixLoop" data-widget-id="311182746909278208">Tweets por @pixLoop</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		<div id="top-fonts">
			<h3>fuentes +Valoradas</h3>
			<ul>
<?php displayTopFonts($topFonts); ?>
			</ul>
		</div>
	</div>
	<!-- sidebar-->
	<div id="wrapper">
<?php
switch ($_GET['section']) {
	case "portada":
	case "nuevas":
	case "destacadas":
	case "vistas":
	case "comentadas":
		displayNews($news);
		echo '<div style="clear:both;"></div>';
		displayPages($_GET['page'], $totalPages);
		break;
	case "noticia":
		displayStory(mysqli_fetch_array($story));
		//displayComments($comments);
		break;
}
?>
	</div>
	<div style="clear:both;"></div>
</div>
	<div id="footer">
		<p>pixLoop.es ©2013 pixLoop Iniciativas, S.L.</p>
	</div>
</body>
</html>
