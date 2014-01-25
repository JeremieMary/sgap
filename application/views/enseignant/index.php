<?  if ($this->session->userdata['profil']>3){ ?>
	<div id="navlinks">
<?= anchor('admin','Utiliser la vue Administrateur'); ?>
	</div>
<? } ?>


<div id="cycle_matiere">
	<div class="cycles">
		<h3>Cycle</h3>
	<ul>
		<? foreach ($cycles as $cycle){?>
			<li name='<?=$cycle["id"]?>'> <?
				$date =date_create_from_format("d/m/Y",$cycle['debut']);
				$timestamp = $date->getTimestamp(); 
				echo strftime( "%a %d/%m/%Y", $timestamp ); ?>
			</li>
		<?}?>
	</ul>
	</div>
	
	<div class="matieres">
		<h3>Matière</h3>
	<ul>
		<? foreach ($matieres as $matiere){
			$class = ($matiere['type']==1 ) ? 'perso' : 'rencontre'
		?>
			<li name='<?=$matiere["id"]?>' class='<?=$class?>'> <?=$matiere['nom']?> </li>
		<?}?>
	</ul>
	</div>
	
	<div class="infos">
		<h3>Informations</h3>
		<ul>
		<li> Nombre de places : <span id='nbPlaces'></span> </li>
		<li> Nombre d'inscrits : <span id='nbInscrits'></span> </li>
		<li> Salle : <span id='salle'></span> </li>
		<li> Horaire : <span id='horaire'></span> </li>
		</ul>
	</div>
	
	<div id="date">
		 	<h3>Dates </h3>
			<div id='datesSelector'>
			</div>
			<div id='validerSeance'><button class='unactivated' disabled>Valider tenue de la séance</button></div>
		</div>
	
</div>



<!--
<h2>Liste des inscrits à cet accompagnement</h2>
<div class="inscrits">
</div>
-->


<!-- <h2>Séances</h2> -->


<div id="commentaire">
	<h3>Commentaire de groupe.</h3>
	<p>Sera lisible et commun à tous les inscrits à cet accompagnement.</p>
	<div id='AccompagnementCommentaire'>
	</div>


</div>	

<div id="presence">
	<h3>Présences et commentaires</h3>
	<div class="presence">
		<div id='date_seance'></span></div>
		<div id='liste_presence'></div>
	</div>
</div>

<div id='masscom'>
<input type='text' placeholder='Cette zone sert à écrire un commentaire personnalisé qui sera affecté à tous les élèves inscrits à cet accompagnement' id='masstxt' />
<button type='submit' id='massperso'>Envoyer</button>
</div>


<? if ($this->session->userdata['profil']>2) {  ?>
<div id="liste_inscrits">
	<h3>Liste des élèves sans inscription pour ce cycle</h3>
	<div id="nonInscrits">
	</div>
	<div id="InfosEleves">
		<span class="closeInfos" onclick="$('#InfosEleves').fadeOut('slow', function(){$('#InfosEleves').width(0)}) ">Fermer</span>
		<span class="name"></span>
		<span class="text"></span> 
	</div>
</div>
<? } ?>

<? echo form_open('eleve/inscription',array('id' => 'inscriptionForm')); ?>	
<input type='hidden' name='matiere_id' value=''>
<input type='hidden' name='cycle_id' value=''>
</form>


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
	var dayNames = ['Dimanche','Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi']
	for(var i=0;i<seances.length;++i){
		var d = new Date(seances[i].date)
		var curr_date = d.getDate();
		var curr_month = d.getMonth() + 1; //Les mois démarrent à 0
		var curr_year = d.getFullYear();
		var ds = dayNames[d.getDay()]+" "+curr_date + "/" + curr_month + "/" + curr_year
		if (seances[i].validee==1) cl='validee'; else cl='nonvalidee';
		ret+='<li seance_id='+seances[i].seance_id+' class='+cl+'>'+ ds
	}
	ret+='</ul>'
	return(ret);
}

