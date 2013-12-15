<div class="container">
	<h1>Informations Station</h1>
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
	</table>
	<table class="table table-bordered">
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
	<h2>V&eacute;los accroch&eacute;s</h2>
	<table class="table table-bordered table-striped">
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
						<td><?php echo $value->Eta_Libelle;?></td>
						<td><?php echo $value->Vel_Type;?></td>
						<td><?php echo $value->Vel_Accessoire;?></td>
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
