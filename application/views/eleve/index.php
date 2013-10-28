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
<button type='submit' name='inscription' disabled >inscription</button>
</form>

<h2>Liste des inscriptions courantes</h2>
<div class="historique">
<table class="bordered">
	<thead>
		<tr><th>Cycle</th><th>Matière</th></tr>
	</thead>
	<tbody>
	<? foreach ($historiques as $historique){?>
		<tr><td>
			<?=datefr($historique["cycle_debut"])?>
		</td><td><?=$historique['matiere_nom']?></td></tr>
	<?}?>
	</tbody>
</table>
</div>

<h2>Historique des séances</h2>
<div class="historique">
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

function activateSuscribe(){
	if (($('.cycles .highlight').length == 1) && ($('.matieres .highlight').length == 1)) {
		$('#inscriptionForm button[name="inscription"]').prop("disabled", false);;
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
			if (!data.logged) window.location.reload();
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



