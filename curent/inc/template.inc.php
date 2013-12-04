<?php
function view($name = null)
{
	if(empty($name))
		return;
	// inclusion du template
	include 'view/'.$name.'.tpl.php';
}
