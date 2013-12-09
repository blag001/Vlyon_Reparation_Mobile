<div class="container">
	<h1>Interventions non trait&eacute;es</h1>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Numero de la Demande</th>
				<th>Date</th>
				<th>Station</th>
				<th>No Velo</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(!empty($arg['lesDemandesINT']) and is_array($arg['lesDemandesINT']))
			{
				foreach ($arg['lesDemandesINT'] as $value) {
					?>
					<tr>
						<td>
							<a href="index.php?page=intervention&amp;action=unedemandeinter&amp;valeur=<?php echo $value->DemI_Num;?>">
								<?php echo $value->DemI_Num;?>
							</a>
						</td>
						<td><?php echo $value->DemI_Date;?></td>
						<td><?php echo $value->Sta_Nom;?></td>
						<td><?php echo $value->DemI_Velo;?></td>
					</tr>
					<?php
				}
			}
			?>
		</tbody>
	</table>

</div><!-- /.container -->
