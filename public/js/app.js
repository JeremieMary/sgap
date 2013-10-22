
function activateSuscribe(){
	if ($('.highlight').length == 2) $('#inscriptionForm button[name="inscription"]').removeAttr("disabled");
}
	
$(document).ready(function() {

	$(".close").click( function() { $('.notice').slideUp('slow') } )
	setTimeout(function () {
	   $('.notice').slideUp('slow');
	}, 2000);
	
	$(".cycles ul li").click(function(){
		$('.cycles .highlight').removeClass('highlight')
		$(this).toggleClass('highlight');
		$('#inscriptionForm input[name="cycle_id"]').val( $(this).attr('name') );
		activateSuscribe();
	})
	
	$(".matieres ul li").click(function(){
		$('.matieres .highlight').removeClass('highlight')
		$(this).toggleClass('highlight');
		$('#inscriptionForm input[name="matiere_id"]').val( $(this).attr('name') );
		activateSuscribe();
	})
	
	
});