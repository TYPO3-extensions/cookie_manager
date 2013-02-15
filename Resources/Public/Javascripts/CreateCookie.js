$('document').ready(function() {
	$('.createCookieAction a').on('click', function(e) {
		e.preventDefault();
		$.getJSON($(this).attr('href'), function(data) {
			$('.createCookieAction').html(data.msg);
		});
	});
});