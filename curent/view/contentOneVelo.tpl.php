<div class="container">
	<h1>Informations V&eacute;lo</h1>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Num</th>
				<th>&Eacute;tat</th>
				<th>Type</th>
				<th>Accessoires</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(!empty($arg['unVelo']))
			{
			?>
				<tr>
					<td>
						<a href="index.php?page=velo&amp;action=unvelo&amp;valeur=<?php echo $arg['unVelo']->Vel_Num;?>">
							<?php echo $arg['unVelo']->Vel_Num;?>
						</a>
					</td>
					<td><?php echo $arg['unVelo']->Eta_Libelle;?></td>
					<td><?php echo $arg['unVelo']->Vel_Type;?></td>
					<td><?php echo $arg['unVelo']->Vel_Accessoire;?></td>
				</tr>
			<?php
			}
			?>
		</tbody>
	</table>
</div><!-- /.container -->
