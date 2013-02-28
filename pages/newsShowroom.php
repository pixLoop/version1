<?php
function isSelected($target, $current) {
	if ($target == $current) echo ' class="selected"';
}
function isPageSelected($target, $current) {
	if ($target == $current) return ' class="selected"';
}

function displayStory($story) {
	echo '<div class="story">';
	if ($story['image'] !== "")
		echo '<img src="'.$story['image'].'">';
	echo '<h2>'.$story['title'].'<h2>';
	echo '<h5>Fuente: '.$story['font'].'<h5>';
	echo '<p>'.$story['resume'].'</p>';
	echo '</div>';
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
?>
