<div class="container">
	<form class="form-signin" role="form" action="index.php" method="POST" >
		<h2 class="form-signin-heading">Enregistrez-vous</h2>
		<input type="text" name="nom" class="form-control" placeholder="Identifiant" required autofocus >
		<input type="password" name="mdp" class="form-control" placeholder="Mot de passe" required >
<?php
/* on ne le met pas en place tout de suite...
		<label class="checkbox" for="remember-me">
			<input type="checkbox" value="remember-me" id="remember-me" />Se souvenir de moi
		</label> */?>
        <button type="submit" class="btn btn-lg btn-primary btn-block" >Se connecter</button>
	</form>
</div>
