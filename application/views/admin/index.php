<?php 
/* Admin index	view */
?>

<?php echo form_open_multipart('admin/uploadFile/users');?>
<label for="userfile"> Chargement des utilisateurs - CSV : </label>
<input type="file" name="userfile" size="20" />
<input type="submit" value="upload" />	

<?php echo form_open_multipart('admin/uploadFile/cycles');?>
<label for="userfile"> Chargement des  cycles - CSV : </label>
<input type="file" name="userfile" size="20" />
<input type="submit" value="upload" />	

<?php echo form_open_multipart('admin/uploadFile/matieres');?>
<label for="userfile"> Chargement des matières - CSV: </label>
<input type="file" name="userfile" size="20" />
<input type="submit" value="upload" />	



</form>
