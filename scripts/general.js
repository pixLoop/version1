$(document).ready(function() {
	$("#login-link").click(function() {
		$("#login-form").show();
	});
	$(".modal-close").click(function() {
		$(".modal-background").hide();
	});

	$('.outerlink').click(function() {
		$(this).attr('href', ("./?goto=" + $(this).attr('news_id')));
	});

	$('.loopit').click(function() {
		var id = $(this).attr('news_id');
		$.getJSON("./dbcon/vote.php?news=" + id,
			 function(data) {
				$("#vote-result").html(data.result);
				$("#accept-vote-form").show();
				var hide = setTimeout(function() {
					$("#accept-vote-form").hide();
				}, 3000);
			}
		);
	});
});
