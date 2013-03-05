<?php
function isSelected($target, $current) {
	if ($target == $current) echo ' class="selected"';
}
function isPageSelected($target, $current) {
	if ($target == $current) return ' class="selected"';
}

function displayStory($story) {
	echo '<div class="story">';
	echo '<div id="news-stats">
			<button id="loopit">Loop it!</button>
			<div id="story-loops"><span class="news-loops">'.$story['votes'].'</span> loops</div>
			<div id="story-views"><span class="news-views">'.$story['views'].'</span> visitas</div>
		</div>';
	echo '<img id="image" src="'.$story['image'].'"/>';
	echo '<a id="title" href="'.$story['url'].'"><h2>'.$story['title'].'</h2></a>';
	echo '<p id="font">Fuente: <a href="'.$story['font'].'">'.$story['font'].'</a></p>';
	echo '<p id="resume">'.$story['resume'].'</p>';
	echo '<!-- AddThis Button BEGIN -->
		<div class="addthis_toolbox addthis_default_style ">
		<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
		<a class="addthis_button_tweet"></a>
		<a class="addthis_button_pinterest_pinit"></a>
		<a class="addthis_counter addthis_pill_style"></a>
		</div>
		<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50ca22c1311ce025"></script>
		<!-- AddThis Button END -->';
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
