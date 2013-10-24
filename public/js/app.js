
function activateSuscribe(){
	if (($('.cycles .highlight').length == 1) && ($('.matieres .highlight').length == 1)) {
		$('#inscriptionForm button[name="inscription"]').removeAttr("disabled");
		cycle_id=$('#inscriptionForm input[name="cycle_id"]').val();
		matiere_id=$('#inscriptionForm input[name="matiere_id"]').val();
		myurl = './inscription/getNbPlacesRestantes/'+cycle_id+'/'+matiere_id;
		$.ajax({
			url:myurl, 
			context: document.body 
		}).done(function(data) {
			$('#nbPlaces').html(data.places);
			$('#nbInscrits').html(data.nb_inscrits);
		});
			
	}
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
