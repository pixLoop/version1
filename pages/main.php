<?php
	require("./pages/mainShowroom.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>pixLoop - Descubre qué se cuece entre videojuegos</title>

	<link rel="stylesheet" type="text/css" media="all" href="./css/general.css"/>
	<link rel="stylesheet" type="text/css" media="all" href="./css/main.css"/>
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
		<div id="header-time">
			<ul id="time-snap">    
				<li class="selected">
					<a href="/" title="Últimas 24 horas">24 horas</a>
				</li>
				<li>
					<a href="/" title="Últimas 48 horas">48 horas</a>
				</li>
				<li>
					<a href="/" title="Última semana">Semana</a>
				</li>
				<li>
					<a href="/" title="Último mes">Mes</a>
				</li>
				<li>
					<a href="/" title="Últimos 6 meses">6 meses</a>
				</li>
				<li>
					<a href="/" title="Último año">Año</a>
				</li>
				<li>
					<a href="/" title="Todas">Todas</a>
				</li>
			</ul>
		</div>
	</div>
	<!--header--> 

	<div id="newswrap">
<?php
	displayNews($news);
	displayPages($_GET['page'], $totalPages);
?>
	</div>

	<div id="footer">
		<p>pixLoop.es ©2013 pixLoop Iniciativas, S.L.</p>
	</div>
</body>
</html>
