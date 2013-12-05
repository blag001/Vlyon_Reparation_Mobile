<div class="container">

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Id</th>
				<th>Nom</th>
				<th>Nb Attaches</th>
				<th>Nb Velo Dispo</th>
				<th>Nb Attaches Dispo</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(!empty($arg['lesStations']) and is_array($arg['lesStations']))
			{
				foreach ($arg['lesStations'] as $value) {
					?>
					<tr>
						<td>
							<a href="index.php?page=station&amp;action=unestation&amp;valeur=<?php echo $value->Sta_Code;?>">
								<?php echo $value->Sta_Code;?>
							</a>
						</td>
						<td><?php echo $value->Sta_Nom;?></td>
						<td><?php echo $value->Sta_NbAttaches;?></td>
						<td><?php echo $value->Sta_NbVelos;?></td>
						<td><?php echo $value->Sta_NbAttacDispo;?></td>
					</tr>
					<?php
				}
			}
			?>
		</tbody>
	</table>

</div><!-- /.container -->
