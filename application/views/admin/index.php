<?  if ($this->session->userdata['profil']>3){ ?>
	<div id="navlinks">
		<?=anchor('enseignant','Utiliser la vue Enseignant')?>
	</div>
<? } ?>




<div id='importation'>
<h2>Importation de données</h2>
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
	<h2>Création d'accompagnement</h2>
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
		<label> Enseignant/Intervenant </label>
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
	</div>

	<? echo form_open('accompagnement/creer',array('id' => 'accompagnementForm')); ?>	
	<input type='hidden' name='matiere_id' value=''>
	<input type='hidden' name='cycle_id' value=''>
	<input type='hidden' name='enseignant_id' value=''>
	<input type='hidden' name='salle' value=''>
	<button type='submit' name='creer' disabled >Créer</button>
	</form>
</div>


<div class="accompagnement">
<h2>Liste des accompagnements </h2>
<p><i> Note : restreindre uniquement aux actifs ?</i></p>
<? if (count($accompagnement)>0) { ?>	
<table class="bordered">
    <thead>
    <tr>
		<?
		//$keys = array_keys($accompagnement[0]);
		$keys = array('Cycle','Matière','Enseignant','Salle');
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

<h2>Création de rapports</h2> 
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
function activateSuscribe(){
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
	
});
</script>
