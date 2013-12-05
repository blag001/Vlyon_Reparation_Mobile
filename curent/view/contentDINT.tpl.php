<div class="container">

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

