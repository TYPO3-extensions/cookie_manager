$('document').ready(function(){
	$('.createCookieAction a').live('click', function(e){
		e.preventDefault();
		$.getJSON($(this).attr('href'), function(data) {
				$('.createCookieAction').html(data.msg);
			});
	});
});