$(document).ready(function() {
	$('.outerlink').click(function() {
		$(this).attr('href', ("./?go=" + $(this).attr('href')));
	});
});
