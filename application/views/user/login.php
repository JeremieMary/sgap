
<div class="notice">
		<span class="close">Fermer</a>
		<?php echo validation_errors(); ?>
</div>



<div class="container">
		<div class="form-bg">
			<?php echo form_open('user/checkLogin'); ?>		
				<h2>Login</h2>
				<p><input type="text" placeholder="Login"></p>
				<p><input type="password" placeholder="Password"></p>
				<label for="remember">
				  <input type="checkbox" id="remember" value="remember" />
				  <span>Se souvenir de moi sur cette machine</span>
				</label>
				<button type="submit"></button>
			<form>
		</div>
		<p class="forgot">Mot de passe oublié? <a href="">Click here to reset it.</a></p>
	</div>
</form>
</div>



<script src="<?= base_url() ?>public/js/app.js"></script>