jQuery.noConflict();
(function($) {

$(function() {
	$(window).scroll(function(){
		var distanceTop = $('#wpfurtherreading_anchor').offset().top - $(window).height();
		console.log(distanceTop);
		
		if  ($(window).scrollTop() > distanceTop)
			$('#slidebox').animate({'right':'0px'},300);
		else 
			$('#slidebox').stop(true).animate({'right':'-430px'},100);	
	});
	
	
	$('#slidebox .close').bind('click',function(){
		$(this).parent().remove();
	});
});

})(jQuery);