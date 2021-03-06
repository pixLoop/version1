<?php
function isSelected($target, $current) {
	if ($target == $current) echo ' class="selected"';
}
function isPageSelected($target, $current) {
	if ($target == $current) return ' class="selected"';
}

function displayTopFonts($fonts) {
	while ($font = mysqli_fetch_array($fonts)) {
		echo '<li><a href="'.$font['font'].'" target="_blank">'.$font['font'].'</a></li>';
	}
}

function displayNews($newsArray) {
	echo '<ul class="list">';
	$adcount = 0;
	while ($row = mysqli_fetch_array($newsArray)) {
		$adcount++;
		if (($adcount % 5) === 4) {
			echo '<li><div class="news-banner">BANNER PUBLICITARIO</div></li>';
		}
?>
	<li id="news-<?php echo $row['id']; ?>">
		<div class="news-body">
			<div class="news-resume">
				<a href="<?php echo $row['url']; ?>" class="outerlink" news_id="<?php echo $row['id']; ?>" target="_blank">
<?php if ($row['image'] !== "") echo '<img class="news-image" src="'.$row['image'].'"/>'; ?>
				</a>
				<div class="news-stats">
					<div>
						<span class="news-loops"><?php echo $row['votes']; ?></span> loops
						<button class="loopit" news_id="<?php echo $row['id']; ?>">Loop it!</button>
					</div>
					<div><span class="news-views"><?php echo $row['views']; ?></span> visitas</div>
				</div>
				<div class="news-static">
					<div class="news-title"><a href="<?php echo $row['url']; ?>" class="outerlink" news_id="<?php echo $row['id']; ?>" target="_blank"><h2>
<?php 
	if (strlen($row['title']) >= 80)
		echo substr($row['title'], 0, 77)."...";
	else echo $row['title'];
?>
</h2></a></div>
					<div class="news-text"><?php echo substr($row['resume'], 0, 140); ?>...(<a href="<?php echo './?site='.$_GET['site'].'&section=noticia&story='.$row['id'] ;?>">leer+</a>)</div>
				</div>
			</div>
			<div class="news-info">	
				<div class="comments-counter"><a href="<?php echo './?site='.$_GET['site'].'&section=noticia&story='.$row['id'] ;?>" class="counter"><?php echo $row['comments']; ?></a></div>
				<span class="tool">hace 
<?php 
	date_default_timezone_set('Europe/Madrid');
	$since = time() - strtotime($row['time']);
	if ($since < 60) echo $since." segundos";
	else {
		$sincei = floor($since / 60);
		if ($sincei < 60) echo $sincei." minutos ".($since - (60 * $sincei))." segundos";
		else {
			$sinceh = floor($sincei / 60);
			if ($sinceh < 24) echo $sinceh." horas ".($sincei - (60 * $sinceh))." minutos";
			else {
				$sinced = floor($sinceh / 24);
				if ($sinced < 30) echo $sinced." días ".($sinceh - (24 * $sinced))." horas";
				else {
					$sincem = floor($sinced / 30);
					if ($sincem < 12) echo $sincem." meses ".($sinced - (30 * $sincem))." días";
					else {
						$sincey = floor($sincem / 12);
						echo $sincey." años ".($sincem - (12 * $sincey))." meses";
					}
				}
			}
		}
	}
?>
				</span>
			</div> 
		</div>
	</li>
<?php
	}
	echo "</ul>";
}

function displayPages($current, $max) {
	echo '<div id="pagination"><a href="./?site='.$_GET['site'].'&section='.$_GET['section'].'&page=1"'.isPageSelected($current, 1).'><span>1</span></a> ';
	if (($current - 3) > 1) echo '... ';

	for ($i = -2; $i <= 2; $i++) {
		if ((($current + $i) > 1) && (($current + $i) < $max)) {
			echo '<a href="./?site='.$_GET['site'].'&section='.$_GET['section'].'&page='.($current + $i).'"'.isPageSelected($current, ($current + $i)).'><span>'.($current + $i).'</span></a> ';
		}
	}

	if (($current + 3) < $max) echo '... ';
	echo '<a href="./?site='.$_GET['site'].'&section='.$_GET['section'].'&page='.$max.'"'.isPageSelected($current, $max).'><span>'.$max.'</span></a></div>';
}

