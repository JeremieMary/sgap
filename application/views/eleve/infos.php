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
		<td><?=$historique['commentaire_general']?></td>
		<td><?=$historique['commentaire_perso']?></td>
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
	<br/>
	<table>
	<? foreach ($historiqueSeances as $historique){?>
		<tr><td><li><?=$historique['matiere_nom']?><br/>
		<?=$historique['seance_date']?></td></tr>
	<?}?>
	</table>
</div>
