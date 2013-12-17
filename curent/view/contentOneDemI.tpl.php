<div class="container">
	<h1>Informations sur la demande d'intervention</h1>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Id</th>
				<th>Date</th>
				<th>No Velo</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(!empty($arg['uneDemandeInter']))
			{
				?>
				<tr>
					<td>
						<a href="index.php?page=intervention&amp;action=unedemandeinter&amp;valeur=<?php echo $arg['uneDemandeInter']->DemI_Num;?>">
							<?php echo $arg['uneDemandeInter']->DemI_Num;?>
						</a>
					</td>
					<td><?php echo $arg['uneDemandeInter']->DemI_Date;?></td>
					<td>
						<a href="index.php?page=velo&amp;action=unvelo&amp;valeur=<?php echo $arg['uneDemandeInter']->DemI_Velo;?>">
							<?php echo $arg['uneDemandeInter']->DemI_Velo;?>
						</a>
					</td>
				</tr>
				<?php
			}
			?>
		</tbody>
	</table>
	<table class="table table-bordered">
		<thead>
			<tr>
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
					<td><?php echo $arg['uneDemandeInter']->Sta_Nom;?></td>
					<td><?php echo $arg['uneDemandeInter']->Tec_Nom;?></td>
					<td><?php echo $arg['uneDemandeInter']->DemI_Motif;?></td>
				</tr>
				<?php
			}
			?>
		</tbody>
	</table>

</div><!-- /.container -->
