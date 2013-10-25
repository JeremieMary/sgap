<?
//print_r( $cycles );
//print_r( $matieres );	
?>

<div class="cycles">
<ul>
	<? foreach ($cycles as $cycle){?>
		<li name='<?=$cycle["id"]?>'> <?=$cycle['debut']?>
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
</ul>
</div>


<? echo form_open('eleve/inscription',array('id' => 'inscriptionForm')); ?>	
<input type='hidden' name='matiere_id' value=''>
<input type='hidden' name='cycle_id' value=''>
<button type='submit' name='inscription' disabled >inscription</button>
</form>

<div class="historique">
<table class="bordered">
	<thead>
		<tr><th>Cycle</th><th>Matière</th><th>Commentaire Général</th></tr>
	</thead>
	<tbody>
	<? foreach ($historiques as $historique){?>
		<tr><td><?=$historique["cycle_debut"]?></td><td><?=$historique['matiere_nom']?></td><td>Boo</td></tr>
	<?}?>
	</tbody>
</table>
</div>

<script type='text/javascript'>
var accompagnement=<?=json_encode( $accompagnement )?>	

function unactivateMatieres(cycle_id){
	$(".matieres ul li").addClass('unactivated')
	for (var i in accompagnement) {
		if (accompagnement[i].cycle_id == cycle_id) {
			matiere_id=accompagnement[i].matiere_id
			//$(".matieres ul li[name=]").removeClass('unactivated')
		} 
	}
}

function activateSuscribe(){
	if (($('.cycles .highlight').length == 1) && ($('.matieres .highlight').length == 1)) {
		$('#inscriptionForm button[name="inscription"]').removeAttr("disabled");
		cycle_id=$('#inscriptionForm input[name="cycle_id"]').val();
		matiere_id=$('#inscriptionForm input[name="matiere_id"]').val();
		myurl = '<?=site_url()?>/inscription/getNbPlacesRestantes/'+cycle_id+'/'+matiere_id;
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
		$('#inscriptionForm input[name="matiere_id"]').val( $(this).attr('name') )
		activateSuscribe()
	})
	
	
});
</script>



