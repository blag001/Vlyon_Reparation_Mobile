<div class="container">
	<h1>Informations sur la demande d'intervention</h1>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Id</th>
				<th>Date</th>
				<th>No Velo</th>
				<th>Station</th>
				<th>Demandeur</th>
				<th>Motif</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(!empty($arg['uneDemandeInter']))
			{
				?>
				<tr>
					<td>
						<a href="index.php?page=intervention&amp;action=uneDemandeInter&amp;valeur=<?php echo $arg['uneDemandeInter']->DemI_Num;?>">
							<?php echo $arg['uneDemandeInter']->DemI_Num;?>
						</a>
					</td>
					<td><?php echo $arg['uneDemandeInter']->DemI_Num;?></td>
					<td><?php echo $arg['uneDemandeInter']->Sta_Date;?></td>
					<td><?php echo $arg['uneDemandeInter']->DemI_Velo;?></td>
					<td><?php echo $arg['uneDemandeInter']->	;?></td>
					<td><?php echo $arg['uneDemandeInter']->Sta_Technicien;?></td>
					<td><?php echo $arg['uneDemandeInter']->Sta_Motif;?></td>
				</tr>
				<?php
			}
			?>
		</tbody>
	</table>

</div><!-- /.container -->
