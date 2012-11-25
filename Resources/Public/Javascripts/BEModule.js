var $j = jQuery.noConflict();
$j(document).ready(function(){
	$j('.deleteGroupCookie').each(function(){
		$j(this).click(function(e){
			e.preventDefault();
			$j(this).parent().remove();
		})
	});
});