<div class="container">
	<form class="form-search" role="form" action="index.php?page=velo&amp;action=recherchervelo" method="GET" >
		<h1 class="form-search-heading">Rechercher un Velo</h1>
		<input type="search" name="valeur" class="form-control" placeholder="Code v&eacute;lo ou code station" autofocus <?php
			if(isset($_GET['valeur']) and $_GET['valeur'] !== '')
				echo 'value="'.$_GET['valeur'].'" ';
			?>>
		<input type="hidden" name="page" class="form-control" value="velo" required >
		<input type="hidden" name="action" class="form-control" value="recherchervelo" required >
        <button type="submit" class="btn btn-lg btn-primary btn-block" >Rechercher</button>
	</form>
</div>
