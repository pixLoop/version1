function newsView(news) {
	$.load("../ajax/pageViews.php", {
		post: news
	}, function(data, status) {
		$("#news-" + news + " .news-views").html(data);
	});
};