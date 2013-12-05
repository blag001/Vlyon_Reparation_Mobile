<div class="container">

	<table>
		<tr>
			<td>Id</td>
			<td>Nom</td>
			<td>Nb Attaches</td>
			<td>Nb_VeloDispo</td>
			<td>Nb_attachesDispo</td>
		</tr>

		<?php
		if(!empty($arg['lesStations']) and is_array($arg['lesStations']))
		{
			foreach ($arg['lesStations'] as $value) {
				?>
				<tr>
					<td><?php echo $value->Sta_Code;?></td>
					<td><?php echo $value->Sta_Nom;?></td>
					<td><?php echo $value->Sta_NbAttaches;?></td>
					<td><?php echo $value->Sta_NbVelos;?></td>
					<td><?php echo $value->Sta_NbAttacDispo;?></td>
				</tr>
				<?php
			}
		}
		?>
	</table>

</div><!-- /.container -->
