<div class="container">
	<h1>Mes Interventions</h1>
	<table class="table table-bordered table-striped">
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
			if(!empty($arg['mesInterventions']) and is_array($arg['mesInterventions']))
			{
				foreach ($arg['mesInterventions'] as $value) {
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
	<?php
	if(!empty($_SESSION['tampon']['error']) and is_array($_SESSION['tampon']['error']))
	{
		?>
		<div class="has-error">
			<div class="input-group-addon">
				<?php
				foreach ($_SESSION['tampon']['error'] as $value) {
					echo $value .'<br />';
				}
				?>
			</div>
		</div>
		<?php
		$_SESSION['tampon']['error'] = null;
	}
	?>
</div><!-- /.container -->
