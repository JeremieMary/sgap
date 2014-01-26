<?  if ($this->session->userdata['profil']>3){ ?>
	<div id="navlinks">
		<?=anchor('enseignant','Utiliser la vue Enseignant')?>
	</div>
<? } ?>


<div id='importation'>
<h3>Importation de données</h3>
<div class="upload_form">
<?php echo form_open_multipart('admin/uploadFile/users', array('name'=>'users') );?>
<label for="userfile"> Chargement des utilisateurs - CSV : </label>
<input type="file" name="usersfile" size="20" onchange="this.form.submit();" />
<input type="submit"  value="upload" />
</form>	</div>

<div class="upload_form">
<?php echo form_open_multipart('admin/uploadFile/cycles', array('name'=>'cycles') );?>
<label for="cyclesfile"> Chargement des cycles - CSV : </label>
<input type="file" name="cyclesfile" size="20" onchange="this.form.submit();" />
<input type="submit" value="upload" />	
</form>	</div>

<div class="upload_form">
<?php echo form_open_multipart('admin/uploadFile/matieres', array('name'=>'matieres') );?>
<label for="matieresfile"> Chargement des matières - CSV : </label>
<input type="file" name="matieresfile" size="20" onchange="this.form.submit();" />
<input type="submit" value="upload" />	
</form>	</div>
</div>

<div id="bloc_accompagnement">
	<h3>Création d'accompagnement</h3>
	<div id='creation_accompagnement'>
	<div class="cycles">
		<label> Cycles </label>
	<ul>
		<? foreach ($cycles as $cycle){?>
			<li name='<?=$cycle["id"]?>'> <?=datefr($cycle['debut']);?>
		<?}?>
	</ul>
	</div>

	<div class="matieres">
		<label> Matières </label>
	<ul>
		<? foreach ($matieres as $matiere){?>
			<li name='<?=$matiere["id"]?>'> <?=$matiere['nom']?>
		<?}?>
	</ul>
	</div>

	<div class="profs">
		<label> Professeur </label>
	<ul>
		<? foreach ($profs as $prof){?>
			<li name='<?=$prof["id"]?>'> <?=strtoupper($prof['nom'])?>, <?=$prof['prenom']?>
		<?}?>
	</ul>
	</div>

	<div class="salles">
		<label> Salle </label>
	<ul>
		<? foreach ($salles as $salle){?>
			<li> <?=$salle['salle']?>
		<?}?>
	</ul>
	</div>
	

	<? echo form_open('accompagnement/creer',array('id' => 'accompagnementForm')); ?>	
	<input type='hidden' name='matiere_id' value=''>
	<input type='hidden' name='cycle_id' value=''>
	<input type='hidden' name='enseignant_id' value=''>
	<input type='hidden' name='salle' value=''>
	<button type='submit' name='creer' disabled >Créer</button>
	</form>
	</div>
</div>

<div id="infos_admin">
<h3>Informations sur les séances du couple cycle/matière sélectionné</h3> 
<ul>
<li> Nombre de places : <span id='nbPlaces'></span> </li>
<li> Nombre d'inscrits : <span id='nbInscrits'></span> </li>
<li> Salle : <span id='salle'></span> </li>
<li> Horaire : <span id='horaire'></span> </li>
<li> Parcours : <span id='type'></span></li>
<li> <div id="date_admin">
		 	Dates :
			<div id='datesSelector'>
			</div>
		</div></li>
</ul>
<div id="reaffecter"></div>
</div>

