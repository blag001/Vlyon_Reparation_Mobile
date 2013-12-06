<div class="container">
	<h1>Information Station</h1>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Id</th>
				<th>Nom</th>
				<th>Rue</th>
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
					<td><?php echo $arg['uneStation']->Sta_Rue;?></td>
				</tr>
				<?php
			}
			?>
		</tbody>
		<thead>
			<tr>
				<th>Nb Attaches</th>
				<th>Nb Velo Dispo</th>
				<th>Nb attaches Dispo</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(!empty($arg['uneStation']))
			{
				?>
				<tr>
					<td><?php echo $arg['uneStation']->Sta_NbAttaches;?></td>
					<td><?php echo $arg['uneStation']->Sta_NbVelos;?></td>
					<td><?php echo $arg['uneStation']->Sta_NbAttacDispo;?></td>
				</tr>
				<?php
			}
			?>
		</tbody>
	</table>
	<h1>V&eacute;los accroch&eacute;s</h1>
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>Num</th>
				<th>Type</th>
				<th>Rue</th>
				<th>Accessoires</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(!empty($arg['lesVelos']) and is_array($arg['lesVelos']))
			{
				foreach ($arg['lesVelos'] as $value) {
				?>
					<tr>
						<td>
							<a href="index.php?page=velo&amp;action=unvelo&amp;valeur=<?php echo $value->Vel_Num;?>">
								<?php echo $value->Vel_Num;?>
							</a>
						</td>
						<td><?php echo $value->Vel_Etat;?></td>
						<td><?php echo $value->Vel_Type;?></td>
						<td><?php echo $value->Vel_Accessoire;?></td>
					</tr>
				<?php
				}
			}
			?>
		</tbody>
</div><!-- /.container -->
