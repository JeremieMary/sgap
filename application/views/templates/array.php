<table class="bordered">
    <thead>
    <tr>
		<?
		$keys = array_keys($json[0]);
		foreach ($keys as $key ) echo "<th>$key</th>";
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