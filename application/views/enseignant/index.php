<h2>Inscriptions</h2>
<div class="cycles">
<ul>
	<? foreach ($cycles as $cycle){?>
		<li name='<?=$cycle["id"]?>'> <?
			$date =date_create_from_format("d/m/Y",$cycle['debut']);
			$timestamp = $date->getTimestamp(); 
			echo strftime( "%a %d/%m/%Y", $timestamp ); ?>
	<?}?>
</ul>
</div>

<div class="matieres">
<ul>
	<? foreach ($matieres as $matiere){?>
		<li name='<?=$matiere["id"]?>'> <?=$matiere['nom']?>
	<?}?>
</ul>
</div>

<div class="infos">
	<h3>Informations</h3>
<ul>
<li> Nombre de places : <span id='nbPlaces'></span> </li>
<li> Nombre d'inscrits : <span id='nbInscrits'></span> </li>
<li> Dates : <span id='dates'></span> </li>
<li> Salle : <span id='salle'></span> </li>
</ul>
</div>


<? echo form_open('eleve/inscription',array('id' => 'inscriptionForm')); ?>	
<input type='hidden' name='matiere_id' value=''>
<input type='hidden' name='cycle_id' value=''>
</form>

<h2>Liste des inscrits à cet accompagnement</h2>
<div class="inscrits">
</div>



<h2>Séances</h2>

<h3>Dates des séances</h3>
<div id='datesSelector'>
</div>

<div id='validerSeance'><button class='unactivated' disabled>Valider séance</button></div>

<h3>Présences</h3>
<div class="presence">
	<div id='date_seance'></span>
	<div id='liste_presence'></div>
</div>


<script type='text/javascript'>
var accompagnement=<?=json_encode( $accompagnement )?>	

function unactivateMatieres(cycle_id){
	//$(".cycles ul li").removeClass('unactivated')
	$(".matieres ul li").addClass('unactivated')
	for (var i in accompagnement) {
		if (accompagnement[i].cycle_id == cycle_id) {
			matiere_id=accompagnement[i].matiere_id
			$('.matieres ul li[name="'+matiere_id+'"]').removeClass('unactivated')
		} 
	}
}

function unactivateCycles(matiere_id){
	//$(".matieres ul li").removeClass('unactivated')
	$(".cycles ul li").addClass('unactivated')
	for (var i in accompagnement) {
		if (accompagnement[i].matiere_id == matiere_id) {
			cycle_id=accompagnement[i].cycle_id
			$('.cycles ul li[name="'+cycle_id+'"]').removeClass('unactivated')
		} 
	}
}


function display_dates(seances){
	ret='<ul>'
	for(var i=0;i<seances.length;++i){
		if (seances[i].validee==1) cl='validee'; else cl='nonvalidee';
		ret+='<li seance_id='+seances[i].seance_id+' class='+cl+'>'+seances[i].date
	}
	ret+='</ul>'
	return(ret);
}

function dateSelectorHandler(){
	$("#datesSelector ul li").click(function(){
		$('#datesSelector ul li').removeClass('highlight')
		$(this).toggleClass('highlight')
		var that=$(this);
		var seance_id=$(this).attr('seance_id')
		myurl = '<?=site_url()?>/seances/getPresences/'+seance_id;
		$.ajax({
			url:myurl 
		}).done(function(data) {
			if (!data.logged) window.location.reload()
			$("#liste_presence").html(JSON.stringify(data.presences))
			if (data.presences.length && that.hasClass('nonvalidee') ) {
				$("#validerSeance button").prop("disabled", false);
				$("#validerSeance button").removeClass("unactivated");
				$("#validerSeance button").click(function(){
					$.ajax({
						url:'<?=site_url()?>/seances/valider/'+seance_id
					}).done(function(){
						$("#validerSeance button").prop("disabled", true);
						$("#validerSeance button").addClass("unactivated");	
					})
				})
			} else {
				$("#validerSeance button").prop("disabled", true);
				$("#validerSeance button").addClass("unactivated");	
			}
			
		});
	})
}

function activateSuscribe(){
	if (($('.cycles .highlight').length == 1) && ($('.matieres .highlight').length == 1)) {
		//$('#inscriptionForm button[name="inscription"]').prop("disabled", false);;
		cycle_id=$('#inscriptionForm input[name="cycle_id"]').val();
		matiere_id=$('#inscriptionForm input[name="matiere_id"]').val();
		myurl = '<?=site_url()?>/inscription/getNbPlacesRestantes/'+cycle_id+'/'+matiere_id;
		$.ajax({
			url:myurl, 
			context: document.body 
		}).done(function(data) {
			$('#salle').html(data.salle);
			$('#dates').html(data.dates.join(', '));
			$('#nbPlaces').html(data.places);
			$('#nbInscrits').html(data.nb_inscrits);
			if (isNaN(data.places)) $('#inscriptionForm button[name="inscription"]').prop("disabled", true);
			$("#validerSeance button").prop("disabled", true);
			$("#validerSeance button").addClass("unactivated");	
			$("#liste_presence").html("");
		});
		
		myurl2 = '<?=site_url()?>/inscription/getInscrits/'+cycle_id+'/'+matiere_id;
		$.ajax({
			url:myurl2, 
			context: document.body 
		}).done(function(data) {
			if (!data.logged) window.location.reload()
			$(".inscrits").html(JSON.stringify(data.inscrits))
		});
		
		myurl3 = '<?=site_url()?>/seances/getIdsAndDates/'+cycle_id+'/'+matiere_id;
		$.ajax({
			url:myurl3, 
			context: document.body 
		}).done(function(data) {
			if (!data.logged) window.location.reload()
			$("#datesSelector").html(display_dates(data.seances_ids))
			dateSelectorHandler()
		});
			
	}
}
	
$(document).ready(function() {
		
	$(".cycles ul li").click(function(){
		$('.cycles .highlight').removeClass('highlight')
		$(this).toggleClass('highlight')
		var cycle_id=$(this).attr('name')
		$('#inscriptionForm input[name="cycle_id"]').val(cycle_id)
		unactivateMatieres(cycle_id)
		activateSuscribe()
	})
	
	$(".matieres ul li").click(function(){
		$('.matieres .highlight').removeClass('highlight')
		$(this).toggleClass('highlight')
		var matiere_id=$(this).attr('name')
		$('#inscriptionForm input[name="matiere_id"]').val(matiere_id)
		unactivateCycles(matiere_id)
		activateSuscribe()
	})
	
	
});
</script>



