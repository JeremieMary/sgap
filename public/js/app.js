	
$(document).ready(function() {

	$(".close").click( function() { $('.notice').slideUp('slow') } )
	setTimeout(function () {
	   $('.notice').slideUp('slow');
	}, 2000);
});