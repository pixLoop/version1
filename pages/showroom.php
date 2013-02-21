<?php
function isSelected($target, $current) {
	if ($target == $current) echo ' class="selected"';
}
function isPageSelected($target, $current) {
	if ($target == $current) return ' class="selected"';
}

function displayNews($newsArray) {
	echo '<ul class="list">';
	$adcount = 0;
	while ($row = mysqli_fetch_array($newsArray)) {
		$adcount++;
		if (($adcount % 5) === 3) {
			echo '<li><div class="news-banner">BANNER PUBLICITARIO</div></li>';
		}
?>
	<li id="news-<?php echo $row['id']; ?>">
		<div class="news-body">
			<div class="news-resume">
				<a href="<?php echo $row['url']; ?>" target="_blank">
					<img class="news-image" src="<?php echo $row['image']; ?>"/>
				</a>
				<div class="news-stats">
					<div>
						<span class="news-loops"><?php echo $row['votes']; ?></span> loops
						<button class="loopit">Loop it!</button>
					</div>
					<div><span class="news-views"><?php echo $row['views']; ?></span> visitas</div>
				</div>
				<div class="news-static">
					<div class="news-title"><a href="<?php echo $row['url']; ?>" target="_blank"><h2>
<?php 
	if (strlen($row['title']) >= 80)
		echo substr($row['title'], 0, 77)."...";
	else echo $row['title'];
?>
</h2></a></div>
					<div class="news-text"><?php echo substr($row['resume'], 0, 140); ?>...(<a href="<?php echo $row['url']; ?>" target="_blank">leer+</a>)</div>
				</div>
			</div>
			<div class="news-info">	
				<div class="comments-counter"><a href="" class="counter"><?php echo $row['comments']; ?></a></div>
				<span class="tool">hace 
<?php 
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
	echo '<div id="pagination"><span'.isPageSelected($current, 1).'><a href="./?site='.$_GET['site'].'&section='.$_GET['section'].'&page=1">1</a></span> ';
	if (($current - 3) > 1) echo '... ';

	for ($i = -2; $i <= 2; $i++) {
		if ((($current + $i) > 1) && (($current + $i) < $max)) {
			echo '<span'.isPageSelected($current, ($current + $i)).'><a href="./?site='.$_GET['site'].'&section='.$_GET['section'].'&page='.($current + $i).'">'.($current + $i).'</a></span> ';
		}
	}

	if (($current + 3) < $max) echo '... ';
	echo '<span'.isPageSelected($current, $max).'><a href="./?site='.$_GET['site'].'&section='.$_GET['section'].'&page='.$max.'">'.$max.'</a></span></div>';
}
?>