function affichePresences(eleves){
		ans="<table class='bordered tablesorter'><thead><tr><th>Nom</th><th>Prénom</th><th>Présence</th><th>Commentaire individuel (commun à toutes les dates de l'accompagnement) </th><th></th></tr></thead><tbody>"
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
				ans+= "<td>"+eleves[i].nom.toUpperCase()+ "</td>"
				var prenom = eleves[i].prenom[0].toUpperCase() + eleves[i].prenom.substring(1);
				ans+= "<td>"+prenom+"</td>"
				ans+= "<td><button class='presenceButton' seance_id='"+eleves[i].seance_id+"' eleve_id='"+eleves[i].eleve_id+"' abs='"+abs+"'>"+abstxt+"</button></td>"
				com = eleves[i].commentaire.replace(/'/g, '&#39;');	
				ans+= "<td><span><input type='text' value='"+com+"' accompagnement_id='"+eleves[i].accompagnement_id+"' eleve_id='"+eleves[i].eleve_id+"' class='commentaire' /></span></td>"
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
		flashmsg('Sauvegarde commentaire') 
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
			tabnav( $("#liste_presence table span") )
			$('#liste_presence .infosEleves').focus(infosEleve)
			$("#liste_presence .presenceButton").click(presenceHandler)
			$("#liste_presence input.commentaire").change(setCommentaire)
			if (data.presences.length && that.hasClass('nonvalidee') ) {
				$("#validerSeance button").prop("disabled", false);
				$("#validerSeance button").removeClass("unactivated");
				//$("#validerSeance button").text("Valider séance");
				$("#validerSeance button").unbind( "click" );
				$("#validerSeance button").click(function(){
					$.ajax({
						url:'<?=site_url()?>/seances/valider/'+seance_id
					}).done(function(){
						$("#validerSeance button").prop("disabled", true);
						$("#validerSeance button").addClass("unactivated");	
						//$("#validerSeance button").text("Invalider séance");
						that.addClass("validee");
						that.removeClass("nonvalidee");
					})
				})
			} else {
				$("#validerSeance button").prop("disabled", true);
				$("#validerSeance button").addClass("unactivated");
				//$("#validerSeance button").text("Invalider séance");	
			}
			
		});
	});
	if ( $("#datesSelector ul li.nonvalidee:first").length==0 ){
		$("#datesSelector ul li:last").trigger('click')
	 } else {
	 	$("#datesSelector ul li.nonvalidee:first").trigger('click')
	 }
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
		flashmsg('Sauvegarde commentaire général') 
	})
}

function commentaireGeneral(accompagnement_id,com){
	if (accompagnement_id=='') return('');
	com = com.replace(/'/g, '&#39;');
	ans = "<textarea rows='2' id='submitCommentaireGeneral' accompagnement_id="+accompagnement_id+">"+com+"</textarea>"
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
			//$('#dates').html(data.dates.join(', '));
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
	$('#InfosEleves').fadeIn('fast')
	$('#InfosEleves').css('opacity',0.9)
	var myurl = '<?=site_url()?>/seances/getInfosOf/'+eleve_id;
	var tr = $(this).closest("tr");
	var nom = tr.find('td:first-child').text()
	var prenom = tr.find('td:nth-child(2)').text()
	$('#InfosEleves').attr('eleve_id',eleve_id)
	$('#InfosEleves .name').html('<h3>'+nom+' '+prenom+'</h3>')
	$.ajax({
		url:myurl,
	}).done(function(data) {
		//if (!data.logged) window.location.reload()
		$('#InfosEleves').width('62%') 
		$('#InfosEleves .text').html(data)
	})
	
}

function afficheNonInscrits(eleves){
		ans="<table class='bordered tablesorter'><thead><tr><th>Nom</th><th>Prénom</th><th>Classe</th><th></th></tr></thead><tbody>"
		for(var i=0;i<eleves.length;++i) {
				ans+= "<tr eleve_id='"+eleves[i].eleve_id+"'>"
				ans+= "<td>"+eleves[i].nom.toUpperCase()+ "</td>"
				prenom = eleves[i].prenom[0].toUpperCase() + eleves[i].prenom.substring(1);
				ans+= "<td>"+prenom+"</td>"
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
		$('#nonInscrits .infosEleves').focus(infosEleve)
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
	
	$("#massperso").click(function(){
		var txt = $("#masstxt").val()
		if (txt != ''){
			if (confirm("Attention cette action va remplacer tous les commentaires personnalisés de cet accompagnement et est irréversible. Confirmez vous ?")){
			$("#liste_presence span input").each( function(){ 
				$(this).val(txt)
				$(this).trigger('change') 
			})
		}
	}
	})
	
	
});
</script>



