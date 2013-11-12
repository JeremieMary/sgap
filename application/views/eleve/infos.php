<h2>Liste des inscriptions courantes</h2>
<div class="historique">
<table class="bordered">
	<thead>
		<tr><th>Cycle</th><th>Matière</th><th>Commentaire général</th><th>Commentaire personnalisé</th></tr>
	</thead>
	<tbody>
	<? foreach ($historiqueAccompagnements as $historique){?>
		<tr><td>
			<?=datefr($historique["cycle_debut"])?>
		</td><td><?=$historique['matiere_nom']?></td>
		<td></td>
		<td></td>
	</tr>
	<?}?>
	</tbody>
</table>
</div>

<h2>Historique des présences</h2>
<div class="historique">
	<div class="historique">
	<table class="bordered">
		<thead>
			<tr><th>Cycle</th><th>Matière</th></tr>
		</thead>
		<tbody>
		
		</tbody>
	</table>
	<? print_r($historiqueSeances) ?>
</div>
