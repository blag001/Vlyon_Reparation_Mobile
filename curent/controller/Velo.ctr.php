<?php
class Velo
{
	public function __construct()
	{
		if (!$_SESSION['user']->estUser()) {
			# code...
		}
	}
}
