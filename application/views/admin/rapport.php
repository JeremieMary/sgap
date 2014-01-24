<h2>Liste des élèves</h2>
<div id="listeEleves">	

<ul>
<?php foreach($liste->result() as $row):?>
	<li><?php foreach($row as $item):?>
		<?php echo $item;?>
	<?php endforeach;?></li>
<?php endforeach;?>
</ul>

</div>
