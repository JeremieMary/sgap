<?php 
/* Admin index	view */
?>


<?php echo form_open_multipart('admin/uploadUsersFile');?>
<label for="userfile"> Upload fichier utilisateurs: </label>
<input type="file" name="userfile" size="20" />
<input type="submit" value="upload" />

</form>
