<? 
if ($this->session->userdata['profil']>3){
	echo anchor('admin','Utiliser la vue Administrateur');
}
?>
<h2>Sélection du cycle et de la matière</h2>
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

<!--
<h2>Liste des inscrits à cet accompagnement</h2>
<div class="inscrits">
</div>
-->


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

function affichePresences(eleves){
		ans="<table class='bordered tablesorter'><thead><tr><th>Nom</th><th>Prénom</th><th>Présence</th><th>Commentaire (commun à toutes les séances)</th></tr></thead><tbody>"
		var abs;
		var abstxt;
		var cla;
		for(var i=0;i<eleves.length;++i) {
				if (eleves[i].absent===null) {
					cla=""
					abstxt="Présent"
					abs=true
				} else {
					cla="class='absent'"
					abstxt="Absent"
					abs=false
				}
				ans+= "<tr "+cla+">"
				ans+= "<td>"+eleves[i].nom+ "</td>"
				ans+= "<td>"+eleves[i].prenom+"</td>"
				//ans+= "<td>"+abstxt+"</td>"
				ans+= "<td><button seance_id='"+eleves[i].seance_id+"' eleve_id='"+eleves[i].eleve_id+"' abs='"+abs+"'>"+abstxt+"</button></td>"	
				ans+= "<td><input type='text' value='"+eleves[i].commentaire+"' accompagnement_id='"+eleves[i].accompagnement_id+"' eleve_id='"+eleves[i].eleve_id+"' class='commentaire' /></td>"
				ans+="</tr>" 
			}
		ans+="</tbody></table>"
		ans+='<button>Sauver</button>'	
		return(ans)
	}

function presenceHandler() {
		var seance_id = $(this).attr('seance_id') ;
		var eleve_id = $(this).attr('eleve_id') ;
		var abs = $(this).attr('abs') ;
		var myurl = '<?=site_url()?>/seances/setAbsence/'+seance_id+'/'+eleve_id+'/'+abs;
		var that=$(this)
		$.ajax({
			url:myurl 
		}).done(function(data) {
			if (!data.logged) window.location.reload()
			if (abs==="true") {
				that.attr('abs',false)
				that.html('Absent')
				//that.parent('td').prev('td').html('Absent')
				that.closest('tr').addClass('absent')
			} else {
				that.attr('abs',true)
				that.html('Présent')
				//that.parent('td').prev('td').html('Présent')
				that.closest('tr').removeClass('absent')
			}
		})
	}
	
function saveCommentaire(){
	alert( $(this).attr('eleve_id') )
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
			$("#liste_presence").html(affichePresences(data.presences))
			$("#liste_presence table.tablesorter").tablesorter()
			$("#liste_presence table button").click(presenceHandler)
			$("#liste_presence input.commentaire").change(saveCommentaire)
			if (data.presences.length && that.hasClass('nonvalidee') ) {
				$("#validerSeance button").prop("disabled", false);
				$("#validerSeance button").removeClass("unactivated");
				$("#validerSeance button").unbind( "click" );
				$("#validerSeance button").click(function(){
					$.ajax({
						url:'<?=site_url()?>/seances/valider/'+seance_id
					}).done(function(){
						$("#validerSeance button").prop("disabled", true);
						$("#validerSeance button").addClass("unactivated");	
						that.addClass("validee");
						that.removeClass("nonvalidee");
					})
				})
			} else {
				$("#validerSeance button").prop("disabled", true);
				$("#validerSeance button").addClass("unactivated");	
			}
			
		});
	});
	$("#datesSelector ul li.nonvalidee:first").trigger('click')
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



