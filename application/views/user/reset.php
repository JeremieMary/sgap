<div class="container">
		<div class="form-bg">
			<?php echo form_open('user/reset'); ?>
				<h2>Entrez votre login</h2>
				<p><input type="text" placeholder="Login" name="login" value="<?= set_value('login'); ?>" /></p>
				<button type="submit" class='login'></button>
			</form>
		</div>
</div>
