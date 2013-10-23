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