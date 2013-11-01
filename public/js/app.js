$(document).ready(function() {
	
	$(".close").click( function() { $('.notice').slideUp('slow') } )
	setTimeout(function () {
	   $('.notice').slideUp('slow');
	}, 2000);
	
	//Autoselect
	$(".cycles ul li:first").trigger('click');
	$(".matieres ul li:first").trigger('click');
});
