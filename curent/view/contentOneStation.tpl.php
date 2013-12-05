<div class="container">

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Id</th>
				<th>Nom</th>
				<th>Nb Attaches</th>
				<th>Nb_VeloDispo</th>
				<th>Nb_attachesDispo</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(!empty($arg['uneStation']))
			{
				?>
				<tr>
					<td>
						<a href="index.php?page=station&amp;action=unestation&amp;valeur=<?php echo $arg['uneStation']->Sta_Code;?>">
							<?php echo $arg['uneStation']->Sta_Code;?>
						</a>
					</td>
					<td><?php echo $arg['uneStation']->Sta_Nom;?></td>
					<td><?php echo $arg['uneStation']->Sta_NbAttaches;?></td>
					<td><?php echo $arg['uneStation']->Sta_NbVelos;?></td>
					<td><?php echo $arg['uneStation']->Sta_NbAttacDispo;?></td>
				</tr>
				<?php
			}
			?>
		</tbody>
	</table>

</div><!-- /.container -->
