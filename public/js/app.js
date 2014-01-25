$(document).ready(function() {
	
	$(".close").click( function() { $('.notice').slideUp('slow') } )
	setTimeout(function () {
	   $('.notice').slideUp('slow');
	}, 2000);
	
	//Autoselect
	$(".cycles ul li:first").trigger('click');
	$(".matieres ul li:first").trigger('click');
});

function tabnav( tab ) {
			tab.bind('keydown', function(event) {
			  if(event.keyCode == 9){ //for tab key
				   $(this).blur();
				   $(this).parents('tr').next().find('span > input').focus();
			    return false; 
			  }
			});
}