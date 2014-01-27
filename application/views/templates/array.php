<? if (isset($title) ) { ?>
<h3> <?=$title?> </h3>
<? }?>
<table class="bordered tablesorter">
    <thead>
    <tr>
		<?
		$keys = array_keys($json[0]);
		foreach ($keys as $key ) echo "<th>".ucfirst($key)."</th>";
		?>
    </tr>
    </thead>
 
    <tbody>
            <?php foreach($json as $field){?>
                <tr>
					<?
					foreach ($keys as $key ) echo "<td>".$field[$key]."</td>";
					?>
                </tr>
            <?php }?>
    </tbody>
 
</table>

<script>
$(document).ready(function() {
	$('.tablesorter').tablesorter()
})
</script>