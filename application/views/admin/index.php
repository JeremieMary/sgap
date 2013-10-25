<?php 
/* Admin index	view */
?>
<h2>Importation de données</h2>
<div id='importation'>
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

<h2>Création d'accompagnement</h2>
<div id='creation_accompagnement'>
<div class="cycles">
	<label> Cycles </label>
<ul>
	<? foreach ($cycles as $cycle){?>
		<li name='<?=$cycle["id"]?>'> <?=$cycle['debut']?>
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


<div class="accompagnement">
<h2>Liste des accompagnements actifs</h2>
<? if (count($accompagnement)>0) { ?>	
<table class="bordered">
    <thead>
    <tr>
		<?
		$keys = array_keys($accompagnement[0]);
		foreach ($keys as $key ) echo "<th>$key</th>";
		?>
    </tr>
    </thead>
 
    <tbody>
            <?php foreach($accompagnement as $field){?>
                <tr>
					<?
					foreach ($keys as $key ) echo "<td>".$field[$key]."</td>";
					?>
                </tr>
            <?php }?>
    </tbody>
 
</table>
</div>
<?}?>


<script type='text/javascript'>
function activateSuscribe(){
	if (($('.cycles .highlight').length == 1) && ($('.matieres .highlight').length == 1) && ($('.profs .highlight').length == 1)  && ($('.salles .highlight').length == 1) ) {
		$('#accompagnementForm button[name="creer"]').removeAttr("disabled");
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
