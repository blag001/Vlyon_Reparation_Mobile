<!--<form action="index.php" methode="POST">
	<input type="input" name="nom" /><br />
	<input type="password" name="mdp" /><br />
	<input type="subbmit" value="Se connecter" />
</form> -->
<div class="container">
	<form class="form-signin" role="form" action="index.php" methode="POST">
		<h2 class="form-signin-heading">Enregistrez-vous</h2>
		<input type="text" name="nom" class="form-control" placeholder="Identifiant" required autofocus>
		<input type="password" name="mdp" class="form-control" placeholder="Mot de passe" required>
		<label class="checkbox">
			<input type="checkbox" value="remember-me">Se souvenir de moi
		</label>
		<button class="btn btn-lg btn-primary btn-block" type="submit">Se connecter</button>
	</form>
</div>
