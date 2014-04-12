<div class="container">
	<form class="form-add" role="form" action="index.php?page=intervention&amp;action=creerdemandeintervention" method="POST" >
		<h1 class="form-add-heading">Cr&eacute;er une demande d'intervention</h1>

		<div class="form-group">
			<label for="vel_num">V&eacute;lo concern&eacute;</label>
			<select class="form-control" id="vel_num" name="vel_num" >
				<?php
				if(
					!empty($arg['lesVelos'])
					and is_array($arg['lesVelos'])
					)
				{
					foreach ($arg['lesVelos'] as $unVelo)
					{
						echo '<option value="'.$unVelo->Vel_Num.'" ';
						if ($unVelo->Vel_Num == $arg['leVeloNum'])
							echo ' selected="selected" ';
						echo '>'.$unVelo->Vel_Num.'</option>';
					}
				}
				?>
			</select>

			<label for="dateDemande">Date de la demande</label>
			<input type="date" class="form-control"  id="dateDemande" name="dateDemande" placeholder="Date de debut">

			<label for="compteRendu">Comtpe rendu</label>
			<input type="text" class="form-control"  id="compteRendu" name="compteRendu" placeholder="Motif du probleme">



        	<button type="submit" class="btn btn-lg btn-primary btn-block" >Ajouter la demande</button>
		</div>
	</form>
</div>
