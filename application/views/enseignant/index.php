<?  if ($this->session->userdata['profil']>3){ ?>
	<div id="navlinks">
<?= anchor('admin','Utiliser la vue Administrateur'); ?>
	</div>
<? } ?>
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
<li> Horaire : <span id='horaire'></span> </li>
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

<h3>Commentaire général</h3>
<p>Commun à tous les inscrits.</p>
<div id='AccompagnementCommentaire'>
</div>
	

<h3>Présences</h3>
<div class="presence">
	<div id='date_seance'></span></div>
	<div id='liste_presence'></div>
</div>

<h3>Liste des élèves sans inscription pour ce cycle</h3>
<div id="nonInscrits">
</div>

<div id="InfosEleves">
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
		ans="<table class='bordered tablesorter'><thead><tr><th>Nom</th><th>Prénom</th><th>Présence</th><th>Commentaire individuel (commun à toutes les séances)</th><th></th></tr></thead><tbody>"
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
				ans+= "<td><button class='presenceButton' seance_id='"+eleves[i].seance_id+"' eleve_id='"+eleves[i].eleve_id+"' abs='"+abs+"'>"+abstxt+"</button></td>"
				com = eleves[i].commentaire.replace(/'/g, '&#39;');	
				ans+= "<td><input type='text' value='"+com+"' accompagnement_id='"+eleves[i].accompagnement_id+"' eleve_id='"+eleves[i].eleve_id+"' class='commentaire' /></td>"
				ans+= '<td><button class="infosEleves" eleve_id="'+eleves[i].eleve_id+'">Infos</button></td>'
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
	
function setCommentaire(){
	var eleve_id = $(this).attr('eleve_id') 
	var accompagnement_id = $(this).attr('accompagnement_id') 
	var comment = {commentaire:$(this).val()}
	var myurl = '<?=site_url()?>/seances/setCommentaire/'+accompagnement_id+'/'+eleve_id;
	$.ajax({
		url:myurl,
		type: "POST",
		data: comment
	}).done(function(data) {
		if (!data.logged) window.location.reload() 
	})
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
			$('#liste_presence .infosEleves').click(infosEleve)
			$("#liste_presence .presenceButton").click(presenceHandler)
			$("#liste_presence input.commentaire").change(setCommentaire)
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


function commentaireGeneralHandler(){
	var accompagnement_id = $(this).attr('accompagnement_id') 
	var comment = {commentaire:$(this).val()}
	var myurl = '<?=site_url()?>/accompagnement/setCommentaire/'+accompagnement_id;
	$.ajax({
		url:myurl,
		type: "POST",
		data: comment
	}).done(function(data) {
		if (!data.logged) window.location.reload() 
	})
}

function commentaireGeneral(accompagnement_id,com){
	if (accompagnement_id=='') return('');
	com = com.replace(/'/g, '&#39;');
	ans = "<input type='text' id='submitCommentaireGeneral' accompagnement_id="+accompagnement_id+"  value='"+com+"'/>"
	return ans
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
			$('#horaire').html(data.horaire);
			if (isNaN(data.places)) $('#inscriptionForm button[name="inscription"]').prop("disabled", true);
			$("#validerSeance button").prop("disabled", true);
			$("#validerSeance button").addClass("unactivated");	
			$("#liste_presence").html("");
			$("#AccompagnementCommentaire").html(commentaireGeneral(data.accompagnement_id,data.commentaire))
			$("#submitCommentaireGeneral").change(commentaireGeneralHandler)
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

function infosEleve(){
	var eleve_id = $(this).attr('eleve_id')
	$("#InfosEleves").css('opacity',0.8)
	infos=''
	infos+='<span class="closeInfos" onclick="$(\'#InfosEleves\').fadeTo(\'opacity\',0)">Fermer</span>'
	infos+=eleve_id
	$("#InfosEleves").html(infos)
}

function afficheNonInscrits(eleves){
		ans="<table class='bordered tablesorter'><thead><tr><th>Nom</th><th>Prénom</th><th>Classe</th><th></th></tr></thead><tbody>"
		for(var i=0;i<eleves.length;++i) {
				ans+= "<tr>"
				ans+= "<td>"+eleves[i].nom+ "</td>"
				ans+= "<td>"+eleves[i].prenom+"</td>"
				ans+= "<td>"+eleves[i].classe+"</td>"
				ans+= '<td><button class="infosEleves" eleve_id="'+eleves[i].eleve_id+'">Infos</button></td>'
				ans+="</tr>" 
			}
		ans+="</tbody></table>"
		return ans 
	}

function remplirListeDesNonInscrits(cycle_id){
	myurl = '<?=site_url()?>/inscription/getNonInscrits/'+cycle_id;
	$.ajax({
		url:myurl, 
		context: document.body 
	}).done(function(data) {
		if (!data.success) window.location.reload()
		$('#nonInscrits').html(afficheNonInscrits(data.liste))
		$('#nonInscrits table').tablesorter()
		$('#nonInscrits .infosEleves').click(infosEleve)
	})
}

	
$(document).ready(function() {
		
	$(".cycles ul li").click(function(){
		$('.cycles .highlight').removeClass('highlight')
		$(this).toggleClass('highlight')
		var cycle_id=$(this).attr('name')
		$('#inscriptionForm input[name="cycle_id"]').val(cycle_id)
		unactivateMatieres(cycle_id)
		remplirListeDesNonInscrits(cycle_id)
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



