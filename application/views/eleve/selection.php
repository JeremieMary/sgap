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

