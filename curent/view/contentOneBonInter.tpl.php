<div class="container">
	<h1>Informations sur la demande d'intervention</h1>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Id</th>
				<th>Velo</th>
				<th>Date Début</th>
				<th>Date Fin</th>
				<th>Compte rendu</th>
				<th>Réparable</th>
				<th>No Demande</th>
				<th>Technicien</th>
				<th>Sur place</th>
				<th>Durée</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(!empty($arg['unBonInter']))
			{
				?>
				<tr>
					<td>
						<a href="index.php?page=intervention&amp;action=unbonintervention&amp;valeur=<?php echo $arg['unBonInter']->BI_Num;?>">
							<?php echo $arg['unBonInter']->BI_Num;?>
						</a>
					</td>
					<td><?php echo $arg['unBonInter']->BI_Velo;?></td>
					<td><?php echo $arg['unBonInter']->BI_DatDebut;?></td>
					<td><?php echo $arg['unBonInter']->BI_DatFin;?></td>
					<td><?php echo $arg['unBonInter']->BI_CpteRendu;?></td>
					<td><?php echo $arg['unBonInter']->BI_Reparable;?></td>
					<td><?php echo $arg['unBonInter']->BI_Demande;?></td>
					<td><?php echo $arg['unBonInter']->Tec_Nom;?></td>
					<td><?php echo $arg['unBonInter']->BI_SurPlace;?></td>
					<td><?php echo $arg['unBonInter']->BI_Duree;?></td>
				</tr>
				<?php
			}
			?>
		</tbody>
	</table>

</div><!-- /.container -->