<div class="accompagnement">
<h3>Liste des accompagnements </h3>
<? if (count($accompagnement)>0) { ?>	
<table class="bordered tablesorter">
    <thead>
    <tr>
		<?
		//$keys = array_keys($accompagnement[0]);
		$keys = array('Cycle','Matière','Horaire','Enseignant responsable','Salle');
		foreach ($keys as $key ) echo "<th>$key</th>";
		?>
		<th></th>
		<th></th>
    </tr>
    </thead>
    <tbody>
            <?php foreach($accompagnement as $field){?>
                <tr <? if (!$field['actif']) echo 'class="unactivated"' ?> >
					<td>
						<?=datefr($field['cycle_debut'])?>
					</td>
					<td><?=trim($field['matiere'])?></td>
					<td><?=trim(strtoupper($field['horaire']))?></td>
					<td><?=trim(strtoupper($field['nom']))?> <?=trim($field['prenom'])?></td>
					<td><?=trim($field['salle'])?></td>
					<? if ($field['actif']) { ?>
						<td><button accompagnement_id='<?=$field["id"]?>' class='inactivate'>Inactiver</button></td>
					<? } else { ?>
						<td><button accompagnement_id='<?=$field["id"]?>' class='inactivate'>Réactiver</button></td>
					<? } ?>
					<td><button accompagnement_id='<?=$field["id"]?>' class='delete'>Supprimer</button></td>
                </tr>
            <?php }?>
    </tbody>
 
</table>
</div>
<?}?>



<h3>Liste des séances des accompagnements</h3> 
<p>Todo ? En effet le cahier des charges ne choisit pas entre la présentation par accompagnement (ie un prof est toujours lié à toutes les dates d'un couple cycle/matière et un niveau plus fin ).</p>


<h3>Création de rapports</h3> 
<div id='rapports'> 
<ul>
<li> Liste des élèves 
<?php echo form_open('admin/rapportEleves');?>
<input type="submit" value="visualiser" />
</form>

<?php echo form_open('admin/rapportEleves/csv');?>
<input type="submit" value="exporter le fichier csv" />
</form>
</li>
<li> second rapport

</ul>

</div>


<script type='text/javascript'>


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
		var prof = seances[i].nom_prof +"  "+ seances[i].prenom_prof 
		ret+='<li date_sql="'+seances[i].date+'" dateday="'+dayNames[d.getDay()]+'" date="'+ds+'" seance_id='+seances[i].seance_id+' accompagnement_id="'+seances[i].accompagnement_id+'" class='+cl+'>'+ ds + " - " + prof
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
		var date=$(this).attr('date')
		var accompagnement_id=$(this).attr('accompagnement_id')
		var date_sql=$(this).attr('date_sql')
		var dateday=$(this).attr('dateday')
		var cycle_id=$('.cycles .highlight').attr('name');
		var pr
		var active = true
		var prof_id=$('.profs .highlight').attr('name');
		if (prof_id===undefined){  
			pr = "Sélectionnez un nom dans la liste des professeurs"
			active = false
		} else {
			pr = $('.profs .highlight').text();
		}
		
		var txt = "Affecter la séance du "+ date+ " à <strong>"+ pr +"</strong> <button id='submitReaffect' prof_id='"+prof_id+" seance_id='"+seance_id+"' ' >Confimer</button>"
		
		var txt2 = "Affecter toutes les séances des "+ dateday+"s de cet accompagnement à <strong>"+ pr +"</strong> <button id='submitReaffectMultiple' prof_id='"+prof_id+" seance_id='"+seance_id+"' ' >Confimer</button>"
		
		$('#reaffecter').html(txt+'<br/>'+txt2)
		if (!active) {
			$("#submitReaffect").prop("disabled", true);
			$("#submitReaffectMultiple").prop("disabled", true);
		}
		
		myurl = '<?=site_url()?>/seances/setProfesseur/'+seance_id+'/'+prof_id;
		$('#submitReaffect').click(function(){
			$.ajax({
				url:myurl, 
				context: document.body 
			}).done(function(data) {
				if (!data.logged) window.location.reload() 
				activateSuscribe()
			});
		})
		
		myurl2 = '<?=site_url()?>/seances/setProfesseurByDay/'+accompagnement_id+'/'+prof_id+'/'+date_sql;
		$('#submitReaffectMultiple').click(function(){
			$.ajax({
				url:myurl2, 
				context: document.body 
			}).done(function(data) {
				if (!data.logged) window.location.reload() 
				activateSuscribe()
			});
		})
		
		
	})

}

