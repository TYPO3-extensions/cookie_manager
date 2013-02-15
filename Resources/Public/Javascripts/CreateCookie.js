$('document').ready(function() {
	$('.cookiemanager .buttons a').on('click', function(e) {
		e.preventDefault();
		$.getJSON($(this).attr('href'), function(data) {
			$('.cookiemanager .buttons').html(data.msg);
		});
	});
});