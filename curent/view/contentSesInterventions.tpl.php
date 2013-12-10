<div class="container">
	<h1>Ses Interventions</h1>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Numero du bon l'intervention</th>
				<th>Date début</th> <!-- pas de précision donc on affiche date de début-->
				<th>Station</th>
				<th>No Velo</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(!empty($arg['sesInterventions']) and is_array($arg['sesInterventions']))
			{
				foreach ($arg['sesInterventions'] as $value) {
					?>
					<tr>
						<td>
							<a href="index.php?page=intervention&amp;action=unbonintervention&amp;valeur=<?php echo $value->BI_Num;?>">
								<?php echo $value->BI_Num;?>
							</a>
						</td>
						<td><?php echo $value->BI_DateDebut;?></td>
						<td><?php echo $value->Sta_Nom;?></td>
						<td><?php echo $value->BI_Velo;?></td>
					</tr>
					<?php
				}
			}
			?>
		</tbody>
	</table>

</div><!-- /.container -->