function activateSuscribe(){
	if (($('.cycles .highlight').length == 1) && ($('.matieres .highlight').length == 1)) {
		cycle_id=$('.cycles .highlight').attr('name');
		matiere_id=$('.matieres .highlight').attr('name');
		myurl = '<?=site_url()?>/inscription/getNbPlacesRestantes/'+cycle_id+'/'+matiere_id;
		$.ajax({
			url:myurl, 
			context: document.body 
		}).done(function(data) {
			$('#salle').html(data.salle);
			$('#nbPlaces').html(data.places);
			$('#nbInscrits').html(data.nb_inscrits);
			$('#horaire').html(data.horaire);
			$('#type').html(data.type);
		});
		myurl3 = '<?=site_url()?>/seances/getIdsAndDatesWithProfs/'+cycle_id+'/'+matiere_id;
		$.ajax({
			url:myurl3, 
			context: document.body 
		}).done(function(data) {
			if (!data.logged) window.location.reload()
			$("#datesSelector").html(display_dates(data.seances_ids))
			dateSelectorHandler()
		});	
	}
	$("#datesSelector ul li.highlight").trigger("click")
	
	if (($('.cycles .highlight').length == 1) && ($('.matieres .highlight').length == 1) && ($('.profs .highlight').length == 1)  && ($('.salles .highlight').length == 1) ) {
		$('#accompagnementForm button[name="creer"]').prop("disabled", false);;
		/*
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
			*/
	}
}
	
$(document).ready(function() {
	
	$(".delete").click(function(){
		accompagnement_id=$(this).attr('accompagnement_id')
		that = $(this).closest('tr')
		myurl='<?=site_url()?>/accompagnement/supprimer/'+accompagnement_id
		if (confirm('Attention la suppression est irréversible. Souhaitez vous vraiment détruire cet accompagnement de la base de données ?')){
			$.ajax({
				url:myurl, 
				context: document.body 
			}).done(function(data) {
				that.remove()
				/*
				that.fadeOut(1000,function(){that.remove()});
				*/
			});
		}
	})
	
	$(".inactivate").click(function(){
		accompagnement_id=$(this).attr('accompagnement_id')
		that = $(this).closest('tr')
		if (that.hasClass('unactivated'))
		{
			myurl='<?=site_url()?>/accompagnement/activer/'+accompagnement_id		
		} else {
			myurl='<?=site_url()?>/accompagnement/inactiver/'+accompagnement_id
		}
		$.ajax({
			url:myurl, 
			context: document.body 
		}).done(function(data) {
			that.toggleClass('unactivated')
			if (that.hasClass('unactivated')) {
				that.find('.inactivate').html('Réactiver')
			} else {
				that.find('.inactivate').html('Inactiver')	
			}
		});
	})
		
	$(".cycles ul li").click(function(){
		$('.cycles .highlight').removeClass('highlight')
		$(this).toggleClass('highlight');
		$('#accompagnementForm input[name="cycle_id"]').val( $(this).attr('name') );
		activateSuscribe();
	})
	
	$(".matieres ul li").click(function(){
		$('.matieres .highlight').removeClass('highlight')
		$(this).toggleClass('highlight');
		$('#accompagnementForm input[name="matiere_id"]').val( $(this).attr('name') );
		activateSuscribe();
	})
	
	$(".profs ul li").click(function(){
		$('.profs .highlight').removeClass('highlight')
		$(this).toggleClass('highlight');
		$('#accompagnementForm input[name="enseignant_id"]').val( $(this).attr('name') );
		activateSuscribe();
	})
	
	$(".salles ul li").click(function(){
		$('.salles .highlight').removeClass('highlight')
		$(this).toggleClass('highlight');
		$('#accompagnementForm input[name="salle"]').val( $(this).html() );
		activateSuscribe();
	})
	
	
	
	$('div.accompagnement table').tablesorter()
	
});
</script>
