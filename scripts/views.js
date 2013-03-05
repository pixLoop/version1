$(document).ready(function() {
	$('.outerlink').click(function() {
		$(this).attr('href', ("./?goto=" + $(this).attr('news_id')));
	});
});
