<div class="container">
	<form class="form-search" role="form" action="index.php?page=intervention&amp;action=rechercherbonintervention" method="GET" >
		<h1 class="form-search-heading">Rechercher un bon</h1>
		<input type="search" name="valeur" class="form-control" placeholder="Code du bon, velo..." autofocus <?php
			if(isset($_GET['valeur']) and $_GET['valeur'] !== '')
				echo 'value="'.$_GET['valeur'].'" ';
			?>>
		<input type="hidden" name="page" class="form-control" value="intervention" required >
		<input type="hidden" name="action" class="form-control" value="rechercherbonintervention" required >
        <button type="submit" class="btn btn-lg btn-primary btn-block" >Rechercher</button>
	</form>
</div>