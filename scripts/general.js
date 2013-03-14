function showVoteModal(msg) {
	jQ("#vote-result").html(msg);
	jQ("#accept-vote-form").show();
	var hide = setTimeout(function() {
		jQ("#accept-vote-form").hide();
	}, 3000);
}

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
				showVoteModal(data.result);
			}
		);
	});

	jQ('.com-vote').click(function() {
		var id = jQ(this).attr('news_id');
		var comment = jQ(this).attr('comment_id');
		var user = jQ(this).attr('user_id');

		if (user == "") {
			showVoteModal("Debes estar registrado para poder votar.");
			return;
		}

		jQ.getJSON("./dbcon/vote_comment.php?news=" + id + "&comment=" + comment + "&user=" + user,
			 function(data) {
				showVoteModal(data.result);
			}
		);
	});
});
