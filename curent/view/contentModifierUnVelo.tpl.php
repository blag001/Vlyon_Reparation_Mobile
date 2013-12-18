<div class="container">
	<form class="form-add" role="form" action="index.php?page=velo&amp;action=modifiervelo" method="POST" >
		<h1 class="form-add-heading">Modifier un V&eacute;lo</h1>

		<div class="form-group">
			<label for="vel_code">No du v&eacute;lo</label>
			<input class="form-control" id="vel_code" type="text" name="codeVelo" value="<?php
				if (!empty($arg['leVelo']))
					echo $arg['leVelo']->Vel_Num
			?>" disabled>
		</div>
		<div class="form-group">
			<label for="vel_station">Station du v&eacute;lo</label>
			<select class="form-control" id="vel_station" name="stationVelo" >
				<?php
				if(
					!empty($arg['lesStations'])
					and is_array($arg['lesStations'])
					and !empty($arg['leVelo'])
					)
				{
					foreach ($arg['lesStations'] as $value)
					{
						echo '<option';
						if ($value->Sta_Code == $arg['leVelo']->Vel_Station)
							echo ' selected ';
						echo '>'.$value->Sta_Code.'</option>';
					}
				}
				?>
			</select>
		</div>
		<div class="form-group">
			<label for="vel_etat">&Eacute;tat du v&eacute;lo</label>
			<select class="form-control" id="vel_etat" name="etatVelo" >
				<?php
				if(
					!empty($arg['lesEtats'])
					and is_array($arg['lesEtats'])
					and !empty($arg['leVelo'])
					)
				{
					foreach ($arg['lesEtats'] as $value)
					{
						echo '<option value="' .$value->Eta_Code. '"';
						if ($value->Eta_Code == $arg['leVelo']->Vel_Etat)
							echo ' selected ';
						echo ' >'.$value->Eta_Libelle.'</option>';
					}
				}
				?>
			</select>
		</div>
		<div class="form-group">
			<label for="vel_type">Type du v&eacute;lo</label>
			<select class="form-control" id="vel_type" name="typeVelo" >
				<?php
				if(
					!empty($arg['lesTypes'])
					and is_array($arg['lesTypes'])
					and !empty($arg['leVelo'])
					)
				{
					foreach ($arg['lesTypes'] as $value)
					{
						echo '<option value="' .$value->Pdt_Code. '"';
						if ($value->Pdt_Code == $arg['leVelo']->Vel_Type)
							echo ' selected ';
						echo ' >'.$value->Pdt_Libelle.'</option>';
					}
				}
				?>
			</select>
		</div>
		<div class="form-group">
			<label for="vel_accessoire">Accessoire(s)</label>
			<input class="form-control" id="vel_accessoire" type="text" name="accessoireVelo" <?php
				if (!empty($arg['leVelo']))
					echo 'value="'.$arg['leVelo']->Vel_Accessoire.'"';
			?> >
		</div>
		<div class="checkbox">
			<label for="vel_casse">
				<input type="checkbox" value="1" id="vel_casse" name="veloCasse">
				V&eacute;lo Cass&eacute;.
			</label>
		</div>
        <button type="submit" class="btn btn-lg btn-primary btn-block" >Modifier</button>
	</form>
</div>