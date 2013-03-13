var jQ = jQuery.noConflict();
jQ(document).ready(function() {
	jQ("#login-link").click(function() {
		jQ("#login-form").show();
	});
	jQ(".modal-close").click(function() {
		jQ(".modal-background").hide();
	});

	jQ('.outerlink').click(function() {
		jQ(this).attr('href', ("./?goto=" + jQ(this).attr('news_id')));
	});

	jQ('.loopit').click(function() {
		var id = jQ(this).attr('news_id');
		jQ.getJSON("./dbcon/vote.php?news=" + id,
			 function(data) {
				jQ("#vote-result").html(data.result);
				jQ("#accept-vote-form").show();
				var hide = setTimeout(function() {
					jQ("#accept-vote-form").hide();
				}, 3000);
			}
		);
	});
});
