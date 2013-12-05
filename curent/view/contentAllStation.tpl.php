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
		if(!empty($lesStations) and is_array($lesStations))
		{
			foreach ($lesStations as $value) {
				?>
				<tr>
					<td><?php $value->Sta_Code;?></td>
					<td><?php echo $value->Sta_Nom;?></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<?php
			}
		}
		?>
	</table>

</div><!-- /.container -->