function displayStory($story, $comments) {
?>
<div class="story">
	<div id="news-stats">
		<button class="loopit" news_id="<?php echo $story['id']; ?>">Loop it!</button>
		<div id="story-loops"><span class="news-loops"><?php echo $story['votes']; ?></span> loops</div>
		<div id="story-views"><span class="news-views"><?php echo $story['views']; ?></span> visitas</div>
	</div>
	<img id="image" src="<?php echo $story['image']; ?>"/>
	<a id="title" class="outerlink" href="<?php echo $story['url']; ?>" news_id="<?php echo $story['id']; ?>"><h2><?php echo $story['title']; ?></h2></a>
	<hr />
	<p id="font">Fuente: <a href="<?php echo $story['font']; ?>"><?php echo $story['font']; ?></a></p>
	<p id="resume"><?php echo $story['resume']; ?></p>
	<!-- AddThis Button BEGIN -->
	<div class="addthis_toolbox addthis_default_style ">
		<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
		<a class="addthis_button_tweet"></a>
		<a class="addthis_button_google_plusone"></a>
		<a class="addthis_counter addthis_pill_style"></a>
	</div>
	<div id="comments">
		<h3><?php echo $story['comments']; ?> comentarios</h3>
		<ul id="order-comments">
			<li><a>+Nuevos</a></li>
			<li><a>+Votados</a></li>
		</ul>
		<div style="clear:both;"></div>
<?php if(isset($_SESSION["login"]["short"])) {?>
		<div id="post-comment">
			<p>Escribe un comentario:</p>
			<form name="post-form" id="post-form" action="./?comment=<?php echo $story['id']; ?>" method="post">
				<input type="hidden" name="user" value="<?php echo $_SESSION['login']['short']; ?>">
				<p><textarea name="comment" rows="5" cols="71"></textarea></p>
				<p><input type="submit" name="post" value="Comenta"></p>
			</form>
		</div>
<?php } ?>
<?php displayComments($comments); ?>
	</div>
	<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50ca22c1311ce025"></script>
	<!-- AddThis Button END -->
</div>
<?php
}

function displayComments($comments) {
	if (mysqli_num_rows($comments) > 0) {
		echo '<ul id="comments-list">';
		while ($row = mysqli_fetch_array($comments)) {
			echo '<li id="'.$row['id'].'">';
?>
<div>
	<p class="info"><a href="<?php echo $row['url'];?>" target="blank"><?php echo $row['name'];?></a> - hace 
<?php 
	date_default_timezone_set('Europe/Madrid');
	$since = time() - strtotime($row['time']);
	if ($since < 60) echo $since." segundos";
	else {
		$sincei = floor($since / 60);
		if ($sincei < 60) echo $sincei." minutos ".($since - (60 * $sincei))." segundos";
		else {
			$sinceh = floor($sincei / 60);
			if ($sinceh < 24) echo $sinceh." horas ".($sincei - (60 * $sinceh))." minutos";
			else {
				$sinced = floor($sinceh / 24);
				if ($sinced < 30) echo $sinced." días ".($sinceh - (24 * $sinced))." horas";
				else {
					$sincem = floor($sinced / 30);
					if ($sincem < 12) echo $sincem." meses ".($sinced - (30 * $sincem))." días";
					else {
						$sincey = floor($sincem / 12);
						echo $sincey." años ".($sincem - (12 * $sincey))." meses";
					}
				}
			}
		}
	}
?>
	</p>
	<p class="comment">#<?php echo $row['com_id'];?>&nbsp;&nbsp;<?php echo $row['comment'];?></p>
	<p class="comment-rate"><span class="comment-votes"><?php echo $row['votes'];?></span> votos<button class="com-vote pos" news_id="<?php echo $row['news']; ?>" comment_id="<?php echo $row['com_id']; ?>" user_id="<?php echo $_SESSION['login']['short']; ?>">+</button></p>
</div>
<?php		echo '</li>';
		}
		echo '</ul>';
	}
}
?>
