<div class="has-error">
	<div class="form-control">
		<?php
		if(!empty($_SESSION['tampon']['error']) and is_array($_SESSION['tampon']['error']))
		{
			foreach ($_SESSION['tampon']['error'] as $value) {
				echo $value .'<br />';
			}
		}
		?>
	</div>
</div>
