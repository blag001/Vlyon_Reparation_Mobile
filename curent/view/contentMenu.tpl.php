<!-- Fixed navbar -->
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container">
		<!-- bouton en format mini -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php">V-Lyon</a>
		</div>
		<!-- full menu -->
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li class="dropdown">
					<a href="<?php echo $_SESSION['tampon']['menu']['url'];?>" class="dropdown-toggle" data-toggle="dropdown">
						<?php echo $_SESSION['tampon']['menu']['title'];?> <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li <?php if($_SESSION['tampon']['menu']['title']=='Station') echo 'class="active"';?>>
							<a href="index.php?page=station">Station</a>
						</li>
						<li <?php if($_SESSION['tampon']['menu']['title']=='Intervention') echo 'class="active"';?>>
							<a href="index.php?page=intervention">Intervention</a>
						</li>
						<li <?php if($_SESSION['tampon']['menu']['title']=='Technicien') echo 'class="active"';?>>
							<a href="index.php?page=technicien">Technicien</a>
						</li>
						<li <?php if($_SESSION['tampon']['menu']['title']=='V&eacute;lo') echo 'class="active"';?>>
							<a href="index.php?page=velo">V&eacute;lo</a>
						</li>
					</ul>
				</li>

				<?php
				// si presence d'un sous menu
				if(!empty($_SESSION['tampon']['sous_menu']) and is_array($_SESSION['tampon']['sous_menu']))
				{
					?>
					<li class="dropdown">
						<a href="<?php echo $_SESSION['tampon']['sous_menu']['curent']['url'];?>" class="dropdown-toggle" data-toggle="dropdown">
							<?php echo $_SESSION['tampon']['sous_menu']['curent']['title'];?> <b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
						<?php
						// on parcours les differents sous menus
						if(
							!empty($_SESSION['tampon']['sous_menu']['list'])
							and is_array($_SESSION['tampon']['sous_menu']['list']))
						{
							foreach ($_SESSION['tampon']['sous_menu']['list'] as $value)
							{
								?>
								<li <?php
									if($value['title'] == $_SESSION['tampon']['sous_menu']['curent']['title'])
										echo 'class="active"';?>>
									<a href="<?php echo $value['url'];?>"><?php echo $value['title'];?></a>
								</li>
								<?php
							}
						}
						?>
						</ul>
					</li>
					<?php
				}
				?>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="index.php?page=logout">Logout</a></li>
			</ul>
		</div><!--/.nav-collapse -->
	</div>
</div>
